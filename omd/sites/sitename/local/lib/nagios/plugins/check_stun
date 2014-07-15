#!/usr/bin/perl

###############################################################################
##                                                                           ##
##    check_stun nagios check                                                ##
##    Copyleft Roy Sigurd Karlsbakk <roy@karlsbakk.net>                      ##
##    Licensed under GPL v2                                                  ##
##                                                                           ##
##                                                 have fun :)               ##
##                                                                           ##
###############################################################################
use strict;
use warnings;

my ($exitcode,$res,$resstr);
my $stun_client = "/usr/bin/stun";
my $stun_server = shift or
	die "Syntax: $0 stun_server";

open STUN_CLIENT,"$stun_client $stun_server|" or
	die "Can't run stun client: $!\n";

$/=undef; # slurp mode

my $stun_output = <STUN_CLIENT>;
$stun_output =~ s/[\s\r\n]+/ /g;
close STUN_CLIENT;

if ($stun_output =~ m/Primary:\s+(\w+)/) {
	$res = $1;
} else {
	print "Unable to parse stun client output";
	exit 3;
}

if ($res eq "Open") {
	$resstr = "OK";
	$exitcode = 0;
} elsif ($res eq "Blocked") {
	$resstr = "CRITICAL";
	$exitcode = 2;
} else {
	$resstr = "UNKNOWN";
	$exitcode = 3;
}

print $resstr . ": STUN probe returned \"$res\"\n";

exit $exitcode;
