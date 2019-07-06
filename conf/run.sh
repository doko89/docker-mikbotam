#!/bin/sh

## check database exist
if [ ! -f /data/mibotam.db ]; then
	cp /public_html/config/data.sqlite /data/mibotam.db
fi

chown 777 /data

/usr/bin/supervisord

