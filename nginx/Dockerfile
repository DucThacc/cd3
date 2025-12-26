FROM owasp/modsecurity-crs:nginx-alpine

USER root

# Install libmagic (file) và curl cho việc debug
RUN apk add --no-cache file curl

# Tạo thư mục log cho ModSecurity
RUN mkdir -p /var/log/modsecurity
RUN chown -R nginx:nginx /var/log/modsecurity

USER nginx

# Copy nginx configuration
COPY default.conf /etc/nginx/conf.d/default.conf
COPY modsecurity.conf /etc/nginx/modsec/modsecurity.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]