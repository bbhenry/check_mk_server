<?php
/*
check_mysql_counters_55.php version 1.0

Licensed under the BSD simplified 2 clause license

Copyright (c) 2013, UniC Solution
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

check_mysql_counters.php - a pnp4nagios template to display performance information captured by the check_mysql_counters nagios plugin inspired by the Percona MySQL cacti templates
Written by Jason Holtzapple - jason@bitflip.net
Modified to work with MRPE by Henry Huang - hhuang@unicsolution.com

*/

$orange    = '#FF9933';
$blue      = '#3E9ADE';
$red       = '#FF3300';
$darkred   = '#990000';
$paleblue  = '#80B4C1';
$yellow    = '#FFCC00';

$num = 1;

$ds_name[$num] = 'Database Activity';
$opt[$num] = "--title  \"$hostname - Database Activity\" --vertical-label \"avg statements/sec\" --units-exponent 0 --lower-limit 0";
$def[$num] = rrd::def('sel', $RRDFILE[85], $DS[85], 'AVERAGE');
$def[$num] .= rrd::def('ins', $RRDFILE[61], $DS[61], 'AVERAGE');
$def[$num] .= rrd::def('upd', $RRDFILE[140], $DS[140], 'AVERAGE');
$def[$num] .= rrd::def('rep', $RRDFILE[76], $DS[76], 'AVERAGE');
$def[$num] .= rrd::def('del', $RRDFILE[40], $DS[40], 'AVERAGE');
$def[$num] .= rrd::def('cal', $RRDFILE[22], $DS[22], 'AVERAGE');
$def[$num] .= rrd::line1('sel',"$orange", rrd::cut('Select', 8));
$def[$num] .= rrd::gprint('sel', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('ins',"$blue", rrd::cut('Insert', 8));
$def[$num] .= rrd::gprint('ins', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('upd',"$red", rrd::cut('Update', 8));
$def[$num] .= rrd::gprint('upd', 'LAST', '%5.0lf\l');
$def[$num] .= rrd::line1('cal',"$yellow", rrd::cut('Call', 8));
$def[$num] .= rrd::gprint('cal', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('del',"$darkred", rrd::cut('Delete', 8));
$def[$num] .= rrd::gprint('del', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('rep',"$paleblue", rrd::cut('Replace', 8));
$def[$num] .= rrd::gprint('rep', 'LAST', '%5.0lf\l');

++$num;

$ds_name[$num] = 'Connections';
$opt[$num] = "--title \"$hostname - Connections\"";
$def[$num] = rrd::def('max_connections', $RRDFILE[1], $DS[283], 'MAX');
$def[$num] .= rrd::def('max_used', $RRDFILE[226], $DS[226], 'MAX');
$def[$num] .= rrd::def('aborted_clients', $RRDFILE[1], $DS[1], 'AVERAGE');
$def[$num] .= rrd::def('aborted_connects', $RRDFILE[2], $DS[2], 'AVERAGE');
$def[$num] .= rrd::def('threads_running', $RRDFILE[280], $DS[280], 'AVERAGE');
$def[$num] .= rrd::def('threads_connected', $RRDFILE[278], $DS[278], 'AVERAGE');
$def[$num] .= rrd::def('connections', $RRDFILE[148], $DS[148], 'AVERAGE');
$label = rrd::cut('Max Connections',23);
$def[$num] .= rrd::area('max_connections','#C0C0C0',$label,0);
$def[$num] .= rrd::gprint('max_connections','AVERAGE',"%4.0lf \\n");
$label = rrd::cut('Max Used',23);
$def[$num] .= rrd::area('max_used','#FFD660',$label,0);
$def[$num] .= rrd::gprint('max_used','AVERAGE',"%4.0lf \\n");
$label = rrd::cut('Aborted Clients',23);
$def[$num] .= rrd::line1('aborted_clients','#FF3932',$label,0);
$def[$num] .= rrd::gprint('aborted_clients',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Aborted Connects',23);
$def[$num] .= rrd::line1('aborted_connects','#00FF00',$label,0);
$def[$num] .= rrd::gprint('aborted_connects',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Threads Running',23);
$def[$num] .= rrd::line1('threads_running','#942D0C',$label,0);
$def[$num] .= rrd::gprint('threads_running',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Threads Connected',23);
$def[$num] .= rrd::line1('threads_connected','#FF7D00',$label,0);
$def[$num] .= rrd::gprint('threads_connected',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('New Connections',23);
$def[$num] .= rrd::line1('connections','#4444ff',$label,0);
$def[$num] .= rrd::gprint('connections',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;

$ds_name[$num] = 'Command Counters';
$opt[$num] = "--title \"$hostname - Command Counters\"";
$def[$num] = rrd::def('questions', $RRDFILE[256], $DS[256], 'AVERAGE');
$def[$num] .= rrd::def('select', $RRDFILE[85], $DS[85], 'AVERAGE');
$def[$num] .= rrd::def('delete', $RRDFILE[40], $DS[40], 'AVERAGE');
$def[$num] .= rrd::def('insert', $RRDFILE[61], $DS[61], 'AVERAGE');
$def[$num] .= rrd::def('update', $RRDFILE[140], $DS[140], 'AVERAGE');
$def[$num] .= rrd::def('replace', $RRDFILE[76], $DS[76], 'AVERAGE');
$def[$num] .= rrd::def('load', $RRDFILE[65], $DS[65], 'AVERAGE');
$def[$num] .= rrd::def('delete_multi', $RRDFILE[41], $DS[41], 'AVERAGE');
$def[$num] .= rrd::def('insert_select', $RRDFILE[62], $DS[62], 'AVERAGE');
$def[$num] .= rrd::def('update_multi', $RRDFILE[141], $DS[141], 'AVERAGE');
$def[$num] .= rrd::def('replace_select', $RRDFILE[77], $DS[77], 'AVERAGE');
$def[$num] .= rrd::area('questions','#FFC3C0',rrd::cut('Questions'),23);
$def[$num] .= rrd::gprint('questions',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('select','#FF0000',rrd::cut('Select'),23,1);
$def[$num] .= rrd::gprint('select',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('delete','#FF7D00',rrd::cut('Delete'),23,1);
$def[$num] .= rrd::gprint('delete',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('insert','#FFF200',rrd::cut('Insert'),23,1);
$def[$num] .= rrd::gprint('insert',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('update','#00CF00',rrd::cut('Update'),23,1);
$def[$num] .= rrd::gprint('update',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('replace','#2175D9',rrd::cut('Replace'),23,1);
$def[$num] .= rrd::gprint('replace',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('load','#55009D',rrd::cut('Load'),23,1);
$def[$num] .= rrd::gprint('load',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('delete_multi','#942D0C',rrd::cut('Delete Multi'),23,1);
$def[$num] .= rrd::gprint('delete_multi',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('insert_select','#AAABA1',rrd::cut('Insert Select'),23,1);
$def[$num] .= rrd::gprint('insert_select',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('update_multi','#D8ACE0',rrd::cut('Update Multi'),23,1);
$def[$num] .= rrd::gprint('update_multi',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('replace_select','#00B99B',rrd::cut('Replace Select'),23,1);
$def[$num] .= rrd::gprint('replace_select',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;


$ds_name[$num] = 'Files and Tables';
$opt[$num] = "--title \"$hostname - Files and Tables\"";
$def[$num] = rrd::def('table_open_cache', $RRDFILE[285], $DS[285], 'AVERAGE');
$def[$num] .= rrd::def('open_tables', $RRDFILE[228], $DS[228], 'AVERAGE');
$def[$num] .= rrd::def('opened_files', $RRDFILE[229], $DS[229], 'AVERAGE');
$def[$num] .= rrd::def('opened_tables', $RRDFILE[231], $DS[231], 'AVERAGE');
$label = rrd::cut('Table Cache',25);
$def[$num] .= rrd::area('table_open_cache','#96E78A',$label,0);
$def[$num] .= rrd::gprint('table_open_cache',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Open Tables',25);
$def[$num] .= rrd::line1('open_tables','#9FA4EE',$label,0);
$def[$num] .= rrd::gprint('open_tables',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Open Files',25);
$def[$num] .= rrd::line1('opened_files','#FFD660',$label,0);
$def[$num] .= rrd::gprint('opened_files',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Opened Tables',25);
$def[$num] .= rrd::line1('opened_tables','#FF0000',$label,0);
$def[$num] .= rrd::gprint('opened_tables',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;

$ds_name[$num] = 'MySQL Handlers';
$opt[$num] = "--title \"$hostname - MySQL Handlers\"";
$def[$num] = rrd::def('handler_write', $RRDFILE[171], $DS[171], 'AVERAGE');
$def[$num] .= rrd::def('handler_update', $RRDFILE[170], $DS[170], 'AVERAGE');
$def[$num] .= rrd::def('handler_delete', $RRDFILE[157], $DS[157], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_first', $RRDFILE[160], $DS[160], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_key', $RRDFILE[161], $DS[161], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_next', $RRDFILE[163], $DS[163], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_prev', $RRDFILE[164], $DS[164], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_rnd', $RRDFILE[165], $DS[165], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_rnd_next', $RRDFILE[166], $DS[166], 'AVERAGE');
$label = rrd::cut('Handler Write',25);
$def[$num] .= rrd::area('handler_write','#605C59',$label,1);
$def[$num] .= rrd::gprint('handler_write',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Update',25);
$def[$num] .= rrd::area('handler_update','#D2AE84',$label,1);
$def[$num] .= rrd::gprint('handler_update',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Delete',25);
$def[$num] .= rrd::area('handler_delete','#C9C5C0',$label,1);
$def[$num] .= rrd::gprint('handler_delete',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read First',25);
$def[$num] .= rrd::area('handler_read_first','#9F3E81',$label,1);
$def[$num] .= rrd::gprint('handler_read_first',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Key',25);
$def[$num] .= rrd::area('handler_read_key','#C6BE91',$label,1);
$def[$num] .= rrd::gprint('handler_read_key',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Next',25);
$def[$num] .= rrd::area('handler_read_next','#CE3F53',$label,1);
$def[$num] .= rrd::gprint('handler_read_next',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Prev',25);
$def[$num] .= rrd::area('handler_read_prev','#FD7F00',$label,1);
$def[$num] .= rrd::gprint('handler_read_prev',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Rnd',25);
$def[$num] .= rrd::area('handler_read_rnd','#6E4E40',$label,1);
$def[$num] .= rrd::gprint('handler_read_rnd',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Rnd Next',25);
$def[$num] .= rrd::area('handler_read_rnd_next','#79DAEC',$label,1);
$def[$num] .= rrd::gprint('handler_read_rnd_next',array('LAST','AVERAGE','MAX'),"%6.0lf");

++$num;

$ds_name[$num] = 'MySQL Query Cache';
$opt[$num] = "--title \"$hostname - MySQL Query Cache\"";
$def[$num] = rrd::def('qcache_queries_in_cache', $RRDFILE[253], $DS[253], 'AVERAGE');
$def[$num] .= rrd::def('qcache_hits', $RRDFILE[249], $DS[249], 'AVERAGE');
$def[$num] .= rrd::def('qcache_inserts', $RRDFILE[253], $DS[253], 'AVERAGE');
$def[$num] .= rrd::def('qcache_not_cached', $RRDFILE[252], $DS[252], 'AVERAGE');
$def[$num] .= rrd::def('qcache_lowmem_prunes', $RRDFILE[251], $DS[251], 'AVERAGE');
$label = rrd::cut('Queries In Cache',25);
$def[$num] .= rrd::line1('qcache_queries_in_cache','#4444FF',$label,0);
$def[$num] .= rrd::gprint('qcache_queries_in_cache',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Cache Hits',25);
$def[$num] .= rrd::line1('qcache_hits','#EAAF00',$label,0);
$def[$num] .= rrd::gprint('qcache_hits',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Inserts',25);
$def[$num] .= rrd::line1('qcache_inserts','#157419',$label,0);
$def[$num] .= rrd::gprint('qcache_inserts',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Not Cached',25);
$def[$num] .= rrd::line1('qcache_not_cached','#00A0C1',$label,0);
$def[$num] .= rrd::gprint('qcache_not_cached',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Low-Memory Prunes',25);
$def[$num] .= rrd::line1('qcache_lowmem_prunes','#FF0000',$label,0);
$def[$num] .= rrd::gprint('qcache_lowmem_prunes',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Prepared Statements';
$opt[$num] = "--title \"$hostname - Prepared Statements\"";
$def[$num] = rrd::def('prepared_stmt_count', $RRDFILE[246], $DS[246], 'AVERAGE');
$label = rrd::cut('Prepared Statement Count',25);
$def[$num] .= rrd::line1('prepared_stmt_count','#4444FF',$label,0);
$def[$num] .= rrd::gprint('prepared_stmt_count',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Select Types';
$opt[$num] = "--title \"$hostname - Select Types\"";
$def[$num] = rrd::def('select_full_join', $RRDFILE[257], $DS[257], 'AVERAGE');
$def[$num] .= rrd::def('select_full_range_join', $RRDFILE[258], $DS[258], 'AVERAGE');
$def[$num] .= rrd::def('select_range', $RRDFILE[259], $DS[259], 'AVERAGE');
$def[$num] .= rrd::def('select_range_check', $RRDFILE[260], $DS[260], 'AVERAGE');
$def[$num] .= rrd::def('select_scan', $RRDFILE[261], $DS[261], 'AVERAGE');
$label = rrd::cut('Full Join',25);
$def[$num] .= rrd::area('select_full_join','#FF0000',$label,1);
$def[$num] .= rrd::gprint('select_full_join',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Full Range',25);
$def[$num] .= rrd::area('select_full_range_join','#FF7D00',$label,1);
$def[$num] .= rrd::gprint('select_full_range_join',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Range',25);
$def[$num] .= rrd::area('select_range','#FFF200',$label,1);
$def[$num] .= rrd::gprint('select_range',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Range Check',25);
$def[$num] .= rrd::area('select_range_check','#00CF00',$label,1);
$def[$num] .= rrd::gprint('select_range_check',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Scan',25);
$def[$num] .= rrd::area('select_scan','#7CB3F1',$label,1);
$def[$num] .= rrd::gprint('select_scan',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Sorts';
$opt[$num] = "--title \"$hostname - Sorts\"";
$def[$num] = rrd::def('sort_rows', $RRDFILE[270], $DS[270], 'AVERAGE');
$def[$num] .= rrd::def('sort_range', $RRDFILE[269], $DS[269], 'AVERAGE');
$def[$num] .= rrd::def('sort_merge_passes', $RRDFILE[268], $DS[268], 'AVERAGE');
$def[$num] .= rrd::def('sort_scan', $RRDFILE[271], $DS[271], 'AVERAGE');
$label = rrd::cut('Rows Sorted',25);
$def[$num] .= rrd::area('sort_rows','#FFAB00',$label,0);
$def[$num] .= rrd::gprint('sort_rows',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Range',25);
$def[$num] .= rrd::line1('sort_range','#157419',$label,0);
$def[$num] .= rrd::gprint('sort_range',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Merge Passes',25);
$def[$num] .= rrd::line1('sort_merge_passes','#DA4725',$label,0);
$def[$num] .= rrd::gprint('sort_merge_passes',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Scan',25);
$def[$num] .= rrd::line1('sort_scan','#4444FF',$label,0);
$def[$num] .= rrd::gprint('sort_scan',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Table Locks';
$opt[$num] = "--title \"$hostname - Table Locks\"";
$def[$num] = rrd::def('table_locks_immediate', $RRDFILE[272], $DS[272], 'AVERAGE');
$def[$num] .= rrd::def('table_locks_waited', $RRDFILE[273], $DS[273], 'AVERAGE');
$label = rrd::cut('Table Locks Immediate',25);
$def[$num] .= rrd::line1('table_locks_immediate','#002A8F',$label,0);
$def[$num] .= rrd::gprint('table_locks_immediate',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Table Locks Waited',25);
$def[$num] .= rrd::line1('table_locks_waited','#FF3932',$label,0);
$def[$num] .= rrd::gprint('table_locks_waited',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Temporary Objects';
$opt[$num] = "--title \"$hostname - Temporary Objects\"";
$def[$num] = rrd::def('created_tmp_tables', $RRDFILE[151], $DS[151], 'AVERAGE');
$def[$num] .= rrd::def('created_tmp_disk_tables', $RRDFILE[149], $DS[149], 'AVERAGE');
$def[$num] .= rrd::def('created_tmp_files', $RRDFILE[150], $DS[150], 'AVERAGE');
$label = rrd::cut('Temp Tables',25);
$def[$num] .= rrd::area('created_tmp_tables','#837C04',$label,0);
$def[$num] .= rrd::gprint('created_tmp_tables',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Temp Disk Tables',25);
$def[$num] .= rrd::line1('created_tmp_disk_tables','#F51D30',$label,0);
$def[$num] .= rrd::gprint('created_tmp_disk_tables',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Temp Files',25);
$def[$num] .= rrd::line1('created_tmp_files','#157419',$label,0);
$def[$num] .= rrd::gprint('created_tmp_files',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Transaction Handler';
$opt[$num] = "--title \"$hostname - Transaction Handler\"";
$def[$num] = rrd::def('handler_commit', $RRDFILE[156], $DS[156], 'AVERAGE');
$def[$num] .= rrd::def('handler_rollback', $RRDFILE[167], $DS[167], 'AVERAGE');
$def[$num] .= rrd::def('handler_savepoint', $RRDFILE[168], $DS[168], 'AVERAGE');
$def[$num] .= rrd::def('handler_savepoint_rollback', $RRDFILE[169], $DS[169], 'AVERAGE');
$label = rrd::cut('Handler Commit',26);
$def[$num] .= rrd::line1('handler_commit','#DE0056',$label,0);
$def[$num] .= rrd::gprint('handler_commit',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Handler Rollback',26);
$def[$num] .= rrd::line1('handler_rollback','#784890',$label,0);
$def[$num] .= rrd::gprint('handler_rollback',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Handler Savepoint',26);
$def[$num] .= rrd::line1('handler_savepoint','#D1642E',$label,0);
$def[$num] .= rrd::gprint('handler_savepoint',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Handler Savepoint Rollback',26);
$def[$num] .= rrd::line1('handler_savepoint_rollback','#487860',$label,0);

$def[$num] .= rrd::gprint('handler_savepoint_rollback',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'InnoDB Buffer Pool';
$opt[$num] = "--title \"$hostname - InnoDB Buffer Pool\"";
$def[$num] = rrd::def('innodb_buffer_pool_pages_total', $RRDFILE[177], $DS[177], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_pages_data', $RRDFILE[172], $DS[172], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_pages_free', $RRDFILE[175], $DS[175], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_pages_dirty', $RRDFILE[173], $DS[173], 'AVERAGE');
$label = rrd::cut('Pool Size',25);
$def[$num] .= rrd::area('innodb_buffer_pool_pages_total','#3D1500',$label,0);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_total',array('LAST'),"%.1lf%S");
$label = rrd::cut('Database Pages',25);
$def[$num] .= rrd::area('innodb_buffer_pool_pages_data','#EDAA41',$label,0);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_data',array('LAST','AVERAGE','MAX'),"%.1lf%S");
$label = rrd::cut('Free Pages',25);
$def[$num] .= rrd::area('innodb_buffer_pool_pages_free','#AA3B27',$label,1);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_free',array('LAST','AVERAGE','MAX'),"%.1lf%S");
$label = rrd::cut('Modified Pages',25);
$def[$num] .= rrd::line1('innodb_buffer_pool_pages_dirty','#13343B',$label,0);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_dirty',array('LAST','AVERAGE','MAX'),"%.1lf%S");

++$num;

$ds_name[$num] = 'InnoDB Buffer Pool Activity';
$opt[$num] = "--title \"$hostname - InnoDB Buffer Pool Activity\"";
$def[$num] = rrd::def('innodb_pages_created', $RRDFILE[202], $DS[202], 'AVERAGE');
$def[$num] .= rrd::def('innodb_pages_read', $RRDFILE[203], $DS[203], 'AVERAGE');
$def[$num] .= rrd::def('innodb_pages_written', $RRDFILE[204], $DS[204], 'AVERAGE');
$label = rrd::cut('Pages Created',25);
$def[$num] .= rrd::line1('innodb_pages_created','#D6883A',$label);
$def[$num] .= rrd::gprint('innodb_pages_created',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Pages Read',25);
$def[$num] .= rrd::line1('innodb_pages_read','#E6D883',$label);
$def[$num] .= rrd::gprint('innodb_pages_read',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Pages Written',25);
$def[$num] .= rrd::line1('innodb_pages_written','#55AD84',$label);
$def[$num] .= rrd::gprint('innodb_pages_written',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'InnoDB Buffer Pool Efficiency';
$opt[$num] = "--title \"$hostname - InnoDB Buffer Pool Efficiency\"";
$def[$num] = rrd::def('innodb_buffer_pool_read_requests', $RRDFILE[181], $DS[181], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_reads', $RRDFILE[182], $DS[182], 'AVERAGE');
$label = rrd::cut('Pool Read Requests',20);
$def[$num] .= rrd::line1('innodb_buffer_pool_read_requests','#6EA100',$label);
$def[$num] .= rrd::gprint('innodb_buffer_pool_read_requests',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Pool Reads',20);
$def[$num] .= rrd::line1('innodb_buffer_pool_reads','#AA3B27',$label);
$def[$num] .= rrd::gprint('innodb_buffer_pool_reads',array('LAST','AVERAGE','MAX'),"%6.0lf");

++$num;

$ds_name[$num] = 'InnoDB I/O';
$opt[$num] = "--title \"$hostname - InnoDB I/O\"";
$def[$num] = rrd::def('innodb_data_reads', $RRDFILE[190], $DS[190], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_writes', $RRDFILE[191], $DS[191], 'AVERAGE');
$def[$num] .= rrd::def('innodb_log_writes', $RRDFILE[197], $DS[197], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_fsyncs', $RRDFILE[185], $DS[185], 'AVERAGE');
$label = rrd::cut('File Reads',25);
$def[$num] .= rrd::area('innodb_data_reads','#ED7600',$label,0);
$def[$num] .= rrd::gprint('innodb_data_reads',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('File Writes',25);
$def[$num] .= rrd::area('innodb_data_writes','#157419',$label,1);
$def[$num] .= rrd::gprint('innodb_data_writes',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Log Writes',25);
$def[$num] .= rrd::area('innodb_log_writes','#DA4725',$label,1);
$def[$num] .= rrd::gprint('innodb_log_writes',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('File Syncs',25);
$def[$num] .= rrd::area('innodb_data_fsyncs','#4444FF',$label,1);
$def[$num] .= rrd::gprint('innodb_data_fsyncs',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB I/O Pending';
$opt[$num] = "--title \"$hostname - InnoDB I/O Pending\"";
$def[$num] = rrd::def('innodb_data_pending_fsyncs', $RRDFILE[186], $DS[186], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_pending_reads', $RRDFILE[187], $DS[187], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_pending_writes', $RRDFILE[188], $DS[188], 'AVERAGE');
$label = rrd::cut('AIO Sync',25);
$def[$num] .= rrd::area('innodb_data_pending_fsyncs','#FF7D00',$label,0);
$def[$num] .= rrd::gprint('innodb_data_pending_fsyncs',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Normal AIO Reads',25);
$def[$num] .= rrd::area('innodb_data_pending_reads','#B90054',$label,0);
$def[$num] .= rrd::gprint('innodb_data_pending_reads',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Normal AIO Writes',25);
$def[$num] .= rrd::area('innodb_data_pending_writes','#8F9286',$label,0);
$def[$num] .= rrd::gprint('innodb_data_pending_writes',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB Row Lock Time';
$opt[$num] = "--title \"$hostname - InnoDB Row Lock Time\"";
$def[$num] = rrd::def('innodb_row_lock_time', $RRDFILE[206], $DS[206], 'AVERAGE');
$label = rrd::cut('InnoDB Row Lock Time',25);
$def[$num] .= rrd::area('innodb_row_lock_time','#B11D03',$label,0);
$def[$num] .= rrd::gprint('innodb_row_lock_time',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB Row Lock Waits';
$opt[$num] = "--title \"$hostname - InnoDB Row Lock Waits\"";
$def[$num] = rrd::def('innodb_row_lock_waits', $RRDFILE[209], $DS[209], 'AVERAGE');
$label = rrd::cut('InnoDB Row Lock Waits',25);
$def[$num] .= rrd::area('innodb_row_lock_waits','#E84A5F',$label,0);
$def[$num] .= rrd::gprint('innodb_row_lock_waits',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB Row Operations';
$opt[$num] = "--title \"$hostname - InnoDB Row Operations\"";
$def[$num] = rrd::def('innodb_rows_read', $RRDFILE[212], $DS[212], 'AVERAGE');
$def[$num] .= rrd::def('innodb_rows_deleted', $RRDFILE[210], $DS[210], 'AVERAGE');
$def[$num] .= rrd::def('innodb_rows_updated', $RRDFILE[213], $DS[213], 'AVERAGE');
$def[$num] .= rrd::def('innodb_rows_inserted', $RRDFILE[211], $DS[211], 'AVERAGE');
$label = rrd::cut('Reads',10);
$def[$num] .= rrd::area('innodb_rows_read','#AFECED',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_read',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Deletes',10);
$def[$num] .= rrd::area('innodb_rows_deleted','#DA4725',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_deleted',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Updates',10);
$def[$num] .= rrd::area('innodb_rows_updated','#EA8F00',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_updated',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Inserts',10);
$def[$num] .= rrd::area('innodb_rows_inserted','#35962B',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_inserted',array('LAST','AVERAGE','MAX'),"%.1lf");

?>
