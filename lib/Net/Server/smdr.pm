#!/usr/bin/perl

package Net::Server::smdr; # Объявляем свой пакет
use DBI;
use strict; # Так в книжке написано ;)
use warnings;
use base qw(Net::Server::PreFork); # Наследуем
#use base qw(Net::Server::Single); # Наследуем

my $dbhost = 'localhost';
my $dbname = 'smdr';
my $dbuser = 'root';
my $dbpass = 'smdr';

#
sub process_request {   # Собственно, здесь и выполняется вся работа с запросом
   my $self = shift;    # Получаем ссылку на себя. Это Perl ООП-магия

   open FH, ">>var/log/smdr.log"; # лог файл

   while (<STDIN>) {    # Net::Server дает нам сокет как STDIN + STDOUT!
   	print FH "$_\n";

	s/\r?\n$//;

        my ($CallStart, $ConnectedTime, $RingTime, $Caller, $Direction, $CalledNumber,
         $DialledNumber, $Account, $IsInternal, $CallID, $Continuation, $Party1Device,
         $Party1Name, $Party2Device, $Party2Name, $HoldTime, $ParkTime, $AuthValid,
         $AuthCode, $UserCharged, $CallCharge, $Currency, $AmountatLastUserChange,
         $CallUnits, $UnitsatLastUserChange, $CostperUnit, $MarkUp, $ExternalTargetingCause,
         $ExternalTargeterId, $ExternalTargetedNumber) = split /\,/;


        $CallStart =~ s/\//-/g;
        my ($h,$m,$s) = split /\:/, $ConnectedTime;
        $ConnectedTime = $h*3600+$m*60+$s;
        $RingTime = 0 if $RingTime eq '';
        $IsInternal = 0 if $IsInternal eq '';
        $CallID = 0 if $CallID eq '';
        $Continuation = 0 if $Continuation eq '';
        $HoldTime = 0 if $HoldTime eq '';
        $ParkTime = 0 if $ParkTime eq '';
        $AuthValid = 0 if $AuthValid eq '';

        my $dbh = DBI->connect('DBI:mysql:'.$dbname.':'.$dbhost,$dbuser,$dbpass,{RaiseError => 1}) or print STDERR "connecting: $DBI::errstr\n";
        $dbh->do("SET NAMES UTF8");

        my $cmd = "insert into smdr set ".
                  "CallStart = '$CallStart',".
                  "ConnectedTime = $ConnectedTime,".
                  "RingTime = $RingTime,".
                  "Caller = '$Caller',".
                  "Direction = '$Direction',".
                  "CalledNumber = '$CalledNumber',".
                  "DialledNumber = '$DialledNumber',".
                  "Account = '$Account',".
                  "IsInternal = $IsInternal,".
                  "CallID = $CallID,".
                  "Continuation = $Continuation,".
                  "Party1Device = '$Party1Device',".
                  "Party1Name = '$Party1Name',".
                  "Party2Device = '$Party2Device',".
                  "Party2Name = '$Party2Name',".
                  "HoldTime = $HoldTime,".
                  "ParkTime = $ParkTime,".
                  "AuthValid = $AuthValid,".
                  "AuthCode = '$AuthCode',".
                  "UserCharged = '$UserCharged',".
                  "CallCharge = '$CallCharge',".
                  "Currency = '$Currency',".
                  "AmountatLastUserChange = '$AmountatLastUserChange',".
                  "CallUnits = '$CallUnits',".
                  "UnitsatLastUserChange = '$UnitsatLastUserChange',".
                  "CostperUnit = '$CostperUnit',".
                  "MarkUp = '$MarkUp',".
                  "ExternalTargetingCause = '$ExternalTargetingCause',".
                  "ExternalTargeterId = '$ExternalTargeterId',".
                  "ExternalTargetedNumber = '$ExternalTargetedNumber'";

        print FH " $cmd\n";
	
	#if( $RingTime >= 3 && $ConnectedTime == 0 && ( $CalledNumber == 3020 || $CalledNumber == 4020 || $CalledNumber == 7020 ) ){
	if( $ConnectedTime eq '0' && $RingTime > 2 && $Caller =~ /^8*/ && ( $CalledNumber == 3020 || $CalledNumber == 4020 || $CalledNumber == 7020 ) ){
		qx(/usr/bin/mailx -s "[Missed call] $CallStart, $Caller -> $CalledNumber" kav\@at-consulting.ru vkarmanov\@at-consulting.ru < /dev/null );
		#print FH "------------------ =)) -------------------------";
	}

        my $sth = $dbh->do($cmd);
        last if /quit/i;


   }

   close FH;

}

1; # Perl-магия: пакет должен иметь return
