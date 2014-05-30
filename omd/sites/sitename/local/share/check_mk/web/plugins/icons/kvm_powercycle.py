#!/usr/bin/python
# encoding: utf-8

def paint_kvmpowercycle_icon(what, row, tags, custom_vars):
    if what == 'service':
       if row['service_description'].startswith('VM '):

           url = 'http://%s:8000/powercycle/%s/' % (row['host_address'],row['service_description'][3:])

           return '<a href="%s" onClick="return confirm(\'Are you sure you want to powercycle %s?\')" title="Powercycle KVM Guest Server">' \
                  '<img class=icon src="images/icons/energy.png"/></a>' % ((url), row['service_description'][3:])

multisite_icons.append({
    'paint':           paint_kvmpowercycle_icon,
    'host_columns':    [ 'address' ],
    'service_columns': [ 'host_address' ],
})
