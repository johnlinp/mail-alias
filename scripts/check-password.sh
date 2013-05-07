#!/usr/bin/expect -f

set username [lrange $argv 0 0]
set password [lrange $argv 1 1]

set timeout -1

spawn ssh -q $username@disa.csie.org whoami

expect {
    "*Are you sure*" { send -- "yes\r"; exp_continue }
    "*?assword:*" { send -- "$password\r"; }
}

send -- "\r"

expect {
    eof { exit }
    "*?assword:*" { exit }
}

