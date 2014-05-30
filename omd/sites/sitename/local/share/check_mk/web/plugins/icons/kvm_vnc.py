#!/usr/bin/python
# encoding: utf-8

def paint_kvmvnc_icon(what, row, tags, custom_vars):
    if what == 'service':
       if row['service_description'].startswith('VM '):

           url = 'http://%s:8000/vnc/%s/' % (row['host_address'],row['service_description'][3:])

           return '<a href="%s" title="VNC to KVM Guest Server">' \
                  '<img class=icon src="images/icons/ksplash.png"/></a>' % (url)

multisite_icons.append({
    'paint':           paint_kvmvnc_icon,
    'host_columns':    [ 'address' ],
    'service_columns': [ 'host_address' ],
})
