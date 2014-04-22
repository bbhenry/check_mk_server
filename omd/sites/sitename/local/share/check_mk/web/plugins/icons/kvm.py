#!/usr/bin/python
# encoding: utf-8

def paint_kvm_icon(what, row, tags, custom_vars):
    if what == 'service':
       if row['service_description'].startswith('VM '):

           url = 'http://omd.phone.com/monitor/check_mk/view.py?view_name=host&site=&host=%s' % row['service_description'][3:]

           return '<a href="%s" title="Service Checks">' \
                  '<img class=icon src="images/icons/kwikdisk.png"/></a>' % (url)

multisite_icons.append({
    'paint':           paint_kvm_icon,
    'host_columns':    [ 'address' ],
    'service_columns': [ 'host_address' ],
})
