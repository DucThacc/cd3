FROM nginx:alpine

# Cài đặt ModSecurity cho nginx
RUN apk add --no-cache \
    nginx-mod-http-modsecurity \
    modsecurity-crs \
    libmagic \
    curl

# Tạo thư mục cần thiết
RUN mkdir -p /etc/nginx/modsec \
    /var/log/modsecurity \
    /etc/modsecurity.d/owasp-crs/rules

# Copy cấu hình ModSecurity
COPY modsecurity.config /etc/nginx/modsec/modsecurity.conf

# Copy SSL certificates (nếu có)
RUN mkdir -p /etc/nginx/ssl

# Copy nginx config
COPY default.conf /etc/nginx/conf.d/default.conf

# Tạo file mẫu cho custom rules nếu thư mục modsec trống
RUN if [ ! -f /etc/modsecurity.d/owasp-crs/rules/REQUEST-900-EXCLUSION-RULES-BEFORE-CRS.conf ]; then \
    echo '# Custom ModSecurity rules can be added here' > /etc/modsecurity.d/owasp-crs/rules/REQUEST-900-EXCLUSION-RULES-BEFORE-CRS.conf; \
    fi

# Kiểm tra cấu hình nginx
RUN nginx -t

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]