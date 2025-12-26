
FROM owasp/modsecurity-crs:nginx-alpine

USER root

# Install libmagic (file)
RUN apk add --no-cache file

USER nginx

# Copy simplified nginx configuration directly
COPY default.conf /etc/nginx/conf.d/default.conf

# Create ssl folder (user can mount certs)
RUN mkdir -p /etc/nginx/ssl

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
