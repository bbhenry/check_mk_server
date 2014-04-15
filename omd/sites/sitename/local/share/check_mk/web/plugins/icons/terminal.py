#!/usr/bin/python
# encoding: utf-8

def paint_terminal_icon(what, row, tags, custom_vars):
    if what != 'host':
        return

    url = 'ssh://nexus9@%s:8622/' % row['host_address']
    return u'<a href="%s" target="_top" title="ssh terminal">' \
           '<img class=icon src="images/icons/terminal.png"/></a>' % (url)

multisite_icons.append({
    'paint':           paint_terminal_icon,
    'host_columns':    [ 'address' ],
    'service_columns': [ 'host_address' ],
})
