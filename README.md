# web-vulnerable (ModSecurity + Nginx reverse-proxy)

This project is a small PHP web app intended to run in Docker. I added an Nginx service with ModSecurity that proxies traffic to the PHP/Apache app running on port `8080` inside the `web` container. Nginx listens on host port `80`.

Quick summary:
- Public entry: Nginx (with ModSecurity) -> host port `80`
- Backend web: Apache/PHP in `web` container -> listens on internal port `8080`
- Database: MySQL service `db` (default credentials in `docker-compose.yml` for demo only)

Files added/changed:
- `Dockerfile` (root): Apache configured to listen on `8080`.
- `docker-compose.yml`: added `nginx` service and changed `web` to expose `8080`.
- `nginx/`: Dockerfile and configuration enabling ModSecurity and a minimal CRS placeholder.

Build and run (on the Docker host / Ubuntu VM):

```bash
# from project root (where docker-compose.yml is)
docker compose build
docker compose up -d

# view logs (nginx will show ModSecurity startup and proxy activity)
docker compose logs -f nginx
```

Notes and troubleshooting:
- The `nginx` image builds libModSecurity and the ModSecurity-nginx connector during image build. This can take several minutes and requires build tools. If you prefer, I can switch to a prebuilt image to speed up startup.
- ModSecurity is configured with a minimal placeholder CRS in `nginx/modsec/crs/`. For production-like protection, replace those with the full OWASP CRS set. Example to pull CRS into the folder before build:

```bash
git clone https://github.com/coreruleset/coreruleset.git nginx/modsec/crs
```

- ModSecurity audit logs are configured to write to `/var/log/modsec_audit.log` inside the Nginx container. To inspect them:

```bash
docker compose exec nginx sh -c 'tail -n +1 /var/log/modsec_audit.log'
```

- If you run into permission or build problems on Windows, consider building on a Linux VM (Ubuntu) or WSL2.

Next steps I can do for you (choose any):
- Add the full OWASP CRS rules and tune `modsecurity.conf` for DetectionOnly or Blocking mode.
- Mount audit logs to the host for easier inspection.
- Replace the heavy build in `nginx/Dockerfile` with a smaller prebuilt image or multi-stage build.

If you want, I can add the full CRS files now and switch ModSecurity to `DetectionOnly` by default.
