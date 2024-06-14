#!/bin/bash

# DuckDNS subdomain
DOMAIN="your-subdomain.duckdns.org"

# DuckDNS token
TOKEN="your-duckdns-token"

# TXT record content
TXT_VALUE="$CERTBOT_VALIDATION"

# Update DuckDNS TXT record
curl -k "https://www.duckdns.org/update?domains=$DOMAIN&token=$TOKEN&txt=$TXT_VALUE&verbose=true"
