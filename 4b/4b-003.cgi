#!/usr/bin/perl
print "Content-Type: text/plain\n\n";
open FL, '/bin/pwd|' or die $!;
print <FL>;
close FL;
