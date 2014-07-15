#!/usr/bin/perl -w
#
# check_sip_registrtion: Nagios plugin for checking SIP registration using sipsak.
# Henry Huang
# no warranty, licensed MIT
#

use strict;
use Getopt::Long;
use vars qw($PROGNAME $warning $url $host $password);
use lib "~/local/lib/nagios/plugins/";
use utils qw(%ERRORS &print_revision &support &usage);
$PROGNAME="check_sip_registration";
sub print_help ();
sub print_usage ();
my $sig;

# Calling sipsak and try to register to a SIP server
$sig = `/usr/bin/sipsak @ARGV`;

# Analyze check result and format output for Nagios
if ($sig =~ m/SIP ok/ && $sig =~ m/received last message ([0-9\.]+) ms/) {
  printf ("Registration OK - Duration is %.2f ms | registration_time=%.2fms;;;;\n",$1,$1);
  exit $ERRORS{'OK'};
}

if ($sig =~ m/SIP failure/ && $sig =~ m/SIP\/2.0 ([0-9\.]+.*)/ ) {
  printf ("CRITICAL - Registration failed. SIP $+\n");
  exit $ERRORS{'CRITICAL'};
}
