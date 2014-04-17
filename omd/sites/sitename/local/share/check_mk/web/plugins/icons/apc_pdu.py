#!/usr/bin/python
# encoding: utf-8

def paint_pdu_icon(what, row, tags, custom_vars):
    if what == 'service':
       if row['service_description'].startswith('Power Outlet'):

           url = 'http://%s/outlctrl.htm' % row['host_address']

           return '<a href="%s" target="_blank" title="PDU Control Panel">' \
                  '<img class=icon src="images/icons/energy.png"/></a>' % (url)

multisite_icons.append({
    'paint':           paint_pdu_icon,
    'host_columns':    [ 'address' ],
    'service_columns': [ 'host_address' ],
})
