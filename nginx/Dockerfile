# Dùng image có sẵn ModSecurity từ bạn tôi
FROM owasp/modsecurity-crs:nginx-alpine

USER root

# Cài libmagic (file) và curl
RUN apk add --no-cache file curl

USER nginx

# Copy nginx config
COPY default.conf /etc/nginx/conf.d/default.conf

# Copy ModSecurity config
COPY modsecurity.config /etc/nginx/modsec/modsecurity.conf

# Tạo thư mục SSL (nếu cần)
RUN mkdir -p /etc/nginx/ssl

EXPOSE 80