#!/usr/bin/perl

#use strict;
#use warnings;
use FindBin;

use lib "$FindBin::Bin/../lib"; # Хороший тон: держим исполняемый файл в bin,
                                # а библиотеки (пакеты) - в lib, и т.д.
use Net::Server::smdr;

if((defined($ARGV[0]))&&($ARGV[0] eq 'start'))
{
	# Создаем экземпляр своего сервера; параметры, кстати, можно задавать в командной строке
	our $server = Net::Server::smdr->new(conf_file => "$FindBin::Bin/../etc/smdr.cfg"); 
	$server->run(); # Поехали!
}
elsif( defined($ARGV[0]) && (($ARGV[0] eq 'stop')||($ARGV[0] eq 'kill')) )
{
	qx(/usr/bin/killall smdrsrv.pl);
}
elsif(defined($ARGV[0])&&($ARGV[0] eq 'status'))
{
	for(qx(/bin/ps -ef)){print if(m/smdrsrv.pl\sstart/g)}

}
elsif(defined($ARGV[0])&&($ARGV[0] eq 'restart'))
{
        #qx($FindBin::Bin/smdrsrv.pl stop);
	#usleep(1000);
	#qx($FindBin::Bin/smdrsrv.pl start);
}
else
{
print 'Usage:
	status
	start
	stop
	help
';

}

