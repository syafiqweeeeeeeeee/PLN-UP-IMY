# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#260915  7:56:19 server id 1  end_log_pos 126 CRC32 0x2ef9af19 	Start: binlog v 4, server v 8.0.30 created 260915  7:56:19 at startup
ROLLBACK/*!*/;
BINLOG '
s5eoag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAACzl6hqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAARmv+S4=
'/*!*/;
# at 126
#260915  7:56:19 server id 1  end_log_pos 157 CRC32 0x18e821da 	Previous-GTIDs
# [empty]
# at 157
#260915  7:57:05 server id 1  end_log_pos 236 CRC32 0xcd09e900 	Anonymous_GTID	last_committed=0	sequence_number=1	rbr_only=yes	original_committed_timestamp=1789433825858482	immediate_commit_timestamp=1789433825858482	transaction_length=746
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433825858482 (2026-09-15 07:57:05.858482 SE Asia Standard Time)
# immediate_commit_timestamp=1789433825858482 (2026-09-15 07:57:05.858482 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433825858482*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236
#260915  7:57:05 server id 1  end_log_pos 317 CRC32 0x632a4f73 	Query	thread_id=8	exec_time=0	error_code=0
SET TIMESTAMP=1789433825/*!*/;
SET @@session.pseudo_thread_id=8/*!*/;
SET @@session.foreign_key_checks=1, @@session.sql_auto_is_null=0, @@session.unique_checks=1, @@session.autocommit=1/*!*/;
SET @@session.sql_mode=1168113696/*!*/;
SET @@session.auto_increment_increment=1, @@session.auto_increment_offset=1/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=224,@@session.collation_connection=224,@@session.collation_server=255/*!*/;
SET @@session.lc_time_names=0/*!*/;
SET @@session.collation_database=DEFAULT/*!*/;
/*!80011 SET @@session.default_collation_for_utf8mb4=255*//*!*/;
BEGIN
/*!*/;
# at 317
#260915  7:57:05 server id 1  end_log_pos 391 CRC32 0x603f4eed 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 391
#260915  7:57:05 server id 1  end_log_pos 872 CRC32 0xffa5973c 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
4ZeoahMBAAAASgAAAIcBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O1OP2A=
4Zeoah4BAAAA4QEAAGgDAAAAAFMAAAAAAAEAAgAG/wIoAFVjcFFHQU92OGN0QnVaWnpCNnA1Q3Rp
Tzk0dTMzdmxJZVFsbktyeEcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lSa1JOYURkWldYSTBWR3R5TnpSU1dFRm9WbWhQVWxOaVJrWlRNelkzVGxabVF6VkxZV3RX
WnlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElq
dDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWZRPT3hl6hqPJel/w==
'/*!*/;
# at 872
#260915  7:57:05 server id 1  end_log_pos 903 CRC32 0xfe753b9f 	Xid = 11
COMMIT/*!*/;
# at 903
#260915  7:57:09 server id 1  end_log_pos 982 CRC32 0x885559df 	Anonymous_GTID	last_committed=1	sequence_number=2	rbr_only=yes	original_committed_timestamp=1789433829050540	immediate_commit_timestamp=1789433829050540	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433829050540 (2026-09-15 07:57:09.050540 SE Asia Standard Time)
# immediate_commit_timestamp=1789433829050540 (2026-09-15 07:57:09.050540 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433829050540*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 982
#260915  7:57:09 server id 1  end_log_pos 1072 CRC32 0x1dbbffdf 	Query	thread_id=9	exec_time=0	error_code=0
SET TIMESTAMP=1789433829/*!*/;
BEGIN
/*!*/;
# at 1072
#260915  7:57:09 server id 1  end_log_pos 1146 CRC32 0x875711d2 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 1146
#260915  7:57:09 server id 1  end_log_pos 2090 CRC32 0x24f6c415 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
5ZeoahMBAAAASgAAAHoEAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NIRV4c=
5Zeoah8BAAAAsAMAACoIAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUmtSTmFEZFpXWEkwVkd0eU56UlNXRUZvVm1oUFVsTmlSa1pUTXpZM1RsWm1RelZMWVd0
V1p5STdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT094ZeoagIoAFVjcFFHQU92OGN0QnVaWnpCNnA1Q3RpTzk0dTMzdmxJ
ZVFsbktyeEcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSa1JO
YURkWldYSTBWR3R5TnpSU1dFRm9WbWhQVWxOaVJrWlRNelkzVGxabVF6VkxZV3RXWnlJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lK
c2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6
T2pNNkltNWxkeUk3WVRvd09udDlmWDA95ZeoahXE9iQ=
'/*!*/;
# at 2090
#260915  7:57:09 server id 1  end_log_pos 2121 CRC32 0xd437816d 	Xid = 20
COMMIT/*!*/;
# at 2121
#260915  7:57:24 server id 1  end_log_pos 2200 CRC32 0x9239c8c7 	Anonymous_GTID	last_committed=2	sequence_number=3	rbr_only=yes	original_committed_timestamp=1789433844076002	immediate_commit_timestamp=1789433844076002	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433844076002 (2026-09-15 07:57:24.076002 SE Asia Standard Time)
# immediate_commit_timestamp=1789433844076002 (2026-09-15 07:57:24.076002 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433844076002*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2200
#260915  7:57:24 server id 1  end_log_pos 2281 CRC32 0x651ca762 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789433844/*!*/;
BEGIN
/*!*/;
# at 2281
#260915  7:57:24 server id 1  end_log_pos 2355 CRC32 0x8e91b9fc 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 2355
#260915  7:57:24 server id 1  end_log_pos 2852 CRC32 0x108b4fd9 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
9JeoahMBAAAASgAAADMJAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Py5kY4=
9JeoaiABAAAA8QEAACQLAAAAAFMAAAAAAAEAAgAG/wIoAFVjcFFHQU92OGN0QnVaWnpCNnA1Q3Rp
Tzk0dTMzdmxJZVFsbktyeEcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lSa1JOYURkWldYSTBWR3R5TnpSU1dFRm9WbWhQVWxOaVJrWlRNelkzVGxabVF6VkxZV3RX
WnlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA95ZeoatlPixA=
'/*!*/;
# at 2852
#260915  7:57:24 server id 1  end_log_pos 2883 CRC32 0x8ab5daab 	Xid = 32
COMMIT/*!*/;
# at 2883
#260915  7:57:24 server id 1  end_log_pos 2962 CRC32 0xcb84a89f 	Anonymous_GTID	last_committed=3	sequence_number=4	rbr_only=yes	original_committed_timestamp=1789433844103002	immediate_commit_timestamp=1789433844103002	transaction_length=586
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433844103002 (2026-09-15 07:57:24.103002 SE Asia Standard Time)
# immediate_commit_timestamp=1789433844103002 (2026-09-15 07:57:24.103002 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433844103002*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2962
#260915  7:57:24 server id 1  end_log_pos 3051 CRC32 0x7c305db2 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789433844/*!*/;
SET @@session.time_zone='SYSTEM'/*!*/;
BEGIN
/*!*/;
# at 3051
#260915  7:57:24 server id 1  end_log_pos 3149 CRC32 0xf753a88b 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 88
# at 3149
#260915  7:57:24 server id 1  end_log_pos 3438 CRC32 0x9852e9d6 	Write_rows: table id 88 flags: STMT_END_F

BINLOG '
9JeoahMBAAAAYgAAAE0MAAAAAFgAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4IuoU/c=
9Jeoah4BAAAAIQEAAG4NAAAAAFgAAAAAAAEAAgAN//8AAAEAAAAAAAAABAAAAAAAAAAPAEJ1ZGkg
U2FudG9zbyBKcggAS2FyeWF3YW4LAGF1dGVudGlrYXNpBQBsb2dpbh4AbWVsYWt1a2FuIGxvZ2lu
IGtlIHBhbmVsIGFkbWluDwBBcHBcTW9kZWxzXFVzZXIEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemls
bGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAo
S0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNmqoNYRqqDWE
1ulSmA==
'/*!*/;
# at 3438
#260915  7:57:24 server id 1  end_log_pos 3469 CRC32 0xad8e4f06 	Xid = 35
COMMIT/*!*/;
# at 3469
#260915  7:57:24 server id 1  end_log_pos 3548 CRC32 0xa166d73e 	Anonymous_GTID	last_committed=4	sequence_number=5	rbr_only=yes	original_committed_timestamp=1789433844171034	immediate_commit_timestamp=1789433844171034	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433844171034 (2026-09-15 07:57:24.171034 SE Asia Standard Time)
# immediate_commit_timestamp=1789433844171034 (2026-09-15 07:57:24.171034 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433844171034*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3548
#260915  7:57:24 server id 1  end_log_pos 3629 CRC32 0x30f40ca5 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789433844/*!*/;
BEGIN
/*!*/;
# at 3629
#260915  7:57:24 server id 1  end_log_pos 3703 CRC32 0x20d00d0c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 3703
#260915  7:57:24 server id 1  end_log_pos 4292 CRC32 0xf2d42c63 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
9JeoahMBAAAASgAAAHcOAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AwN0CA=
9Jeoah4BAAAATQIAAMQQAAAAAFMAAAAAAAEAAgAG/wAoAFVabjZFMVEzWHZsOWcwM3I1TWhlQUph
NVAwMG9PeEdPVEs3dmNZSTEEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaU16ZFRaRTVTTUVKSWJ6TlFSa3MxVXpKRmJYcHNaMWxHVFdaQ2RsWkpSalJw
WjNGaVoxVndNaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT30l6hqYyzU8g==
'/*!*/;
# at 4292
#260915  7:57:24 server id 1  end_log_pos 4323 CRC32 0x88234fc3 	Xid = 41
COMMIT/*!*/;
# at 4323
#260915  7:57:24 server id 1  end_log_pos 4402 CRC32 0x3903d186 	Anonymous_GTID	last_committed=5	sequence_number=6	rbr_only=yes	original_committed_timestamp=1789433844561449	immediate_commit_timestamp=1789433844561449	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433844561449 (2026-09-15 07:57:24.561449 SE Asia Standard Time)
# immediate_commit_timestamp=1789433844561449 (2026-09-15 07:57:24.561449 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433844561449*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4402
#260915  7:57:24 server id 1  end_log_pos 4483 CRC32 0x08173080 	Query	thread_id=11	exec_time=0	error_code=0
SET TIMESTAMP=1789433844/*!*/;
BEGIN
/*!*/;
# at 4483
#260915  7:57:24 server id 1  end_log_pos 4557 CRC32 0x7ba68e80 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 4557
#260915  7:57:24 server id 1  end_log_pos 4926 CRC32 0x06b3c736 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
9JeoahMBAAAASgAAAM0RAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ICOpns=
9Jeoah4BAAAAcQEAAD4TAAAAAFMAAAAAAAEAAgAG/wIoAFVjcFFHQU92OGN0QnVaWnpCNnA1Q3Rp
Tzk0dTMzdmxJZVFsbktyeEcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lkVnByYVRoT2NYTjBUbXhuZVdKNGQzVnlNbHBqYVZoVlVIbFlRak5HYlVkdFMxUXlSMmRJ
UnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PfSXqGo2x7MG
'/*!*/;
# at 4926
#260915  7:57:24 server id 1  end_log_pos 4957 CRC32 0xfdc3f9bf 	Xid = 53
COMMIT/*!*/;
# at 4957
#260915  7:57:25 server id 1  end_log_pos 5036 CRC32 0x2edc7235 	Anonymous_GTID	last_committed=6	sequence_number=7	rbr_only=yes	original_committed_timestamp=1789433845090993	immediate_commit_timestamp=1789433845090993	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433845090993 (2026-09-15 07:57:25.090993 SE Asia Standard Time)
# immediate_commit_timestamp=1789433845090993 (2026-09-15 07:57:25.090993 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433845090993*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5036
#260915  7:57:25 server id 1  end_log_pos 5126 CRC32 0x2df782ab 	Query	thread_id=14	exec_time=0	error_code=0
SET TIMESTAMP=1789433845/*!*/;
BEGIN
/*!*/;
# at 5126
#260915  7:57:25 server id 1  end_log_pos 5200 CRC32 0x44f8c87e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 5200
#260915  7:57:25 server id 1  end_log_pos 5904 CRC32 0xb4a4bb75 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
9ZeoahMBAAAASgAAAFAUAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4H7I+EQ=
9Zeoah8BAAAAwAIAABAXAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pZFZwcmFUaE9jWE4wVG14bmVXSjRkM1Z5TWxwamFWaFZVSGxZUWpOR2JVZHRTMVF5UjJk
SVJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT30l6hqAigAVWNwUUdBT3Y4Y3RCdVpaekI2cDVDdGlPOTR1MzN2
bEllUWxuS3J4RwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRW
cHJhVGhPY1hOMFRteG5lV0o0ZDNWeU1scGphVmhWVUhsWVFqTkdiVWR0UzFReVIyZElSeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT099ZeoanW7pLQ=
'/*!*/;
# at 5904
#260915  7:57:25 server id 1  end_log_pos 5935 CRC32 0xc0fc515f 	Xid = 80
COMMIT/*!*/;
# at 5935
#260915  7:57:26 server id 1  end_log_pos 6014 CRC32 0x4ebc630d 	Anonymous_GTID	last_committed=7	sequence_number=8	rbr_only=yes	original_committed_timestamp=1789433846028531	immediate_commit_timestamp=1789433846028531	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433846028531 (2026-09-15 07:57:26.028531 SE Asia Standard Time)
# immediate_commit_timestamp=1789433846028531 (2026-09-15 07:57:26.028531 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433846028531*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 6014
#260915  7:57:26 server id 1  end_log_pos 6104 CRC32 0x23ceb2cc 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1789433846/*!*/;
BEGIN
/*!*/;
# at 6104
#260915  7:57:26 server id 1  end_log_pos 6178 CRC32 0x6a9e13a9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 6178
#260915  7:57:26 server id 1  end_log_pos 6882 CRC32 0x393f9a5b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
9peoahMBAAAASgAAACIYAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KkTnmo=
9peoah8BAAAAwAIAAOIaAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pZFZwcmFUaE9jWE4wVG14bmVXSjRkM1Z5TWxwamFWaFZVSGxZUWpOR2JVZHRTMVF5UjJk
SVJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT31l6hqAigAVWNwUUdBT3Y4Y3RCdVpaekI2cDVDdGlPOTR1MzN2
bEllUWxuS3J4RwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRW
cHJhVGhPY1hOMFRteG5lV0o0ZDNWeU1scGphVmhWVUhsWVFqTkdiVWR0UzFReVIyZElSeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT099peoaluaPzk=
'/*!*/;
# at 6882
#260915  7:57:26 server id 1  end_log_pos 6913 CRC32 0x8d5e9fb8 	Xid = 125
COMMIT/*!*/;
# at 6913
#260915  7:57:27 server id 1  end_log_pos 6992 CRC32 0xb1d9bdcf 	Anonymous_GTID	last_committed=8	sequence_number=9	rbr_only=yes	original_committed_timestamp=1789433847053278	immediate_commit_timestamp=1789433847053278	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433847053278 (2026-09-15 07:57:27.053278 SE Asia Standard Time)
# immediate_commit_timestamp=1789433847053278 (2026-09-15 07:57:27.053278 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433847053278*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 6992
#260915  7:57:27 server id 1  end_log_pos 7082 CRC32 0xf73cc5a6 	Query	thread_id=25	exec_time=0	error_code=0
SET TIMESTAMP=1789433847/*!*/;
BEGIN
/*!*/;
# at 7082
#260915  7:57:27 server id 1  end_log_pos 7156 CRC32 0x68165e6c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 7156
#260915  7:57:27 server id 1  end_log_pos 7860 CRC32 0xc2df5ccb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
95eoahMBAAAASgAAAPQbAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GxeFmg=
95eoah8BAAAAwAIAALQeAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pZFZwcmFUaE9jWE4wVG14bmVXSjRkM1Z5TWxwamFWaFZVSGxZUWpOR2JVZHRTMVF5UjJk
SVJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT32l6hqAigAVWNwUUdBT3Y4Y3RCdVpaekI2cDVDdGlPOTR1MzN2
bEllUWxuS3J4RwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRW
cHJhVGhPY1hOMFRteG5lV0o0ZDNWeU1scGphVmhWVUhsWVFqTkdiVWR0UzFReVIyZElSeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT0995eoastc38I=
'/*!*/;
# at 7860
#260915  7:57:27 server id 1  end_log_pos 7891 CRC32 0xd4c7823d 	Xid = 179
COMMIT/*!*/;
# at 7891
#260915  7:57:35 server id 1  end_log_pos 7970 CRC32 0x2835a87f 	Anonymous_GTID	last_committed=9	sequence_number=10	rbr_only=yes	original_committed_timestamp=1789433855987055	immediate_commit_timestamp=1789433855987055	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433855987055 (2026-09-15 07:57:35.987055 SE Asia Standard Time)
# immediate_commit_timestamp=1789433855987055 (2026-09-15 07:57:35.987055 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433855987055*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 7970
#260915  7:57:35 server id 1  end_log_pos 8060 CRC32 0x3d37662b 	Query	thread_id=26	exec_time=0	error_code=0
SET TIMESTAMP=1789433855/*!*/;
BEGIN
/*!*/;
# at 8060
#260915  7:57:35 server id 1  end_log_pos 8134 CRC32 0x7bd11c60 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 8134
#260915  7:57:35 server id 1  end_log_pos 8838 CRC32 0x8f886c86 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/5eoahMBAAAASgAAAMYfAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GAc0Xs=
/5eoah8BAAAAwAIAAIYiAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pZFZwcmFUaE9jWE4wVG14bmVXSjRkM1Z5TWxwamFWaFZVSGxZUWpOR2JVZHRTMVF5UjJk
SVJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT33l6hqAigAVWNwUUdBT3Y4Y3RCdVpaekI2cDVDdGlPOTR1MzN2
bEllUWxuS3J4RwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRW
cHJhVGhPY1hOMFRteG5lV0o0ZDNWeU1scGphVmhWVUhsWVFqTkdiVWR0UzFReVIyZElSeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09/5eoaoZsiI8=
'/*!*/;
# at 8838
#260915  7:57:35 server id 1  end_log_pos 8869 CRC32 0x400bea3c 	Xid = 188
COMMIT/*!*/;
# at 8869
#260915  7:57:41 server id 1  end_log_pos 8948 CRC32 0xe1c81c27 	Anonymous_GTID	last_committed=10	sequence_number=11	rbr_only=yes	original_committed_timestamp=1789433861460653	immediate_commit_timestamp=1789433861460653	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433861460653 (2026-09-15 07:57:41.460653 SE Asia Standard Time)
# immediate_commit_timestamp=1789433861460653 (2026-09-15 07:57:41.460653 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433861460653*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 8948
#260915  7:57:41 server id 1  end_log_pos 9038 CRC32 0x6b7595da 	Query	thread_id=27	exec_time=0	error_code=0
SET TIMESTAMP=1789433861/*!*/;
BEGIN
/*!*/;
# at 9038
#260915  7:57:41 server id 1  end_log_pos 9112 CRC32 0xceae3a4d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 9112
#260915  7:57:41 server id 1  end_log_pos 9928 CRC32 0x7c1ba1a0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BZioahMBAAAASgAAAJgjAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E06rs4=
BZioah8BAAAAMAMAAMgmAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pZFZwcmFUaE9jWE4wVG14bmVXSjRkM1Z5TWxwamFWaFZVSGxZUWpOR2JVZHRTMVF5UjJk
SVJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT3/l6hqAigAVWNwUUdBT3Y4Y3RCdVpaekI2cDVDdGlPOTR1MzN2
bEllUWxuS3J4RwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRW
cHJhVGhPY1hOMFRteG5lV0o0ZDNWeU1scGphVmhWVUhsWVFqTkdiVWR0UzFReVIyZElSeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PQWYqGqgoRt8
'/*!*/;
# at 9928
#260915  7:57:41 server id 1  end_log_pos 9959 CRC32 0xdf02895e 	Xid = 197
COMMIT/*!*/;
# at 9959
#260915  7:57:44 server id 1  end_log_pos 10038 CRC32 0x6e87f9e6 	Anonymous_GTID	last_committed=11	sequence_number=12	rbr_only=yes	original_committed_timestamp=1789433864296945	immediate_commit_timestamp=1789433864296945	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433864296945 (2026-09-15 07:57:44.296945 SE Asia Standard Time)
# immediate_commit_timestamp=1789433864296945 (2026-09-15 07:57:44.296945 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433864296945*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 10038
#260915  7:57:44 server id 1  end_log_pos 10128 CRC32 0xb7bba581 	Query	thread_id=28	exec_time=0	error_code=0
SET TIMESTAMP=1789433864/*!*/;
BEGIN
/*!*/;
# at 10128
#260915  7:57:44 server id 1  end_log_pos 10202 CRC32 0x54834181 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 10202
#260915  7:57:44 server id 1  end_log_pos 11146 CRC32 0x8129b263 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
CJioahMBAAAASgAAANonAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IFBg1Q=
CJioah8BAAAAsAMAAIorAAAAAFMAAAAAAAEAAgAG//8CKABVY3BRR0FPdjhjdEJ1Wlp6QjZwNUN0
aU85NHUzM3ZsSWVRbG5LcnhHCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pZFZwcmFUaE9jWE4wVG14bmVXSjRkM1Z5TWxwamFWaFZVSGxZUWpOR2JVZHRTMVF5UjJk
SVJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09BZioagIoAFVjcFFHQU92OGN0QnVaWnpCNnA1Q3RpTzk0dTMzdmxJ
ZVFsbktyeEcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lkVnBy
YVRoT2NYTjBUbXhuZVdKNGQzVnlNbHBqYVZoVlVIbFlRak5HYlVkdFMxUXlSMmRJUnlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1Yw
WlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9CJioamOyKYE=
'/*!*/;
# at 11146
#260915  7:57:44 server id 1  end_log_pos 11177 CRC32 0x8229f189 	Xid = 206
COMMIT/*!*/;
# at 11177
#260915  7:58:07 server id 1  end_log_pos 11256 CRC32 0x7bb66dd8 	Anonymous_GTID	last_committed=12	sequence_number=13	rbr_only=yes	original_committed_timestamp=1789433887972421	immediate_commit_timestamp=1789433887972421	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433887972421 (2026-09-15 07:58:07.972421 SE Asia Standard Time)
# immediate_commit_timestamp=1789433887972421 (2026-09-15 07:58:07.972421 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433887972421*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 11256
#260915  7:58:07 server id 1  end_log_pos 11337 CRC32 0xead08d95 	Query	thread_id=29	exec_time=0	error_code=0
SET TIMESTAMP=1789433887/*!*/;
BEGIN
/*!*/;
# at 11337
#260915  7:58:07 server id 1  end_log_pos 11411 CRC32 0x1c1e1666 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 11411
#260915  7:58:07 server id 1  end_log_pos 11908 CRC32 0xca682d08 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
H5ioahMBAAAASgAAAJMsAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GYWHhw=
H5ioaiABAAAA8QEAAIQuAAAAAFMAAAAAAAEAAgAG/wIoAFVjcFFHQU92OGN0QnVaWnpCNnA1Q3Rp
Tzk0dTMzdmxJZVFsbktyeEcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lkVnByYVRoT2NYTjBUbXhuZVdKNGQzVnlNbHBqYVZoVlVIbFlRak5HYlVkdFMxUXlSMmRJ
UnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8z
TTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pv
MU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9CJioaggtaMo=
'/*!*/;
# at 11908
#260915  7:58:07 server id 1  end_log_pos 11939 CRC32 0x39614a03 	Xid = 218
COMMIT/*!*/;
# at 11939
#260915  7:58:07 server id 1  end_log_pos 12018 CRC32 0x4c97c1aa 	Anonymous_GTID	last_committed=13	sequence_number=14	rbr_only=yes	original_committed_timestamp=1789433887975913	immediate_commit_timestamp=1789433887975913	transaction_length=586
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433887975913 (2026-09-15 07:58:07.975913 SE Asia Standard Time)
# immediate_commit_timestamp=1789433887975913 (2026-09-15 07:58:07.975913 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433887975913*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12018
#260915  7:58:07 server id 1  end_log_pos 12107 CRC32 0xb7cfdfbf 	Query	thread_id=29	exec_time=0	error_code=0
SET TIMESTAMP=1789433887/*!*/;
BEGIN
/*!*/;
# at 12107
#260915  7:58:07 server id 1  end_log_pos 12205 CRC32 0x8626174b 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 88
# at 12205
#260915  7:58:07 server id 1  end_log_pos 12494 CRC32 0x92161616 	Write_rows: table id 88 flags: STMT_END_F

BINLOG '
H5ioahMBAAAAYgAAAK0vAAAAAFgAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4EsXJoY=
H5ioah4BAAAAIQEAAM4wAAAAAFgAAAAAAAEAAgAN//8AAAIAAAAAAAAABAAAAAAAAAAPAEJ1ZGkg
U2FudG9zbyBKcggAS2FyeWF3YW4LAGF1dGVudGlrYXNpBQBsb2dpbh4AbWVsYWt1a2FuIGxvZ2lu
IGtlIHBhbmVsIGFkbWluDwBBcHBcTW9kZWxzXFVzZXIEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemls
bGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAo
S0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNmqoNa9qqDWv
FhYWkg==
'/*!*/;
# at 12494
#260915  7:58:07 server id 1  end_log_pos 12525 CRC32 0xf7674b01 	Xid = 221
COMMIT/*!*/;
# at 12525
#260915  7:58:07 server id 1  end_log_pos 12604 CRC32 0x7e26fd6d 	Anonymous_GTID	last_committed=14	sequence_number=15	rbr_only=yes	original_committed_timestamp=1789433887983949	immediate_commit_timestamp=1789433887983949	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433887983949 (2026-09-15 07:58:07.983949 SE Asia Standard Time)
# immediate_commit_timestamp=1789433887983949 (2026-09-15 07:58:07.983949 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433887983949*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12604
#260915  7:58:07 server id 1  end_log_pos 12685 CRC32 0xad847b12 	Query	thread_id=29	exec_time=0	error_code=0
SET TIMESTAMP=1789433887/*!*/;
BEGIN
/*!*/;
# at 12685
#260915  7:58:07 server id 1  end_log_pos 12759 CRC32 0x67fd20b1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 12759
#260915  7:58:07 server id 1  end_log_pos 13348 CRC32 0x35eecad0 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
H5ioahMBAAAASgAAANcxAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LEg/Wc=
H5ioah4BAAAATQIAACQ0AAAAAFMAAAAAAAEAAgAG/wAoAFBWSHNaRGpkNnk4SXJackF3MzM5bzNs
MFVpUElwRDI3VUNCYWk1emcEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWNGcDBVV1F5YkhkdGNtZHFlREpVZVdoMFpXRmtVVU5TZG1kbFpWbFhZVkpP
ZDJOS2FsZ3lUaUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT0fmKhq0MruNQ==
'/*!*/;
# at 13348
#260915  7:58:07 server id 1  end_log_pos 13379 CRC32 0x2215a262 	Xid = 227
COMMIT/*!*/;
# at 13379
#260915  7:58:08 server id 1  end_log_pos 13458 CRC32 0x1f721202 	Anonymous_GTID	last_committed=15	sequence_number=16	rbr_only=yes	original_committed_timestamp=1789433888493230	immediate_commit_timestamp=1789433888493230	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789433888493230 (2026-09-15 07:58:08.493230 SE Asia Standard Time)
# immediate_commit_timestamp=1789433888493230 (2026-09-15 07:58:08.493230 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789433888493230*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13458
#260915  7:58:08 server id 1  end_log_pos 13548 CRC32 0x9e15561d 	Query	thread_id=30	exec_time=0	error_code=0
SET TIMESTAMP=1789433888/*!*/;
BEGIN
/*!*/;
# at 13548
#260915  7:58:08 server id 1  end_log_pos 13622 CRC32 0x4705ae16 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 13622
#260915  7:58:08 server id 1  end_log_pos 14786 CRC32 0x4563e68c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
IJioahMBAAAASgAAADY1AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BauBUc=
IJioah8BAAAAjAQAAMI5AAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09H5ioagAoAFBWSHNaRGpkNnk4SXJackF3MzM5bzNsMFVpUElwRDI3VUNCYWk1
emcEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWNG
cDBVV1F5YkhkdGNtZHFlREpVZVdoMFpXRmtVVU5TZG1kbFpWbFhZVkpPZDJOS2FsZ3lUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5U
b2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PSCYqGqM5mNF
'/*!*/;
# at 14786
#260915  7:58:08 server id 1  end_log_pos 14817 CRC32 0xdf34d882 	Xid = 254
COMMIT/*!*/;
# at 14817
#260915  8:14:09 server id 1  end_log_pos 14896 CRC32 0xfade2cfe 	Anonymous_GTID	last_committed=16	sequence_number=17	rbr_only=yes	original_committed_timestamp=1789434849493767	immediate_commit_timestamp=1789434849493767	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789434849493767 (2026-09-15 08:14:09.493767 SE Asia Standard Time)
# immediate_commit_timestamp=1789434849493767 (2026-09-15 08:14:09.493767 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789434849493767*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 14896
#260915  8:14:09 server id 1  end_log_pos 14986 CRC32 0xa5332bb1 	Query	thread_id=31	exec_time=0	error_code=0
SET TIMESTAMP=1789434849/*!*/;
BEGIN
/*!*/;
# at 14986
#260915  8:14:09 server id 1  end_log_pos 15060 CRC32 0xb4037840 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 15060
#260915  8:14:09 server id 1  end_log_pos 16244 CRC32 0xacd8ecb0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4ZuoahMBAAAASgAAANQ6AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EB4A7Q=
4Zuoah8BAAAAoAQAAHQ/AAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0gmKhqACgAUFZIc1pEamQ2eThJclpyQXcz
MzlvM2wwVWlQSXBEMjdVQ0JhaTV6ZwQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY0ZwMFVXUXliSGR0Y21kcWVESlVlV2gwWldGa1VVTlNkbWRsWlZs
WFlWSk9kMk5LYWxneVRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT094ZuoarDs2Kw=
'/*!*/;
# at 16244
#260915  8:14:09 server id 1  end_log_pos 16275 CRC32 0xfbfc5abc 	Xid = 281
COMMIT/*!*/;
# at 16275
#260915  8:14:14 server id 1  end_log_pos 16354 CRC32 0x64218e3a 	Anonymous_GTID	last_committed=17	sequence_number=18	rbr_only=yes	original_committed_timestamp=1789434854743232	immediate_commit_timestamp=1789434854743232	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789434854743232 (2026-09-15 08:14:14.743232 SE Asia Standard Time)
# immediate_commit_timestamp=1789434854743232 (2026-09-15 08:14:14.743232 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789434854743232*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 16354
#260915  8:14:14 server id 1  end_log_pos 16444 CRC32 0xd7058b0e 	Query	thread_id=32	exec_time=0	error_code=0
SET TIMESTAMP=1789434854/*!*/;
BEGIN
/*!*/;
# at 16444
#260915  8:14:14 server id 1  end_log_pos 16518 CRC32 0xc4aacd1d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 16518
#260915  8:14:14 server id 1  end_log_pos 17702 CRC32 0xe8a3cd65 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
5puoahMBAAAASgAAAIZAAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4B3NqsQ=
5puoah8BAAAAoAQAACZFAAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3hm6hqACgAUFZIc1pEamQ2eThJclpyQXcz
MzlvM2wwVWlQSXBEMjdVQ0JhaTV6ZwQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY0ZwMFVXUXliSGR0Y21kcWVESlVlV2gwWldGa1VVTlNkbWRsWlZs
WFlWSk9kMk5LYWxneVRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT095puoamXNo+g=
'/*!*/;
# at 17702
#260915  8:14:14 server id 1  end_log_pos 17733 CRC32 0xbc5f3ab2 	Xid = 296
COMMIT/*!*/;
# at 17733
#260915  8:16:17 server id 1  end_log_pos 17812 CRC32 0x354b44d5 	Anonymous_GTID	last_committed=18	sequence_number=19	rbr_only=yes	original_committed_timestamp=1789434977474367	immediate_commit_timestamp=1789434977474367	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789434977474367 (2026-09-15 08:16:17.474367 SE Asia Standard Time)
# immediate_commit_timestamp=1789434977474367 (2026-09-15 08:16:17.474367 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789434977474367*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 17812
#260915  8:16:17 server id 1  end_log_pos 17902 CRC32 0xbcb0a6f9 	Query	thread_id=33	exec_time=0	error_code=0
SET TIMESTAMP=1789434977/*!*/;
BEGIN
/*!*/;
# at 17902
#260915  8:16:17 server id 1  end_log_pos 17976 CRC32 0x7722df86 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 17976
#260915  8:16:17 server id 1  end_log_pos 19160 CRC32 0xf8c8a6f8 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
YZyoahMBAAAASgAAADhGAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IbfInc=
YZyoah8BAAAAoAQAANhKAAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3mm6hqACgAUFZIc1pEamQ2eThJclpyQXcz
MzlvM2wwVWlQSXBEMjdVQ0JhaTV6ZwQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY0ZwMFVXUXliSGR0Y21kcWVESlVlV2gwWldGa1VVTlNkbWRsWlZs
WFlWSk9kMk5LYWxneVRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09YZyoavimyPg=
'/*!*/;
# at 19160
#260915  8:16:17 server id 1  end_log_pos 19191 CRC32 0x4b45515a 	Xid = 323
COMMIT/*!*/;
# at 19191
#260915  8:16:20 server id 1  end_log_pos 19270 CRC32 0xdefc9b65 	Anonymous_GTID	last_committed=19	sequence_number=20	rbr_only=yes	original_committed_timestamp=1789434980952392	immediate_commit_timestamp=1789434980952392	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789434980952392 (2026-09-15 08:16:20.952392 SE Asia Standard Time)
# immediate_commit_timestamp=1789434980952392 (2026-09-15 08:16:20.952392 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789434980952392*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 19270
#260915  8:16:20 server id 1  end_log_pos 19360 CRC32 0xea3ef8ba 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789434980/*!*/;
BEGIN
/*!*/;
# at 19360
#260915  8:16:20 server id 1  end_log_pos 19434 CRC32 0x083eca74 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 19434
#260915  8:16:20 server id 1  end_log_pos 20618 CRC32 0x18cc1770 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ZJyoahMBAAAASgAAAOpLAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HTKPgg=
ZJyoah8BAAAAoAQAAIpQAAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1hnKhqACgAUFZIc1pEamQ2eThJclpyQXcz
MzlvM2wwVWlQSXBEMjdVQ0JhaTV6ZwQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY0ZwMFVXUXliSGR0Y21kcWVESlVlV2gwWldGa1VVTlNkbWRsWlZs
WFlWSk9kMk5LYWxneVRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09ZJyoanAXzBg=
'/*!*/;
# at 20618
#260915  8:16:20 server id 1  end_log_pos 20649 CRC32 0x9c944713 	Xid = 341
COMMIT/*!*/;
# at 20649
#260915  8:16:23 server id 1  end_log_pos 20728 CRC32 0xaa3b1611 	Anonymous_GTID	last_committed=20	sequence_number=21	rbr_only=yes	original_committed_timestamp=1789434983499110	immediate_commit_timestamp=1789434983499110	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789434983499110 (2026-09-15 08:16:23.499110 SE Asia Standard Time)
# immediate_commit_timestamp=1789434983499110 (2026-09-15 08:16:23.499110 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789434983499110*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 20728
#260915  8:16:23 server id 1  end_log_pos 20818 CRC32 0xc888a254 	Query	thread_id=35	exec_time=0	error_code=0
SET TIMESTAMP=1789434983/*!*/;
BEGIN
/*!*/;
# at 20818
#260915  8:16:23 server id 1  end_log_pos 20892 CRC32 0x0bad0bf0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 20892
#260915  8:16:23 server id 1  end_log_pos 22036 CRC32 0xc2d35150 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Z5yoahMBAAAASgAAAJxRAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PALrQs=
Z5yoah8BAAAAeAQAABRWAAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1knKhqACgAUFZIc1pEamQ2eThJclpyQXcz
MzlvM2wwVWlQSXBEMjdVQ0JhaTV6ZwQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY0ZwMFVXUXliSGR0Y21kcWVESlVlV2gwWldGa1VVTlNkbWRsWlZs
WFlWSk9kMk5LYWxneVRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9p
SnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDlnnKhq
UFHTwg==
'/*!*/;
# at 22036
#260915  8:16:23 server id 1  end_log_pos 22067 CRC32 0xb994e19f 	Xid = 353
COMMIT/*!*/;
# at 22067
#260915  8:16:30 server id 1  end_log_pos 22146 CRC32 0x297585e1 	Anonymous_GTID	last_committed=21	sequence_number=22	rbr_only=yes	original_committed_timestamp=1789434990740559	immediate_commit_timestamp=1789434990740559	transaction_length=1398
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789434990740559 (2026-09-15 08:16:30.740559 SE Asia Standard Time)
# immediate_commit_timestamp=1789434990740559 (2026-09-15 08:16:30.740559 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789434990740559*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 22146
#260915  8:16:30 server id 1  end_log_pos 22236 CRC32 0x6dd783d5 	Query	thread_id=36	exec_time=0	error_code=0
SET TIMESTAMP=1789434990/*!*/;
BEGIN
/*!*/;
# at 22236
#260915  8:16:30 server id 1  end_log_pos 22310 CRC32 0x5c02cfd2 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 22310
#260915  8:16:30 server id 1  end_log_pos 23434 CRC32 0xb1e26140 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
bpyoahMBAAAASgAAACZXAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NLPAlw=
bpyoah8BAAAAZAQAAIpbAAAAAFMAAAAAAAEAAgAG//8AKABQVkhzWkRqZDZ5OElyWnJBdzMzOW8z
bDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVXaDBaV0ZrVVVOU2RtZGxaVmxYWVZK
T2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OWecqGoAKABQ
VkhzWkRqZDZ5OElyWnJBdzMzOW8zbDBVaVBJcEQyN1VDQmFpNXpnBAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ0
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2ljRnAwVVdReWJIZHRjbWRxZURKVWVX
aDBaV0ZrVVVOU2RtZGxaVmxYWVZKT2QyTkthbGd5VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpw
N2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdM
akU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJp
STdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURF
MFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09bpyoakBh4rE=
'/*!*/;
# at 23434
#260915  8:16:30 server id 1  end_log_pos 23465 CRC32 0x32ef5070 	Xid = 365
COMMIT/*!*/;
# at 23465
#260915  8:16:45 server id 1  end_log_pos 23544 CRC32 0xcfe4d666 	Anonymous_GTID	last_committed=22	sequence_number=23	rbr_only=yes	original_committed_timestamp=1789435005225884	immediate_commit_timestamp=1789435005225884	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435005225884 (2026-09-15 08:16:45.225884 SE Asia Standard Time)
# immediate_commit_timestamp=1789435005225884 (2026-09-15 08:16:45.225884 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435005225884*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23544
#260915  8:16:45 server id 1  end_log_pos 23625 CRC32 0x301639b7 	Query	thread_id=37	exec_time=0	error_code=0
SET TIMESTAMP=1789435005/*!*/;
BEGIN
/*!*/;
# at 23625
#260915  8:16:45 server id 1  end_log_pos 23699 CRC32 0x809c49e5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 23699
#260915  8:16:45 server id 1  end_log_pos 24288 CRC32 0xfd1db603 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
fZyoahMBAAAASgAAAJNcAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OVJnIA=
fZyoaiABAAAATQIAAOBeAAAAAFMAAAAAAAEAAgAG/wAoAFBWSHNaRGpkNnk4SXJackF3MzM5bzNs
MFVpUElwRDI3VUNCYWk1emcEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWNGcDBVV1F5YkhkdGNtZHFlREpVZVdoMFpXRmtVVU5TZG1kbFpWbFhZVkpP
ZDJOS2FsZ3lUaUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT1unKhqA7Yd/Q==
'/*!*/;
# at 24288
#260915  8:16:45 server id 1  end_log_pos 24319 CRC32 0xe518da0f 	Xid = 377
COMMIT/*!*/;
# at 24319
#260915  8:16:45 server id 1  end_log_pos 24398 CRC32 0xb2329eee 	Anonymous_GTID	last_committed=23	sequence_number=24	rbr_only=yes	original_committed_timestamp=1789435005236555	immediate_commit_timestamp=1789435005236555	transaction_length=586
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435005236555 (2026-09-15 08:16:45.236555 SE Asia Standard Time)
# immediate_commit_timestamp=1789435005236555 (2026-09-15 08:16:45.236555 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435005236555*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24398
#260915  8:16:45 server id 1  end_log_pos 24487 CRC32 0x39342391 	Query	thread_id=37	exec_time=0	error_code=0
SET TIMESTAMP=1789435005/*!*/;
BEGIN
/*!*/;
# at 24487
#260915  8:16:45 server id 1  end_log_pos 24585 CRC32 0x0a84908d 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 88
# at 24585
#260915  8:16:45 server id 1  end_log_pos 24874 CRC32 0x92640c0c 	Write_rows: table id 88 flags: STMT_END_F

BINLOG '
fZyoahMBAAAAYgAAAAlgAAAAAFgAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4I2QhAo=
fZyoah4BAAAAIQEAACphAAAAAFgAAAAAAAEAAgAN//8AAAMAAAAAAAAABAAAAAAAAAAPAEJ1ZGkg
U2FudG9zbyBKcggAS2FyeWF3YW4LAGF1dGVudGlrYXNpBQBsb2dpbh4AbWVsYWt1a2FuIGxvZ2lu
IGtlIHBhbmVsIGFkbWluDwBBcHBcTW9kZWxzXFVzZXIEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemls
bGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAo
S0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNmqoOg1qqDoN
DAxkkg==
'/*!*/;
# at 24874
#260915  8:16:45 server id 1  end_log_pos 24905 CRC32 0x5d960c91 	Xid = 380
COMMIT/*!*/;
# at 24905
#260915  8:16:45 server id 1  end_log_pos 24984 CRC32 0x0b866df0 	Anonymous_GTID	last_committed=24	sequence_number=25	rbr_only=yes	original_committed_timestamp=1789435005261147	immediate_commit_timestamp=1789435005261147	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435005261147 (2026-09-15 08:16:45.261147 SE Asia Standard Time)
# immediate_commit_timestamp=1789435005261147 (2026-09-15 08:16:45.261147 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435005261147*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24984
#260915  8:16:45 server id 1  end_log_pos 25065 CRC32 0xc3443b65 	Query	thread_id=37	exec_time=0	error_code=0
SET TIMESTAMP=1789435005/*!*/;
BEGIN
/*!*/;
# at 25065
#260915  8:16:45 server id 1  end_log_pos 25139 CRC32 0x67e0b835 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 25139
#260915  8:16:45 server id 1  end_log_pos 25728 CRC32 0x6f524cf9 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
fZyoahMBAAAASgAAADNiAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DW44Gc=
fZyoah4BAAAATQIAAIBkAAAAAFMAAAAAAAEAAgAG/wAoAEx3bGszVEJ5RU01d2huUndvTktKT3lH
VHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3
U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT19nKhq+UxSbw==
'/*!*/;
# at 25728
#260915  8:16:45 server id 1  end_log_pos 25759 CRC32 0xf6e2d633 	Xid = 386
COMMIT/*!*/;
# at 25759
#260915  8:16:45 server id 1  end_log_pos 25838 CRC32 0xcf1736c9 	Anonymous_GTID	last_committed=25	sequence_number=26	rbr_only=yes	original_committed_timestamp=1789435005883719	immediate_commit_timestamp=1789435005883719	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435005883719 (2026-09-15 08:16:45.883719 SE Asia Standard Time)
# immediate_commit_timestamp=1789435005883719 (2026-09-15 08:16:45.883719 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435005883719*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25838
#260915  8:16:45 server id 1  end_log_pos 25928 CRC32 0x555de640 	Query	thread_id=38	exec_time=0	error_code=0
SET TIMESTAMP=1789435005/*!*/;
BEGIN
/*!*/;
# at 25928
#260915  8:16:45 server id 1  end_log_pos 26002 CRC32 0x6f6b5bbd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 26002
#260915  8:16:45 server id 1  end_log_pos 27166 CRC32 0x21d47711 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
fZyoahMBAAAASgAAAJJlAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4L1ba28=
fZyoah8BAAAAjAQAAB5qAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09fZyoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkpt
ZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJr
eDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5U
b2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PX2cqGoRd9Qh
'/*!*/;
# at 27166
#260915  8:16:45 server id 1  end_log_pos 27197 CRC32 0x06e6aa93 	Xid = 413
COMMIT/*!*/;
# at 27197
#260915  8:28:15 server id 1  end_log_pos 27276 CRC32 0x2c90cf61 	Anonymous_GTID	last_committed=26	sequence_number=27	rbr_only=yes	original_committed_timestamp=1789435695782626	immediate_commit_timestamp=1789435695782626	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435695782626 (2026-09-15 08:28:15.782626 SE Asia Standard Time)
# immediate_commit_timestamp=1789435695782626 (2026-09-15 08:28:15.782626 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435695782626*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27276
#260915  8:28:15 server id 1  end_log_pos 27366 CRC32 0x4b85fa5c 	Query	thread_id=40	exec_time=0	error_code=0
SET TIMESTAMP=1789435695/*!*/;
BEGIN
/*!*/;
# at 27366
#260915  8:28:15 server id 1  end_log_pos 27440 CRC32 0x0ae57b8d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 27440
#260915  8:28:15 server id 1  end_log_pos 28624 CRC32 0x57ba6554 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
L5+oahMBAAAASgAAADBrAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4I175Qo=
L5+oah8BAAAAoAQAANBvAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT19nKhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09L5+oalRlulc=
'/*!*/;
# at 28624
#260915  8:28:15 server id 1  end_log_pos 28655 CRC32 0xfabe47dd 	Xid = 446
COMMIT/*!*/;
# at 28655
#260915  8:28:22 server id 1  end_log_pos 28734 CRC32 0x77a30f60 	Anonymous_GTID	last_committed=27	sequence_number=28	rbr_only=yes	original_committed_timestamp=1789435702607848	immediate_commit_timestamp=1789435702607848	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435702607848 (2026-09-15 08:28:22.607848 SE Asia Standard Time)
# immediate_commit_timestamp=1789435702607848 (2026-09-15 08:28:22.607848 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435702607848*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 28734
#260915  8:28:22 server id 1  end_log_pos 28824 CRC32 0x79d26559 	Query	thread_id=41	exec_time=0	error_code=0
SET TIMESTAMP=1789435702/*!*/;
BEGIN
/*!*/;
# at 28824
#260915  8:28:22 server id 1  end_log_pos 28898 CRC32 0xb4d886bd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 28898
#260915  8:28:22 server id 1  end_log_pos 30082 CRC32 0xa29b5735 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Np+oahMBAAAASgAAAOJwAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4L2G2LQ=
Np+oah8BAAAAoAQAAIJ1AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0vn6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09Np+oajVXm6I=
'/*!*/;
# at 30082
#260915  8:28:22 server id 1  end_log_pos 30113 CRC32 0xd690ea6c 	Xid = 473
COMMIT/*!*/;
# at 30113
#260915  8:28:23 server id 1  end_log_pos 30192 CRC32 0x50cf976a 	Anonymous_GTID	last_committed=28	sequence_number=29	rbr_only=yes	original_committed_timestamp=1789435703785376	immediate_commit_timestamp=1789435703785376	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435703785376 (2026-09-15 08:28:23.785376 SE Asia Standard Time)
# immediate_commit_timestamp=1789435703785376 (2026-09-15 08:28:23.785376 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435703785376*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30192
#260915  8:28:23 server id 1  end_log_pos 30282 CRC32 0xc95eafbb 	Query	thread_id=42	exec_time=0	error_code=0
SET TIMESTAMP=1789435703/*!*/;
BEGIN
/*!*/;
# at 30282
#260915  8:28:23 server id 1  end_log_pos 30356 CRC32 0x9d5bdd3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 30356
#260915  8:28:23 server id 1  end_log_pos 31540 CRC32 0x6e4fde80 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
N5+oahMBAAAASgAAAJR2AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DrdW50=
N5+oah8BAAAAoAQAADR7AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT02n6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09N5+oaoDeT24=
'/*!*/;
# at 31540
#260915  8:28:23 server id 1  end_log_pos 31571 CRC32 0x0d603197 	Xid = 491
COMMIT/*!*/;
# at 31571
#260915  8:28:24 server id 1  end_log_pos 31650 CRC32 0x2ba1367f 	Anonymous_GTID	last_committed=29	sequence_number=30	rbr_only=yes	original_committed_timestamp=1789435704723835	immediate_commit_timestamp=1789435704723835	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435704723835 (2026-09-15 08:28:24.723835 SE Asia Standard Time)
# immediate_commit_timestamp=1789435704723835 (2026-09-15 08:28:24.723835 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435704723835*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 31650
#260915  8:28:24 server id 1  end_log_pos 31740 CRC32 0xbcb4b017 	Query	thread_id=43	exec_time=0	error_code=0
SET TIMESTAMP=1789435704/*!*/;
BEGIN
/*!*/;
# at 31740
#260915  8:28:24 server id 1  end_log_pos 31814 CRC32 0xa6c20aa0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 31814
#260915  8:28:24 server id 1  end_log_pos 32990 CRC32 0xb344b92d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
OJ+oahMBAAAASgAAAEZ8AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KAKwqY=
OJ+oah8BAAAAmAQAAN6AAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT03n6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OTifqGotuUSz
'/*!*/;
# at 32990
#260915  8:28:24 server id 1  end_log_pos 33021 CRC32 0xdf38bdbd 	Xid = 509
COMMIT/*!*/;
# at 33021
#260915  8:28:27 server id 1  end_log_pos 33100 CRC32 0xfc9d3a95 	Anonymous_GTID	last_committed=30	sequence_number=31	rbr_only=yes	original_committed_timestamp=1789435707746089	immediate_commit_timestamp=1789435707746089	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435707746089 (2026-09-15 08:28:27.746089 SE Asia Standard Time)
# immediate_commit_timestamp=1789435707746089 (2026-09-15 08:28:27.746089 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435707746089*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 33100
#260915  8:28:27 server id 1  end_log_pos 33190 CRC32 0x3b6ba554 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789435707/*!*/;
BEGIN
/*!*/;
# at 33190
#260915  8:28:27 server id 1  end_log_pos 33264 CRC32 0x97087fa1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 33264
#260915  8:28:27 server id 1  end_log_pos 34432 CRC32 0x330d0af6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
O5+oahMBAAAASgAAAPCBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KF/CJc=
O5+oah8BAAAAkAQAAICGAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5OJ+oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDk7n6hq9goNMw==
'/*!*/;
# at 34432
#260915  8:28:27 server id 1  end_log_pos 34463 CRC32 0x2d5c0d8d 	Xid = 527
COMMIT/*!*/;
# at 34463
#260915  8:28:28 server id 1  end_log_pos 34542 CRC32 0xac0b59da 	Anonymous_GTID	last_committed=31	sequence_number=32	rbr_only=yes	original_committed_timestamp=1789435708727143	immediate_commit_timestamp=1789435708727143	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435708727143 (2026-09-15 08:28:28.727143 SE Asia Standard Time)
# immediate_commit_timestamp=1789435708727143 (2026-09-15 08:28:28.727143 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435708727143*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 34542
#260915  8:28:28 server id 1  end_log_pos 34632 CRC32 0x9d7f988c 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1789435708/*!*/;
BEGIN
/*!*/;
# at 34632
#260915  8:28:28 server id 1  end_log_pos 34706 CRC32 0x81d9da8c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 34706
#260915  8:28:28 server id 1  end_log_pos 35874 CRC32 0x4f793ea1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
PJ+oahMBAAAASgAAAJKHAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Iza2YE=
PJ+oah8BAAAAkAQAACKMAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5O5+oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDk8n6hqoT55Tw==
'/*!*/;
# at 35874
#260915  8:28:28 server id 1  end_log_pos 35905 CRC32 0x1a246d67 	Xid = 542
COMMIT/*!*/;
# at 35905
#260915  8:28:29 server id 1  end_log_pos 35984 CRC32 0xcc1f3d01 	Anonymous_GTID	last_committed=32	sequence_number=33	rbr_only=yes	original_committed_timestamp=1789435709893083	immediate_commit_timestamp=1789435709893083	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435709893083 (2026-09-15 08:28:29.893083 SE Asia Standard Time)
# immediate_commit_timestamp=1789435709893083 (2026-09-15 08:28:29.893083 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435709893083*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 35984
#260915  8:28:29 server id 1  end_log_pos 36074 CRC32 0x898c0310 	Query	thread_id=46	exec_time=0	error_code=0
SET TIMESTAMP=1789435709/*!*/;
BEGIN
/*!*/;
# at 36074
#260915  8:28:29 server id 1  end_log_pos 36148 CRC32 0x1c09fc60 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 36148
#260915  8:28:29 server id 1  end_log_pos 37340 CRC32 0xb27fba41 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
PZ+oahMBAAAASgAAADSNAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GD8CRw=
PZ+oah8BAAAAqAQAANyRAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5PJ+oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloYm01dmRX
NWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcx
bGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDk9n6hqQbp/sg==
'/*!*/;
# at 37340
#260915  8:28:29 server id 1  end_log_pos 37371 CRC32 0x765395d1 	Xid = 557
COMMIT/*!*/;
# at 37371
#260915  8:28:32 server id 1  end_log_pos 37450 CRC32 0x655304cb 	Anonymous_GTID	last_committed=33	sequence_number=34	rbr_only=yes	original_committed_timestamp=1789435712832218	immediate_commit_timestamp=1789435712832218	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435712832218 (2026-09-15 08:28:32.832218 SE Asia Standard Time)
# immediate_commit_timestamp=1789435712832218 (2026-09-15 08:28:32.832218 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435712832218*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 37450
#260915  8:28:32 server id 1  end_log_pos 37540 CRC32 0xa3412bfe 	Query	thread_id=47	exec_time=0	error_code=0
SET TIMESTAMP=1789435712/*!*/;
BEGIN
/*!*/;
# at 37540
#260915  8:28:32 server id 1  end_log_pos 37614 CRC32 0x6d864971 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 37614
#260915  8:28:32 server id 1  end_log_pos 38830 CRC32 0x5a362e5e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QJ+oahMBAAAASgAAAO6SAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HFJhm0=
QJ+oah8BAAAAwAQAAK6XAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5PZ+oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDlAn6hqXi42Wg==
'/*!*/;
# at 38830
#260915  8:28:32 server id 1  end_log_pos 38861 CRC32 0xb8c284df 	Xid = 572
COMMIT/*!*/;
# at 38861
#260915  8:28:33 server id 1  end_log_pos 38940 CRC32 0x673e2fe6 	Anonymous_GTID	last_committed=34	sequence_number=35	rbr_only=yes	original_committed_timestamp=1789435713475261	immediate_commit_timestamp=1789435713475261	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435713475261 (2026-09-15 08:28:33.475261 SE Asia Standard Time)
# immediate_commit_timestamp=1789435713475261 (2026-09-15 08:28:33.475261 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435713475261*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 38940
#260915  8:28:33 server id 1  end_log_pos 39030 CRC32 0xe6e0eec0 	Query	thread_id=48	exec_time=0	error_code=0
SET TIMESTAMP=1789435713/*!*/;
BEGIN
/*!*/;
# at 39030
#260915  8:28:33 server id 1  end_log_pos 39104 CRC32 0xd672f676 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 39104
#260915  8:28:33 server id 1  end_log_pos 40320 CRC32 0x387457d6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QZ+oahMBAAAASgAAAMCYAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Hb2ctY=
QZ+oah8BAAAAwAQAAICdAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5QJ+oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDlBn6hq1ld0OA==
'/*!*/;
# at 40320
#260915  8:28:33 server id 1  end_log_pos 40351 CRC32 0x8ce16e01 	Xid = 587
COMMIT/*!*/;
# at 40351
#260915  8:28:34 server id 1  end_log_pos 40430 CRC32 0x360b1b1d 	Anonymous_GTID	last_committed=35	sequence_number=36	rbr_only=yes	original_committed_timestamp=1789435714653801	immediate_commit_timestamp=1789435714653801	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435714653801 (2026-09-15 08:28:34.653801 SE Asia Standard Time)
# immediate_commit_timestamp=1789435714653801 (2026-09-15 08:28:34.653801 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435714653801*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 40430
#260915  8:28:34 server id 1  end_log_pos 40520 CRC32 0x470c99f5 	Query	thread_id=49	exec_time=0	error_code=0
SET TIMESTAMP=1789435714/*!*/;
BEGIN
/*!*/;
# at 40520
#260915  8:28:34 server id 1  end_log_pos 40594 CRC32 0x8c2ed4b5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 40594
#260915  8:28:34 server id 1  end_log_pos 41810 CRC32 0xf2f6f52a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Qp+oahMBAAAASgAAAJKeAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LXULow=
Qp+oah8BAAAAwAQAAFKjAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5QZ+oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDlCn6hqKvX28g==
'/*!*/;
# at 41810
#260915  8:28:34 server id 1  end_log_pos 41841 CRC32 0xb6cea6a3 	Xid = 602
COMMIT/*!*/;
# at 41841
#260915  8:28:35 server id 1  end_log_pos 41920 CRC32 0x91bcfb34 	Anonymous_GTID	last_committed=36	sequence_number=37	rbr_only=yes	original_committed_timestamp=1789435715877343	immediate_commit_timestamp=1789435715877343	transaction_length=1474
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435715877343 (2026-09-15 08:28:35.877343 SE Asia Standard Time)
# immediate_commit_timestamp=1789435715877343 (2026-09-15 08:28:35.877343 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435715877343*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 41920
#260915  8:28:35 server id 1  end_log_pos 42010 CRC32 0xfe6a143a 	Query	thread_id=50	exec_time=0	error_code=0
SET TIMESTAMP=1789435715/*!*/;
BEGIN
/*!*/;
# at 42010
#260915  8:28:35 server id 1  end_log_pos 42084 CRC32 0xda43194e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 42084
#260915  8:28:35 server id 1  end_log_pos 43284 CRC32 0x57c833fb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Q5+oahMBAAAASgAAAGSkAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E4ZQ9o=
Q5+oah8BAAAAsAQAABSpAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5Qp+oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1G
a2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1Jq
TW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PUOfqGr7
M8hX
'/*!*/;
# at 43284
#260915  8:28:35 server id 1  end_log_pos 43315 CRC32 0x629c9862 	Xid = 629
COMMIT/*!*/;
# at 43315
#260915  8:31:08 server id 1  end_log_pos 43394 CRC32 0x44791cc7 	Anonymous_GTID	last_committed=37	sequence_number=38	rbr_only=yes	original_committed_timestamp=1789435868167549	immediate_commit_timestamp=1789435868167549	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435868167549 (2026-09-15 08:31:08.167549 SE Asia Standard Time)
# immediate_commit_timestamp=1789435868167549 (2026-09-15 08:31:08.167549 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435868167549*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 43394
#260915  8:31:08 server id 1  end_log_pos 43484 CRC32 0xd130a244 	Query	thread_id=51	exec_time=0	error_code=0
SET TIMESTAMP=1789435868/*!*/;
BEGIN
/*!*/;
# at 43484
#260915  8:31:08 server id 1  end_log_pos 43558 CRC32 0xd996800b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 43558
#260915  8:31:08 server id 1  end_log_pos 44742 CRC32 0x8474a5f5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3J+oahMBAAAASgAAACaqAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AuAltk=
3J+oah8BAAAAoAQAAMauAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1Dn6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT093J+oavWldIQ=
'/*!*/;
# at 44742
#260915  8:31:08 server id 1  end_log_pos 44773 CRC32 0x2e0e89f6 	Xid = 647
COMMIT/*!*/;
# at 44773
#260915  8:31:10 server id 1  end_log_pos 44852 CRC32 0xa1533b69 	Anonymous_GTID	last_committed=38	sequence_number=39	rbr_only=yes	original_committed_timestamp=1789435870744112	immediate_commit_timestamp=1789435870744112	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435870744112 (2026-09-15 08:31:10.744112 SE Asia Standard Time)
# immediate_commit_timestamp=1789435870744112 (2026-09-15 08:31:10.744112 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435870744112*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 44852
#260915  8:31:10 server id 1  end_log_pos 44942 CRC32 0x1a800a30 	Query	thread_id=52	exec_time=0	error_code=0
SET TIMESTAMP=1789435870/*!*/;
BEGIN
/*!*/;
# at 44942
#260915  8:31:10 server id 1  end_log_pos 45016 CRC32 0x1b243ea3 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 45016
#260915  8:31:10 server id 1  end_log_pos 46192 CRC32 0xdc50cd89 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3p+oahMBAAAASgAAANivAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KM+JBs=
3p+oah8BAAAAmAQAAHC0AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3cn6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0Od6fqGqJzVDc
'/*!*/;
# at 46192
#260915  8:31:10 server id 1  end_log_pos 46223 CRC32 0x4a950923 	Xid = 665
COMMIT/*!*/;
# at 46223
#260915  8:31:12 server id 1  end_log_pos 46302 CRC32 0x0e63c721 	Anonymous_GTID	last_committed=39	sequence_number=40	rbr_only=yes	original_committed_timestamp=1789435872426429	immediate_commit_timestamp=1789435872426429	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435872426429 (2026-09-15 08:31:12.426429 SE Asia Standard Time)
# immediate_commit_timestamp=1789435872426429 (2026-09-15 08:31:12.426429 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435872426429*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 46302
#260915  8:31:12 server id 1  end_log_pos 46392 CRC32 0xce0699a2 	Query	thread_id=53	exec_time=0	error_code=0
SET TIMESTAMP=1789435872/*!*/;
BEGIN
/*!*/;
# at 46392
#260915  8:31:12 server id 1  end_log_pos 46466 CRC32 0x3cf3ca50 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 46466
#260915  8:31:12 server id 1  end_log_pos 47634 CRC32 0x375b68e3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4J+oahMBAAAASgAAAIK1AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FDK8zw=
4J+oah8BAAAAkAQAABK6AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ53p+oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDngn6hq42hbNw==
'/*!*/;
# at 47634
#260915  8:31:12 server id 1  end_log_pos 47665 CRC32 0x08e3d9f7 	Xid = 683
COMMIT/*!*/;
# at 47665
#260915  8:32:28 server id 1  end_log_pos 47744 CRC32 0x3a8d6fb7 	Anonymous_GTID	last_committed=40	sequence_number=41	rbr_only=yes	original_committed_timestamp=1789435948584672	immediate_commit_timestamp=1789435948584672	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435948584672 (2026-09-15 08:32:28.584672 SE Asia Standard Time)
# immediate_commit_timestamp=1789435948584672 (2026-09-15 08:32:28.584672 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435948584672*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 47744
#260915  8:32:28 server id 1  end_log_pos 47834 CRC32 0x562113b1 	Query	thread_id=54	exec_time=0	error_code=0
SET TIMESTAMP=1789435948/*!*/;
BEGIN
/*!*/;
# at 47834
#260915  8:32:28 server id 1  end_log_pos 47908 CRC32 0xd6c8dc10 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 47908
#260915  8:32:28 server id 1  end_log_pos 49076 CRC32 0x238fb5bc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
LKCoahMBAAAASgAAACS7AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BDcyNY=
LKCoah8BAAAAkAQAALS/AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ54J+oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDksoKhqvLWPIw==
'/*!*/;
# at 49076
#260915  8:32:28 server id 1  end_log_pos 49107 CRC32 0x7c2604d5 	Xid = 698
COMMIT/*!*/;
# at 49107
#260915  8:32:29 server id 1  end_log_pos 49186 CRC32 0x113431ef 	Anonymous_GTID	last_committed=41	sequence_number=42	rbr_only=yes	original_committed_timestamp=1789435949231715	immediate_commit_timestamp=1789435949231715	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789435949231715 (2026-09-15 08:32:29.231715 SE Asia Standard Time)
# immediate_commit_timestamp=1789435949231715 (2026-09-15 08:32:29.231715 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789435949231715*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 49186
#260915  8:32:29 server id 1  end_log_pos 49276 CRC32 0x892a3b5b 	Query	thread_id=55	exec_time=0	error_code=0
SET TIMESTAMP=1789435949/*!*/;
BEGIN
/*!*/;
# at 49276
#260915  8:32:29 server id 1  end_log_pos 49350 CRC32 0xa6c78769 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 49350
#260915  8:32:29 server id 1  end_log_pos 50518 CRC32 0x4f078a02 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
LaCoahMBAAAASgAAAMbAAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GmHx6Y=
LaCoah8BAAAAkAQAAFbFAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5LKCoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDktoKhqAooHTw==
'/*!*/;
# at 50518
#260915  8:32:29 server id 1  end_log_pos 50549 CRC32 0x4eeb41ad 	Xid = 716
COMMIT/*!*/;
# at 50549
#260915  8:43:52 server id 1  end_log_pos 50628 CRC32 0x9e21709b 	Anonymous_GTID	last_committed=42	sequence_number=43	rbr_only=yes	original_committed_timestamp=1789436632801363	immediate_commit_timestamp=1789436632801363	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436632801363 (2026-09-15 08:43:52.801363 SE Asia Standard Time)
# immediate_commit_timestamp=1789436632801363 (2026-09-15 08:43:52.801363 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436632801363*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 50628
#260915  8:43:52 server id 1  end_log_pos 50718 CRC32 0xa84ede20 	Query	thread_id=56	exec_time=0	error_code=0
SET TIMESTAMP=1789436632/*!*/;
BEGIN
/*!*/;
# at 50718
#260915  8:43:52 server id 1  end_log_pos 50792 CRC32 0x95c0a2ec 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 50792
#260915  8:43:52 server id 1  end_log_pos 51960 CRC32 0x4a487f97 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
2KKoahMBAAAASgAAAGjGAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OyiwJU=
2KKoah8BAAAAkAQAAPjKAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5LaCoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDnYoqhql39ISg==
'/*!*/;
# at 51960
#260915  8:43:52 server id 1  end_log_pos 51991 CRC32 0x23af0d25 	Xid = 734
COMMIT/*!*/;
# at 51991
#260915  8:43:56 server id 1  end_log_pos 52070 CRC32 0x336ee0b3 	Anonymous_GTID	last_committed=43	sequence_number=44	rbr_only=yes	original_committed_timestamp=1789436636276036	immediate_commit_timestamp=1789436636276036	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436636276036 (2026-09-15 08:43:56.276036 SE Asia Standard Time)
# immediate_commit_timestamp=1789436636276036 (2026-09-15 08:43:56.276036 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436636276036*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 52070
#260915  8:43:56 server id 1  end_log_pos 52160 CRC32 0xa7d3d366 	Query	thread_id=57	exec_time=0	error_code=0
SET TIMESTAMP=1789436636/*!*/;
BEGIN
/*!*/;
# at 52160
#260915  8:43:56 server id 1  end_log_pos 52234 CRC32 0xf2479e98 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 52234
#260915  8:43:56 server id 1  end_log_pos 53410 CRC32 0x0c4a1589 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3KKoahMBAAAASgAAAArMAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JieR/I=
3KKoah8BAAAAmAQAAKLQAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ52KKoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1lt
OWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PdyiqGqJFUoM
'/*!*/;
# at 53410
#260915  8:43:56 server id 1  end_log_pos 53441 CRC32 0xbe297b9f 	Xid = 761
COMMIT/*!*/;
# at 53441
#260915  8:44:02 server id 1  end_log_pos 53520 CRC32 0xf4bda1a5 	Anonymous_GTID	last_committed=44	sequence_number=45	rbr_only=yes	original_committed_timestamp=1789436642860280	immediate_commit_timestamp=1789436642860280	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436642860280 (2026-09-15 08:44:02.860280 SE Asia Standard Time)
# immediate_commit_timestamp=1789436642860280 (2026-09-15 08:44:02.860280 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436642860280*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 53520
#260915  8:44:02 server id 1  end_log_pos 53610 CRC32 0x74eeff62 	Query	thread_id=58	exec_time=0	error_code=0
SET TIMESTAMP=1789436642/*!*/;
BEGIN
/*!*/;
# at 53610
#260915  8:44:02 server id 1  end_log_pos 53684 CRC32 0x3b1b9452 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 53684
#260915  8:44:02 server id 1  end_log_pos 54868 CRC32 0xb8cb28b1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4qKoahMBAAAASgAAALTRAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FKUGzs=
4qKoah8BAAAAoAQAAFTWAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3coqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT094qKoarEoy7g=
'/*!*/;
# at 54868
#260915  8:44:02 server id 1  end_log_pos 54899 CRC32 0x5078a588 	Xid = 779
COMMIT/*!*/;
# at 54899
#260915  8:44:07 server id 1  end_log_pos 54978 CRC32 0x1f598c7d 	Anonymous_GTID	last_committed=45	sequence_number=46	rbr_only=yes	original_committed_timestamp=1789436647335458	immediate_commit_timestamp=1789436647335458	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436647335458 (2026-09-15 08:44:07.335458 SE Asia Standard Time)
# immediate_commit_timestamp=1789436647335458 (2026-09-15 08:44:07.335458 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436647335458*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54978
#260915  8:44:07 server id 1  end_log_pos 55068 CRC32 0xc47c0438 	Query	thread_id=59	exec_time=0	error_code=0
SET TIMESTAMP=1789436647/*!*/;
BEGIN
/*!*/;
# at 55068
#260915  8:44:07 server id 1  end_log_pos 55142 CRC32 0x8e102b61 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 55142
#260915  8:44:07 server id 1  end_log_pos 56326 CRC32 0xc8c7c1a5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
56KoahMBAAAASgAAAGbXAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GErEI4=
56Koah8BAAAAoAQAAAbcAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3ioqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT0956KoaqXBx8g=
'/*!*/;
# at 56326
#260915  8:44:07 server id 1  end_log_pos 56357 CRC32 0x0a320234 	Xid = 794
COMMIT/*!*/;
# at 56357
#260915  8:44:10 server id 1  end_log_pos 56436 CRC32 0xa50535f9 	Anonymous_GTID	last_committed=46	sequence_number=47	rbr_only=yes	original_committed_timestamp=1789436650167830	immediate_commit_timestamp=1789436650167830	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436650167830 (2026-09-15 08:44:10.167830 SE Asia Standard Time)
# immediate_commit_timestamp=1789436650167830 (2026-09-15 08:44:10.167830 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436650167830*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 56436
#260915  8:44:10 server id 1  end_log_pos 56526 CRC32 0x2e1888a4 	Query	thread_id=60	exec_time=0	error_code=0
SET TIMESTAMP=1789436650/*!*/;
BEGIN
/*!*/;
# at 56526
#260915  8:44:10 server id 1  end_log_pos 56600 CRC32 0xe0721c54 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 56600
#260915  8:44:10 server id 1  end_log_pos 57784 CRC32 0x40ef55f2 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6qKoahMBAAAASgAAABjdAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FQccuA=
6qKoah8BAAAAoAQAALjhAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3noqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT096qKoavJV70A=
'/*!*/;
# at 57784
#260915  8:44:10 server id 1  end_log_pos 57815 CRC32 0x4cf8eb1b 	Xid = 812
COMMIT/*!*/;
# at 57815
#260915  8:44:12 server id 1  end_log_pos 57894 CRC32 0xeb0ce42b 	Anonymous_GTID	last_committed=47	sequence_number=48	rbr_only=yes	original_committed_timestamp=1789436652534169	immediate_commit_timestamp=1789436652534169	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436652534169 (2026-09-15 08:44:12.534169 SE Asia Standard Time)
# immediate_commit_timestamp=1789436652534169 (2026-09-15 08:44:12.534169 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436652534169*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 57894
#260915  8:44:12 server id 1  end_log_pos 57984 CRC32 0x36956dfa 	Query	thread_id=61	exec_time=0	error_code=0
SET TIMESTAMP=1789436652/*!*/;
BEGIN
/*!*/;
# at 57984
#260915  8:44:12 server id 1  end_log_pos 58058 CRC32 0x498e2be6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 58058
#260915  8:44:12 server id 1  end_log_pos 59242 CRC32 0xc34c4dd0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7KKoahMBAAAASgAAAMriAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OYrjkk=
7KKoah8BAAAAoAQAAGrnAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3qoqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT097KKoatBNTMM=
'/*!*/;
# at 59242
#260915  8:44:12 server id 1  end_log_pos 59273 CRC32 0xf73a4276 	Xid = 833
COMMIT/*!*/;
# at 59273
#260915  8:44:13 server id 1  end_log_pos 59352 CRC32 0x7a87b880 	Anonymous_GTID	last_committed=48	sequence_number=49	rbr_only=yes	original_committed_timestamp=1789436653656099	immediate_commit_timestamp=1789436653656099	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436653656099 (2026-09-15 08:44:13.656099 SE Asia Standard Time)
# immediate_commit_timestamp=1789436653656099 (2026-09-15 08:44:13.656099 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436653656099*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 59352
#260915  8:44:13 server id 1  end_log_pos 59442 CRC32 0xf051515b 	Query	thread_id=62	exec_time=0	error_code=0
SET TIMESTAMP=1789436653/*!*/;
BEGIN
/*!*/;
# at 59442
#260915  8:44:13 server id 1  end_log_pos 59516 CRC32 0x85822d0b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 59516
#260915  8:44:13 server id 1  end_log_pos 60696 CRC32 0x687ad208 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7aKoahMBAAAASgAAAHzoAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AstgoU=
7aKoah8BAAAAnAQAABjtAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3soqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OTFjMlZ5Y3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhn
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD3toqhqCNJ6aA==
'/*!*/;
# at 60696
#260915  8:44:13 server id 1  end_log_pos 60727 CRC32 0x36a9f9f5 	Xid = 854
COMMIT/*!*/;
# at 60727
#260915  8:44:14 server id 1  end_log_pos 60806 CRC32 0x528c2549 	Anonymous_GTID	last_committed=49	sequence_number=50	rbr_only=yes	original_committed_timestamp=1789436654268908	immediate_commit_timestamp=1789436654268908	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436654268908 (2026-09-15 08:44:14.268908 SE Asia Standard Time)
# immediate_commit_timestamp=1789436654268908 (2026-09-15 08:44:14.268908 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436654268908*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 60806
#260915  8:44:14 server id 1  end_log_pos 60896 CRC32 0x465ac520 	Query	thread_id=63	exec_time=0	error_code=0
SET TIMESTAMP=1789436654/*!*/;
BEGIN
/*!*/;
# at 60896
#260915  8:44:14 server id 1  end_log_pos 60970 CRC32 0xbd754658 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 60970
#260915  8:44:14 server id 1  end_log_pos 62146 CRC32 0x63c1418f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7qKoahMBAAAASgAAACruAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FhGdb0=
7qKoah8BAAAAmAQAAMLyAAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPe2iqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPe6iqGqPQcFj
'/*!*/;
# at 62146
#260915  8:44:14 server id 1  end_log_pos 62177 CRC32 0x54388ebc 	Xid = 875
COMMIT/*!*/;
# at 62177
#260915  8:44:17 server id 1  end_log_pos 62256 CRC32 0x5db327b3 	Anonymous_GTID	last_committed=50	sequence_number=51	rbr_only=yes	original_committed_timestamp=1789436657801049	immediate_commit_timestamp=1789436657801049	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436657801049 (2026-09-15 08:44:17.801049 SE Asia Standard Time)
# immediate_commit_timestamp=1789436657801049 (2026-09-15 08:44:17.801049 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436657801049*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 62256
#260915  8:44:17 server id 1  end_log_pos 62346 CRC32 0xec4343ae 	Query	thread_id=64	exec_time=0	error_code=0
SET TIMESTAMP=1789436657/*!*/;
BEGIN
/*!*/;
# at 62346
#260915  8:44:17 server id 1  end_log_pos 62420 CRC32 0x4656de13 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 62420
#260915  8:44:17 server id 1  end_log_pos 63596 CRC32 0xfca5a0bd 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
8aKoahMBAAAASgAAANTzAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BPeVkY=
8aKoah8BAAAAmAQAAGz4AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPe6iqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfGiqGq9oKX8
'/*!*/;
# at 63596
#260915  8:44:17 server id 1  end_log_pos 63627 CRC32 0xcebfb7c4 	Xid = 890
COMMIT/*!*/;
# at 63627
#260915  8:44:18 server id 1  end_log_pos 63706 CRC32 0x5c669ae8 	Anonymous_GTID	last_committed=51	sequence_number=52	rbr_only=yes	original_committed_timestamp=1789436658787751	immediate_commit_timestamp=1789436658787751	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436658787751 (2026-09-15 08:44:18.787751 SE Asia Standard Time)
# immediate_commit_timestamp=1789436658787751 (2026-09-15 08:44:18.787751 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436658787751*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 63706
#260915  8:44:18 server id 1  end_log_pos 63796 CRC32 0xbf1956a5 	Query	thread_id=65	exec_time=0	error_code=0
SET TIMESTAMP=1789436658/*!*/;
BEGIN
/*!*/;
# at 63796
#260915  8:44:18 server id 1  end_log_pos 63870 CRC32 0xceb75299 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 63870
#260915  8:44:18 server id 1  end_log_pos 65046 CRC32 0x32181cdf 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
8qKoahMBAAAASgAAAH75AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JlSt84=
8qKoah8BAAAAmAQAABb+AAAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfGiqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfKiqGrfHBgy
'/*!*/;
# at 65046
#260915  8:44:18 server id 1  end_log_pos 65077 CRC32 0x07f4a6c1 	Xid = 908
COMMIT/*!*/;
# at 65077
#260915  8:44:24 server id 1  end_log_pos 65156 CRC32 0xf288f203 	Anonymous_GTID	last_committed=52	sequence_number=53	rbr_only=yes	original_committed_timestamp=1789436664407435	immediate_commit_timestamp=1789436664407435	transaction_length=5083
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436664407435 (2026-09-15 08:44:24.407435 SE Asia Standard Time)
# immediate_commit_timestamp=1789436664407435 (2026-09-15 08:44:24.407435 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436664407435*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 65156
#260915  8:44:24 server id 1  end_log_pos 65254 CRC32 0x7dd6e514 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789436664/*!*/;
BEGIN
/*!*/;
# at 65254
#260915  8:44:24 server id 1  end_log_pos 65341 CRC32 0x814ca00c 	Table_map: `pln_up_imy`.`news` mapped to number 89
# at 65341
#260915  8:44:24 server id 1  end_log_pos 70129 CRC32 0xec42c7b2 	Update_rows: table id 89 flags: STMT_END_F

BINLOG '
+KKoahMBAAAAVwAAAD3/AAAAAFkAAAAAAAEACnBsbl91cF9pbXkABG5ld3MADQgPD/78/A8PAREI
EREP/AP8A/cBAgT8A/wDAAAA4B4BAaACAeAMoEyB
+KKoah8BAAAAtBIAAPERAQAAAFkAAAAAAAEAAgAN/////wACAgAAAAAAAAAQAFNpbmVzdGVzaWEg
UHV0aWgQAHNpbmVzdGVzaWEtcHV0aWgEHQBtZXJlcHJlbnRhc2lrYW4gYWRhIGRhbiB0aWFkYaAI
AABbVmVyc2UgMTogQ2hvbGlsIE1haG11ZCAmIEFkcmlhbiBZdW5hbl0NClNhYXQga2VtYXRpYW4g
ZGF0YW5nLCBha3UgYmVyYmFyaW5nIGRhbGFtIChTYWF0IGtlbWF0aWFuIGRhdGFuZykgbW9iaWwg
YW1idWxhbiAoYWt1IGJlcmJhcmluZyksIGRlbmdhciAoZGFsYW0gbW9iaWwgYW1idWxhbikNClBl
bWJpY2FyYWFuIChQZW1iaWNhcmFhbiB0ZW50YW5nIGJpYXlhIHBlbWFrYW1hbikgdGVudGFuZyBw
ZW1ha2FtYW4NCkRhbiB0YWtkaXJrdSBtZW5qZWxhbmcgKFNhYXQgdGFrZGlya3UgbWVuamVsYW5n
KSwgc2lyZW5lIGJlcmxhcmlhbiBzYWh1dC1zYWh1dGFuIChzaXJlbmUgYmVybGFyaWFuIGJlcnNh
aHV0LXNhaHV0YW4pLCB0ZWdhbmcgKHRlZ2FuZykNCk1lbWJ1a2EgamFsYW4gKE1lbWJ1a2EgamFs
YW4gbWVudWp1IFR1aGFuKSBtZW51anUgVHVoYW4NCg0KW0Nob3J1czogQ2hvbGlsIE1haG11ZCAm
IEFkcmlhbiBZdW5hbl0NCkFraGlybnlhIGFrdSB1c2FpIGp1Z2ENCkFraGlybnlhIGFrdSB1c2Fp
IGp1Z2ENCg0KW1ZlcnNlIDI6IENob2xpbCBNYWhtdWQgJiBBZHJpYW4gWXVuYW5dDQpTYWF0IGJl
cmt1bmp1bmcga2UgcnVtYWggKFNhYXQgYmVya3VuanVuZyBrZSBydW1haCkNCk1lbmVuZ29rIGtl
IGthbWFyIChtZW5lbmdvayBrZSBrYW1hcikga2UgcnVhbmcgdGVuZ2FoIChrZSBydWFuZyB0ZW5n
YWgpLCBoYW5nYXQgKGhhbmdhdCkNCk1lbmdoaXJ1cCBiYXUgbWFzYWthbiAoTWVuZ2hpcnVwIGJh
dSBtYXNha2FuIGtlc3VrYWFuKSBrZXN1a2Fhbg0KRGFuIHRhaGxpbGFuIGRpbXVsYWkgKERhbiB0
YWhsaWxhbiBkaW11bGFpKSwgZG9hIGJlcnRhYnVyYW4gKGRvYSBiZXJ0YWJ1cmFuKSwgdGVya2Fk
YW5nIHRhbmdpcyB0ZXJkZW5nYXIgKHRlcmthZGFuZyB0YW5naXMgdGVyZGVuZ2FyKQ0KQWt1IHB1
biBpa3V0IChBa3UgcHVuIGlrdXQgdGVyc2VkdSBzZWRhbikgdGVyc2VkdSBzZWRhbg0KDQpbQ2hv
cnVzOiBBZHJpYW4gWXVuYW4gJiBDaG9saWwgTWFobXVkXQ0KKEFraGlybnlhIGFrdSkgQWtoaXJu
eWEgYWt1IHVzYWkganVnYSAodXNhaSBqdWdhKQ0KKE9oLCBraW5pIGFrdSkgS2luaSBha3UgKGxl
bmdrYXAgc3VkYWgpIGxlbmdrYXAgc3VkYWgNCg0KW091dHJvXQ0KKExhYSBpbGFoYSBpbGxhbGxh
aCkgRGFuIGtlbWF0aWFuLCBrZW5pc2NheWFhbg0KKExhYSBpbGFoYSBpbGxhbGxhaCkgRGkgcGVy
c2ltcGFuZ2FuIGF0YXUga2Vyb25na29uZ2FuDQooTGFhIGlsYWhhIGlsbGFsbGFoKSBUaWJhLXRp
YmEgZGF0YW5nIGF0YXUgZGluYW50aWthbg0KKExhYSBpbGFoYSBpbGxhbGxhaCkgRGFuIGtlbWF0
aWFuLCBrZXNlbXB1cm5hYW4NCihMYWEgaWxhaGEgaWxsYWxsYWgpIERhbiBrZW1hdGlhbiBoYW55
YSBwZXJwaW5kYWhhbg0KKExhYSBpbGFoYSBpbGxhbGxhaCkgRGFuIGtlbWF0aWFuIGF3YWwga2Vr
ZWthbGFuDQooTGFhIGlsYWhhIGlsbGFsbGFoKSBLYXJlbmEga2VtYXRpYW4gdW50dWsga2VoaWR1
cGFuDQpUYW5wYSBrZW1hdGlhbg0KWW91IG1pZ2h0IGFsc28gbGlrZQ0KRGkgVWRhcmENCkVmZWsg
UnVtYWggS2FjYQ0KTWVyYWgNCkVmZWsgUnVtYWggS2FjYQ0KU2ViZWxhaCBNYXRhDQpFZmVrIFJ1
bWFoIEthY2ENCltQYXJ0IDI6IEFkYSAoVW50dWsgQW5nYW4gU2VuamEsIFJpbnRpayBSaW5kdSwg
ZGFuIFNlbXVhIEhhcmFwYW4gZGkgTWFzYSBEZXBhbildDQoNCltJbnRyb10NCkxhbHUgcGVjYWgg
dGFuZ2lzIGJheWkNClNlcGVydGkga2F0YSBXaWppDQpEaXNlYmFyIGJpamktYmlqaQ0KRGlzZW1h
aSBtZW5qYWRpIGFwaQ0KDQpbSW5zdHJ1bWVudGFsXQ0KDQpbVmVyc2UgMV0NClNlbGFtYXQgZGF0
YW5nIGRpIHNhbXVkZXJhDQpPbWJhay1vbWJhayBtZW5lcnBhDQpSZWthaCwgcmVrYWgNCkRhbiBi
ZXJrYWhsYWgNCg0KW1ZlcnNlIDJdDQpEYWxhbSBkaXJpbnlhLCB0ZXJoaW1wdW4NCkFsYW0gcmF5
YSBzZW1lc3RhDQpEYWxhbSBqaXdhbnlhIGJlcmt1bXB1bA0KSGFuZ2F0IHN1cmdhIG5lcmFrYQ0K
DQpbQ2hvcnVzXQ0KSGluZ2dhIGthbiBkYXRhbmcgcGVydGFueWFhbg0KU2VnYWxhIGFwYSB5YW5n
IGRpcmFzYWthbg0KVGVudGFuZyBrZWJhaGFnaWFhbg0KQWlyIG1hdGEgYmVyY3VjdXJhbg0KSGlu
Z2dhIGthbiBkYXRhbmcga2V0YWt1dGFuDQpNZW5qYWdhIGtldGVydXN0ZXJhbmdhbg0KRGFsYW0g
bGFwYXIgZGFuIGtlbnlhbmcNCkRhbGFtIGdlbGFwIGRhbiBiZW5kZXJhbmcxAG5ld3MvajlsQUNw
a2JjN3c3Y0ZZZzBLdVl4WXhsb0xyZEJOZzlGdlNNcXVHeC5wbmcNAENob2xpbCBNYWhtdWQABAAA
AAAAAABqpzJWaqc/EQAAAgAAAAAAAAAQAFNpbmVzdGVzaWEgUHV0aWgQAHNpbmVzdGVzaWEtcHV0
aWgEHQBtZXJlcHJlbnRhc2lrYW4gYWRhIGRhbiB0aWFkYaAIAABbVmVyc2UgMTogQ2hvbGlsIE1h
aG11ZCAmIEFkcmlhbiBZdW5hbl0NClNhYXQga2VtYXRpYW4gZGF0YW5nLCBha3UgYmVyYmFyaW5n
IGRhbGFtIChTYWF0IGtlbWF0aWFuIGRhdGFuZykgbW9iaWwgYW1idWxhbiAoYWt1IGJlcmJhcmlu
ZyksIGRlbmdhciAoZGFsYW0gbW9iaWwgYW1idWxhbikNClBlbWJpY2FyYWFuIChQZW1iaWNhcmFh
biB0ZW50YW5nIGJpYXlhIHBlbWFrYW1hbikgdGVudGFuZyBwZW1ha2FtYW4NCkRhbiB0YWtkaXJr
dSBtZW5qZWxhbmcgKFNhYXQgdGFrZGlya3UgbWVuamVsYW5nKSwgc2lyZW5lIGJlcmxhcmlhbiBz
YWh1dC1zYWh1dGFuIChzaXJlbmUgYmVybGFyaWFuIGJlcnNhaHV0LXNhaHV0YW4pLCB0ZWdhbmcg
KHRlZ2FuZykNCk1lbWJ1a2EgamFsYW4gKE1lbWJ1a2EgamFsYW4gbWVudWp1IFR1aGFuKSBtZW51
anUgVHVoYW4NCg0KW0Nob3J1czogQ2hvbGlsIE1haG11ZCAmIEFkcmlhbiBZdW5hbl0NCkFraGly
bnlhIGFrdSB1c2FpIGp1Z2ENCkFraGlybnlhIGFrdSB1c2FpIGp1Z2ENCg0KW1ZlcnNlIDI6IENo
b2xpbCBNYWhtdWQgJiBBZHJpYW4gWXVuYW5dDQpTYWF0IGJlcmt1bmp1bmcga2UgcnVtYWggKFNh
YXQgYmVya3VuanVuZyBrZSBydW1haCkNCk1lbmVuZ29rIGtlIGthbWFyIChtZW5lbmdvayBrZSBr
YW1hcikga2UgcnVhbmcgdGVuZ2FoIChrZSBydWFuZyB0ZW5nYWgpLCBoYW5nYXQgKGhhbmdhdCkN
Ck1lbmdoaXJ1cCBiYXUgbWFzYWthbiAoTWVuZ2hpcnVwIGJhdSBtYXNha2FuIGtlc3VrYWFuKSBr
ZXN1a2Fhbg0KRGFuIHRhaGxpbGFuIGRpbXVsYWkgKERhbiB0YWhsaWxhbiBkaW11bGFpKSwgZG9h
IGJlcnRhYnVyYW4gKGRvYSBiZXJ0YWJ1cmFuKSwgdGVya2FkYW5nIHRhbmdpcyB0ZXJkZW5nYXIg
KHRlcmthZGFuZyB0YW5naXMgdGVyZGVuZ2FyKQ0KQWt1IHB1biBpa3V0IChBa3UgcHVuIGlrdXQg
dGVyc2VkdSBzZWRhbikgdGVyc2VkdSBzZWRhbg0KDQpbQ2hvcnVzOiBBZHJpYW4gWXVuYW4gJiBD
aG9saWwgTWFobXVkXQ0KKEFraGlybnlhIGFrdSkgQWtoaXJueWEgYWt1IHVzYWkganVnYSAodXNh
aSBqdWdhKQ0KKE9oLCBraW5pIGFrdSkgS2luaSBha3UgKGxlbmdrYXAgc3VkYWgpIGxlbmdrYXAg
c3VkYWgNCg0KW091dHJvXQ0KKExhYSBpbGFoYSBpbGxhbGxhaCkgRGFuIGtlbWF0aWFuLCBrZW5p
c2NheWFhbg0KKExhYSBpbGFoYSBpbGxhbGxhaCkgRGkgcGVyc2ltcGFuZ2FuIGF0YXUga2Vyb25n
a29uZ2FuDQooTGFhIGlsYWhhIGlsbGFsbGFoKSBUaWJhLXRpYmEgZGF0YW5nIGF0YXUgZGluYW50
aWthbg0KKExhYSBpbGFoYSBpbGxhbGxhaCkgRGFuIGtlbWF0aWFuLCBrZXNlbXB1cm5hYW4NCihM
YWEgaWxhaGEgaWxsYWxsYWgpIERhbiBrZW1hdGlhbiBoYW55YSBwZXJwaW5kYWhhbg0KKExhYSBp
bGFoYSBpbGxhbGxhaCkgRGFuIGtlbWF0aWFuIGF3YWwga2VrZWthbGFuDQooTGFhIGlsYWhhIGls
bGFsbGFoKSBLYXJlbmEga2VtYXRpYW4gdW50dWsga2VoaWR1cGFuDQpUYW5wYSBrZW1hdGlhbg0K
WW91IG1pZ2h0IGFsc28gbGlrZQ0KRGkgVWRhcmENCkVmZWsgUnVtYWggS2FjYQ0KTWVyYWgNCkVm
ZWsgUnVtYWggS2FjYQ0KU2ViZWxhaCBNYXRhDQpFZmVrIFJ1bWFoIEthY2ENCltQYXJ0IDI6IEFk
YSAoVW50dWsgQW5nYW4gU2VuamEsIFJpbnRpayBSaW5kdSwgZGFuIFNlbXVhIEhhcmFwYW4gZGkg
TWFzYSBEZXBhbildDQoNCltJbnRyb10NCkxhbHUgcGVjYWggdGFuZ2lzIGJheWkNClNlcGVydGkg
a2F0YSBXaWppDQpEaXNlYmFyIGJpamktYmlqaQ0KRGlzZW1haSBtZW5qYWRpIGFwaQ0KDQpbSW5z
dHJ1bWVudGFsXQ0KDQpbVmVyc2UgMV0NClNlbGFtYXQgZGF0YW5nIGRpIHNhbXVkZXJhDQpPbWJh
ay1vbWJhayBtZW5lcnBhDQpSZWthaCwgcmVrYWgNCkRhbiBiZXJrYWhsYWgNCg0KW1ZlcnNlIDJd
DQpEYWxhbSBkaXJpbnlhLCB0ZXJoaW1wdW4NCkFsYW0gcmF5YSBzZW1lc3RhDQpEYWxhbSBqaXdh
bnlhIGJlcmt1bXB1bA0KSGFuZ2F0IHN1cmdhIG5lcmFrYQ0KDQpbQ2hvcnVzXQ0KSGluZ2dhIGth
biBkYXRhbmcgcGVydGFueWFhbg0KU2VnYWxhIGFwYSB5YW5nIGRpcmFzYWthbg0KVGVudGFuZyBr
ZWJhaGFnaWFhbg0KQWlyIG1hdGEgYmVyY3VjdXJhbg0KSGluZ2dhIGthbiBkYXRhbmcga2V0YWt1
dGFuDQpNZW5qYWdhIGtldGVydXN0ZXJhbmdhbg0KRGFsYW0gbGFwYXIgZGFuIGtlbnlhbmcNCkRh
bGFtIGdlbGFwIGRhbiBiZW5kZXJhbmcxAG5ld3MvajlsQUNwa2JjN3c3Y0ZZZzBLdVl4WXhsb0xy
ZEJOZzlGdlNNcXVHeC5wbmcNAENob2xpbCBNYWhtdWQBaqhAiAQAAAAAAAAAaqcyVmqoQIiyx0Ls
'/*!*/;
# at 70129
#260915  8:44:24 server id 1  end_log_pos 70160 CRC32 0x88516293 	Xid = 923
COMMIT/*!*/;
# at 70160
#260915  8:44:24 server id 1  end_log_pos 70239 CRC32 0xdc9d4f00 	Anonymous_GTID	last_committed=53	sequence_number=54	rbr_only=yes	original_committed_timestamp=1789436664421892	immediate_commit_timestamp=1789436664421892	transaction_length=593
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436664421892 (2026-09-15 08:44:24.421892 SE Asia Standard Time)
# immediate_commit_timestamp=1789436664421892 (2026-09-15 08:44:24.421892 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436664421892*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 70239
#260915  8:44:24 server id 1  end_log_pos 70328 CRC32 0xe6f5f9b3 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789436664/*!*/;
BEGIN
/*!*/;
# at 70328
#260915  8:44:24 server id 1  end_log_pos 70426 CRC32 0xe5d5944e 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 88
# at 70426
#260915  8:44:24 server id 1  end_log_pos 70722 CRC32 0x2e999891 	Write_rows: table id 88 flags: STMT_END_F

BINLOG '
+KKoahMBAAAAYgAAABoTAQAAAFgAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4E6U1eU=
+KKoah4BAAAAKAEAAEIUAQAAAFgAAAAAAAEAAgAN//8AAAQAAAAAAAAABAAAAAAAAAAPAEJ1ZGkg
U2FudG9zbyBKcggAS2FyeWF3YW4GAGJlcml0YQcAcHVibGlzaCgAbWVtdWJsaWthc2lrYW4gYmVy
aXRhICJTaW5lc3Rlc2lhIFB1dGloIg8AQXBwXE1vZGVsc1xOZXdzAgAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZq
qECIaqhAiJGYmS4=
'/*!*/;
# at 70722
#260915  8:44:24 server id 1  end_log_pos 70753 CRC32 0x1734e119 	Xid = 926
COMMIT/*!*/;
# at 70753
#260915  8:44:24 server id 1  end_log_pos 70832 CRC32 0x9a182119 	Anonymous_GTID	last_committed=54	sequence_number=55	rbr_only=yes	original_committed_timestamp=1789436664441973	immediate_commit_timestamp=1789436664441973	transaction_length=1546
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436664441973 (2026-09-15 08:44:24.441973 SE Asia Standard Time)
# immediate_commit_timestamp=1789436664441973 (2026-09-15 08:44:24.441973 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436664441973*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 70832
#260915  8:44:24 server id 1  end_log_pos 70922 CRC32 0x26b20828 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789436664/*!*/;
BEGIN
/*!*/;
# at 70922
#260915  8:44:24 server id 1  end_log_pos 70996 CRC32 0x285cbde4 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 70996
#260915  8:44:24 server id 1  end_log_pos 72268 CRC32 0x6ae6052c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+KKoahMBAAAASgAAAFQVAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OS9XCg=
+KKoah8BAAAA+AQAAEwaAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfKiqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzbkAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNVHA3
YVRvd08zTTZOem9pYzNWalkyVnpjeUk3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5MWMyVnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdS
dGFXNHVkWE5sY25NdWFXNWtaWGdpTzMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzNNNk56b2lj
M1ZqWTJWemN5STdjem96TVRvaVFtVnlhWFJoSUdKbGNtaGhjMmxzSUdScGNIVmliR2xyWVhOcGEy
RnVMaUk3ZlE9PfiiqGosBeZq
'/*!*/;
# at 72268
#260915  8:44:24 server id 1  end_log_pos 72299 CRC32 0x630876e3 	Xid = 929
COMMIT/*!*/;
# at 72299
#260915  8:44:25 server id 1  end_log_pos 72378 CRC32 0x9429d6a3 	Anonymous_GTID	last_committed=55	sequence_number=56	rbr_only=yes	original_committed_timestamp=1789436665024046	immediate_commit_timestamp=1789436665024046	transaction_length=1542
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436665024046 (2026-09-15 08:44:25.024046 SE Asia Standard Time)
# immediate_commit_timestamp=1789436665024046 (2026-09-15 08:44:25.024046 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436665024046*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 72378
#260915  8:44:25 server id 1  end_log_pos 72468 CRC32 0xe1337bbd 	Query	thread_id=67	exec_time=0	error_code=0
SET TIMESTAMP=1789436665/*!*/;
BEGIN
/*!*/;
# at 72468
#260915  8:44:25 server id 1  end_log_pos 72542 CRC32 0x24ef442d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 72542
#260915  8:44:25 server id 1  end_log_pos 73810 CRC32 0x63552650 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+aKoahMBAAAASgAAAF4bAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4C1E7yQ=
+aKoah8BAAAA9AQAAFIgAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzbkAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNVHA3
YVRvd08zTTZOem9pYzNWalkyVnpjeUk3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5MWMyVnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdS
dGFXNHVkWE5sY25NdWFXNWtaWGdpTzMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzNNNk56b2lj
M1ZqWTJWemN5STdjem96TVRvaVFtVnlhWFJoSUdKbGNtaGhjMmxzSUdScGNIVmliR2xyWVhOcGEy
RnVMaUk3ZlE9PfiiqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95R1RwakFiQTl2d3Z6N25KbWY0
BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAu
MC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSa3gz
ZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZCd1NEWkhOa2x0YUNJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNekk2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpYZHpJanR6T2pVNkluSnZkWFJs
SWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlY
elU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8y
azZORHQ5+aKoalAmVWM=
'/*!*/;
# at 73810
#260915  8:44:25 server id 1  end_log_pos 73841 CRC32 0xbab9360a 	Xid = 947
COMMIT/*!*/;
# at 73841
#260915  8:44:36 server id 1  end_log_pos 73920 CRC32 0x0487079e 	Anonymous_GTID	last_committed=56	sequence_number=57	rbr_only=yes	original_committed_timestamp=1789436676341270	immediate_commit_timestamp=1789436676341270	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436676341270 (2026-09-15 08:44:36.341270 SE Asia Standard Time)
# immediate_commit_timestamp=1789436676341270 (2026-09-15 08:44:36.341270 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436676341270*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 73920
#260915  8:44:36 server id 1  end_log_pos 74010 CRC32 0x541a1c4b 	Query	thread_id=68	exec_time=0	error_code=0
SET TIMESTAMP=1789436676/*!*/;
BEGIN
/*!*/;
# at 74010
#260915  8:44:36 server id 1  end_log_pos 74084 CRC32 0x59add51b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 74084
#260915  8:44:36 server id 1  end_log_pos 75252 CRC32 0x70d6b127 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BKOoahMBAAAASgAAAGQhAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BvVrVk=
BKOoah8BAAAAkAQAAPQlAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5+aKoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDkEo6hqJ7HWcA==
'/*!*/;
# at 75252
#260915  8:44:36 server id 1  end_log_pos 75283 CRC32 0xe34f35c5 	Xid = 962
COMMIT/*!*/;
# at 75283
#260915  8:46:25 server id 1  end_log_pos 75362 CRC32 0x9f6e9f4c 	Anonymous_GTID	last_committed=57	sequence_number=58	rbr_only=yes	original_committed_timestamp=1789436785158421	immediate_commit_timestamp=1789436785158421	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436785158421 (2026-09-15 08:46:25.158421 SE Asia Standard Time)
# immediate_commit_timestamp=1789436785158421 (2026-09-15 08:46:25.158421 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436785158421*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 75362
#260915  8:46:25 server id 1  end_log_pos 75452 CRC32 0x19151d47 	Query	thread_id=69	exec_time=0	error_code=0
SET TIMESTAMP=1789436785/*!*/;
BEGIN
/*!*/;
# at 75452
#260915  8:46:25 server id 1  end_log_pos 75526 CRC32 0xa9dde627 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 75526
#260915  8:46:25 server id 1  end_log_pos 76694 CRC32 0xe4f5d096 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
caOoahMBAAAASgAAAAYnAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Cfm3ak=
caOoah8BAAAAkAQAAJYrAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5BKOoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDlxo6hqltD15A==
'/*!*/;
# at 76694
#260915  8:46:25 server id 1  end_log_pos 76725 CRC32 0x691e9096 	Xid = 983
COMMIT/*!*/;
# at 76725
#260915  8:46:26 server id 1  end_log_pos 76804 CRC32 0x4f329751 	Anonymous_GTID	last_committed=58	sequence_number=59	rbr_only=yes	original_committed_timestamp=1789436786896595	immediate_commit_timestamp=1789436786896595	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436786896595 (2026-09-15 08:46:26.896595 SE Asia Standard Time)
# immediate_commit_timestamp=1789436786896595 (2026-09-15 08:46:26.896595 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436786896595*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 76804
#260915  8:46:26 server id 1  end_log_pos 76894 CRC32 0xeb378767 	Query	thread_id=71	exec_time=0	error_code=0
SET TIMESTAMP=1789436786/*!*/;
BEGIN
/*!*/;
# at 76894
#260915  8:46:26 server id 1  end_log_pos 76968 CRC32 0x5e0230ea 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 76968
#260915  8:46:26 server id 1  end_log_pos 78136 CRC32 0x3181d076 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
cqOoahMBAAAASgAAAKgsAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OowAl4=
cqOoah8BAAAAkAQAADgxAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5caOoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDlyo6hqdtCBMQ==
'/*!*/;
# at 78136
#260915  8:46:26 server id 1  end_log_pos 78167 CRC32 0x79a8915d 	Xid = 1031
COMMIT/*!*/;
# at 78167
#260915  8:46:27 server id 1  end_log_pos 78246 CRC32 0xfbfc8de8 	Anonymous_GTID	last_committed=59	sequence_number=60	rbr_only=yes	original_committed_timestamp=1789436787755661	immediate_commit_timestamp=1789436787755661	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436787755661 (2026-09-15 08:46:27.755661 SE Asia Standard Time)
# immediate_commit_timestamp=1789436787755661 (2026-09-15 08:46:27.755661 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436787755661*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 78246
#260915  8:46:27 server id 1  end_log_pos 78336 CRC32 0xcf605ccd 	Query	thread_id=72	exec_time=0	error_code=0
SET TIMESTAMP=1789436787/*!*/;
BEGIN
/*!*/;
# at 78336
#260915  8:46:27 server id 1  end_log_pos 78410 CRC32 0x490cadbe 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 78410
#260915  8:46:27 server id 1  end_log_pos 79578 CRC32 0x729cabeb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
c6OoahMBAAAASgAAAEoyAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4L6tDEk=
c6Ooah8BAAAAkAQAANo2AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5cqOoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDlzo6hq66uccg==
'/*!*/;
# at 79578
#260915  8:46:27 server id 1  end_log_pos 79609 CRC32 0xce0a6383 	Xid = 1052
COMMIT/*!*/;
# at 79609
#260915  8:46:37 server id 1  end_log_pos 79688 CRC32 0x3aa3cfaf 	Anonymous_GTID	last_committed=60	sequence_number=61	rbr_only=yes	original_committed_timestamp=1789436797079289	immediate_commit_timestamp=1789436797079289	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789436797079289 (2026-09-15 08:46:37.079289 SE Asia Standard Time)
# immediate_commit_timestamp=1789436797079289 (2026-09-15 08:46:37.079289 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789436797079289*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 79688
#260915  8:46:37 server id 1  end_log_pos 79778 CRC32 0x45dc767f 	Query	thread_id=73	exec_time=0	error_code=0
SET TIMESTAMP=1789436797/*!*/;
BEGIN
/*!*/;
# at 79778
#260915  8:46:37 server id 1  end_log_pos 79852 CRC32 0x9b7e0804 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 79852
#260915  8:46:37 server id 1  end_log_pos 81020 CRC32 0x8c620245 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
faOoahMBAAAASgAAAOw3AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AQIfps=
faOoah8BAAAAkAQAAHw8AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5c6OoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDl9o6hqRQJijA==
'/*!*/;
# at 81020
#260915  8:46:37 server id 1  end_log_pos 81051 CRC32 0x854eb2eb 	Xid = 1073
COMMIT/*!*/;
# at 81051
#260915  8:56:04 server id 1  end_log_pos 81130 CRC32 0xe8b737e7 	Anonymous_GTID	last_committed=61	sequence_number=62	rbr_only=yes	original_committed_timestamp=1789437364571163	immediate_commit_timestamp=1789437364571163	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437364571163 (2026-09-15 08:56:04.571163 SE Asia Standard Time)
# immediate_commit_timestamp=1789437364571163 (2026-09-15 08:56:04.571163 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437364571163*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 81130
#260915  8:56:04 server id 1  end_log_pos 81220 CRC32 0x16b20028 	Query	thread_id=74	exec_time=0	error_code=0
SET TIMESTAMP=1789437364/*!*/;
BEGIN
/*!*/;
# at 81220
#260915  8:56:04 server id 1  end_log_pos 81294 CRC32 0x719bc087 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 81294
#260915  8:56:04 server id 1  end_log_pos 82470 CRC32 0x3655cdee 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
tKWoahMBAAAASgAAAI49AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IfAm3E=
tKWoah8BAAAAmAQAACZCAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5faOoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16UTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTluWVd4bGNt
a2lPM002TlRvaWNtOTFkR1VpTzNNNk1UZzZJbUZrYldsdUxtZGhiR1Z5YVM1cGJtUmxlQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PbSlqGruzVU2
'/*!*/;
# at 82470
#260915  8:56:04 server id 1  end_log_pos 82501 CRC32 0xa36fc0ad 	Xid = 1094
COMMIT/*!*/;
# at 82501
#260915  8:56:07 server id 1  end_log_pos 82580 CRC32 0xc922ad3c 	Anonymous_GTID	last_committed=62	sequence_number=63	rbr_only=yes	original_committed_timestamp=1789437367959815	immediate_commit_timestamp=1789437367959815	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437367959815 (2026-09-15 08:56:07.959815 SE Asia Standard Time)
# immediate_commit_timestamp=1789437367959815 (2026-09-15 08:56:07.959815 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437367959815*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 82580
#260915  8:56:07 server id 1  end_log_pos 82670 CRC32 0xe660d89e 	Query	thread_id=75	exec_time=0	error_code=0
SET TIMESTAMP=1789437367/*!*/;
BEGIN
/*!*/;
# at 82670
#260915  8:56:07 server id 1  end_log_pos 82744 CRC32 0x77ef5877 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 82744
#260915  8:56:07 server id 1  end_log_pos 83928 CRC32 0xf7025d0c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
t6WoahMBAAAASgAAADhDAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HdY73c=
t6Woah8BAAAAoAQAANhHAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT20pahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OW5ZV3hsY21raU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1TG1kaGJHVnlhUzVwYm1S
bGVDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09t6WoagxdAvc=
'/*!*/;
# at 83928
#260915  8:56:07 server id 1  end_log_pos 83959 CRC32 0x37ac5ac9 	Xid = 1121
COMMIT/*!*/;
# at 83959
#260915  8:56:08 server id 1  end_log_pos 84038 CRC32 0xce2619e1 	Anonymous_GTID	last_committed=63	sequence_number=64	rbr_only=yes	original_committed_timestamp=1789437368703975	immediate_commit_timestamp=1789437368703975	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437368703975 (2026-09-15 08:56:08.703975 SE Asia Standard Time)
# immediate_commit_timestamp=1789437368703975 (2026-09-15 08:56:08.703975 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437368703975*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 84038
#260915  8:56:08 server id 1  end_log_pos 84128 CRC32 0xdd5abdae 	Query	thread_id=76	exec_time=0	error_code=0
SET TIMESTAMP=1789437368/*!*/;
BEGIN
/*!*/;
# at 84128
#260915  8:56:08 server id 1  end_log_pos 84202 CRC32 0x51e39c3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 84202
#260915  8:56:08 server id 1  end_log_pos 85386 CRC32 0x34d04fa3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
uKWoahMBAAAASgAAAOpIAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Dqc41E=
uKWoah8BAAAAoAQAAIpNAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT23pahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OW5ZV3hsY21raU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1TG1kaGJHVnlhUzVwYm1S
bGVDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09uKWoaqNP0DQ=
'/*!*/;
# at 85386
#260915  8:56:08 server id 1  end_log_pos 85417 CRC32 0x874a0acc 	Xid = 1142
COMMIT/*!*/;
# at 85417
#260915  8:56:09 server id 1  end_log_pos 85496 CRC32 0x3141919a 	Anonymous_GTID	last_committed=64	sequence_number=65	rbr_only=yes	original_committed_timestamp=1789437369766826	immediate_commit_timestamp=1789437369766826	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437369766826 (2026-09-15 08:56:09.766826 SE Asia Standard Time)
# immediate_commit_timestamp=1789437369766826 (2026-09-15 08:56:09.766826 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437369766826*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 85496
#260915  8:56:09 server id 1  end_log_pos 85586 CRC32 0x545d50ef 	Query	thread_id=77	exec_time=0	error_code=0
SET TIMESTAMP=1789437369/*!*/;
BEGIN
/*!*/;
# at 85586
#260915  8:56:09 server id 1  end_log_pos 85660 CRC32 0x7860c7bd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 85660
#260915  8:56:09 server id 1  end_log_pos 86844 CRC32 0xa63ca2b0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
uaWoahMBAAAASgAAAJxOAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4L3HYHg=
uaWoah8BAAAAoAQAADxTAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT24pahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09uaWoarCiPKY=
'/*!*/;
# at 86844
#260915  8:56:09 server id 1  end_log_pos 86875 CRC32 0x602f0612 	Xid = 1175
COMMIT/*!*/;
# at 86875
#260915  8:56:12 server id 1  end_log_pos 86954 CRC32 0xe8d89cce 	Anonymous_GTID	last_committed=65	sequence_number=66	rbr_only=yes	original_committed_timestamp=1789437372396714	immediate_commit_timestamp=1789437372396714	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437372396714 (2026-09-15 08:56:12.396714 SE Asia Standard Time)
# immediate_commit_timestamp=1789437372396714 (2026-09-15 08:56:12.396714 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437372396714*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 86954
#260915  8:56:12 server id 1  end_log_pos 87044 CRC32 0x98ec592c 	Query	thread_id=78	exec_time=0	error_code=0
SET TIMESTAMP=1789437372/*!*/;
BEGIN
/*!*/;
# at 87044
#260915  8:56:12 server id 1  end_log_pos 87118 CRC32 0x55b7925b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 87118
#260915  8:56:12 server id 1  end_log_pos 88302 CRC32 0x76df2645 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
vKWoahMBAAAASgAAAE5UAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FuSt1U=
vKWoah8BAAAAoAQAAO5YAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT25pahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09vKWoakUm33Y=
'/*!*/;
# at 88302
#260915  8:56:12 server id 1  end_log_pos 88333 CRC32 0xdc5cd8d3 	Xid = 1199
COMMIT/*!*/;
# at 88333
#260915  8:56:19 server id 1  end_log_pos 88412 CRC32 0x2e744d80 	Anonymous_GTID	last_committed=66	sequence_number=67	rbr_only=yes	original_committed_timestamp=1789437379588532	immediate_commit_timestamp=1789437379588532	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437379588532 (2026-09-15 08:56:19.588532 SE Asia Standard Time)
# immediate_commit_timestamp=1789437379588532 (2026-09-15 08:56:19.588532 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437379588532*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 88412
#260915  8:56:19 server id 1  end_log_pos 88502 CRC32 0xd7f81a7e 	Query	thread_id=79	exec_time=0	error_code=0
SET TIMESTAMP=1789437379/*!*/;
BEGIN
/*!*/;
# at 88502
#260915  8:56:19 server id 1  end_log_pos 88576 CRC32 0x59441c20 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 88576
#260915  8:56:19 server id 1  end_log_pos 89760 CRC32 0xeacec28f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
w6WoahMBAAAASgAAAABaAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CAcRFk=
w6Woah8BAAAAoAQAAKBeAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT28pahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09w6Woao/Czuo=
'/*!*/;
# at 89760
#260915  8:56:19 server id 1  end_log_pos 89791 CRC32 0xb50ccb7b 	Xid = 1220
COMMIT/*!*/;
# at 89791
#260915  8:56:20 server id 1  end_log_pos 89870 CRC32 0x05e89f3d 	Anonymous_GTID	last_committed=67	sequence_number=68	rbr_only=yes	original_committed_timestamp=1789437380513149	immediate_commit_timestamp=1789437380513149	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437380513149 (2026-09-15 08:56:20.513149 SE Asia Standard Time)
# immediate_commit_timestamp=1789437380513149 (2026-09-15 08:56:20.513149 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437380513149*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 89870
#260915  8:56:20 server id 1  end_log_pos 89960 CRC32 0x64c53084 	Query	thread_id=80	exec_time=0	error_code=0
SET TIMESTAMP=1789437380/*!*/;
BEGIN
/*!*/;
# at 89960
#260915  8:56:20 server id 1  end_log_pos 90034 CRC32 0x478521fb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 90034
#260915  8:56:20 server id 1  end_log_pos 91218 CRC32 0x657e57e9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
xKWoahMBAAAASgAAALJfAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PshhUc=
xKWoah8BAAAAoAQAAFJkAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3DpahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09xKWoaulXfmU=
'/*!*/;
# at 91218
#260915  8:56:20 server id 1  end_log_pos 91249 CRC32 0xb4106f9d 	Xid = 1241
COMMIT/*!*/;
# at 91249
#260915  8:56:22 server id 1  end_log_pos 91328 CRC32 0xe76c3fbc 	Anonymous_GTID	last_committed=68	sequence_number=69	rbr_only=yes	original_committed_timestamp=1789437382837053	immediate_commit_timestamp=1789437382837053	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437382837053 (2026-09-15 08:56:22.837053 SE Asia Standard Time)
# immediate_commit_timestamp=1789437382837053 (2026-09-15 08:56:22.837053 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437382837053*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 91328
#260915  8:56:22 server id 1  end_log_pos 91418 CRC32 0x9085ca17 	Query	thread_id=81	exec_time=0	error_code=0
SET TIMESTAMP=1789437382/*!*/;
BEGIN
/*!*/;
# at 91418
#260915  8:56:22 server id 1  end_log_pos 91492 CRC32 0x59fae4bf 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 91492
#260915  8:56:22 server id 1  end_log_pos 92676 CRC32 0xbce27c69 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
xqWoahMBAAAASgAAAGRlAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4L/k+lk=
xqWoah8BAAAAoAQAAARqAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3EpahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09xqWoaml84rw=
'/*!*/;
# at 92676
#260915  8:56:22 server id 1  end_log_pos 92707 CRC32 0x22723f2a 	Xid = 1274
COMMIT/*!*/;
# at 92707
#260915  8:56:35 server id 1  end_log_pos 92786 CRC32 0x69027898 	Anonymous_GTID	last_committed=69	sequence_number=70	rbr_only=yes	original_committed_timestamp=1789437395900655	immediate_commit_timestamp=1789437395900655	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437395900655 (2026-09-15 08:56:35.900655 SE Asia Standard Time)
# immediate_commit_timestamp=1789437395900655 (2026-09-15 08:56:35.900655 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437395900655*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 92786
#260915  8:56:35 server id 1  end_log_pos 92876 CRC32 0x8d906e7b 	Query	thread_id=82	exec_time=0	error_code=0
SET TIMESTAMP=1789437395/*!*/;
BEGIN
/*!*/;
# at 92876
#260915  8:56:35 server id 1  end_log_pos 92950 CRC32 0xd6a71a8a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 92950
#260915  8:56:35 server id 1  end_log_pos 94094 CRC32 0x0cdecf88 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
06WoahMBAAAASgAAABZrAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ioap9Y=
06Woah8BAAAAeAQAAI5vAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3GpahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9p
SnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDnTpahq
iM/eDA==
'/*!*/;
# at 94094
#260915  8:56:35 server id 1  end_log_pos 94125 CRC32 0x28bfe7bb 	Xid = 1286
COMMIT/*!*/;
# at 94125
#260915  8:56:43 server id 1  end_log_pos 94204 CRC32 0x979bcc17 	Anonymous_GTID	last_committed=70	sequence_number=71	rbr_only=yes	original_committed_timestamp=1789437403320594	immediate_commit_timestamp=1789437403320594	transaction_length=894
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437403320594 (2026-09-15 08:56:43.320594 SE Asia Standard Time)
# immediate_commit_timestamp=1789437403320594 (2026-09-15 08:56:43.320594 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437403320594*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 94204
#260915  8:56:43 server id 1  end_log_pos 94285 CRC32 0x0948224d 	Query	thread_id=83	exec_time=0	error_code=0
SET TIMESTAMP=1789437403/*!*/;
BEGIN
/*!*/;
# at 94285
#260915  8:56:43 server id 1  end_log_pos 94359 CRC32 0x43ea9a4e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 94359
#260915  8:56:43 server id 1  end_log_pos 94988 CRC32 0xf7d10727 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
26WoahMBAAAASgAAAJdwAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E6a6kM=
26WoaiABAAAAdQIAAAxzAQAAAFMAAAAAAAEAAgAG/wAoAFhpM2xwNXhqSlhhaTFnSG5ZUHhUa3Vi
SVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpwBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZWeWNEaE5TVlZQVERoV1lqUjNOMmMy
V1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16UTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTluWVd4
bGNta2lPM002TlRvaWNtOTFkR1VpTzNNNk1UZzZJbUZrYldsdUxtZGhiR1Z5YVM1cGJtUmxlQ0k3
ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZ
ekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9HbOnaicH
0fc=
'/*!*/;
# at 94988
#260915  8:56:43 server id 1  end_log_pos 95019 CRC32 0xa07e916f 	Xid = 1295
COMMIT/*!*/;
# at 95019
#260915  8:56:43 server id 1  end_log_pos 95098 CRC32 0x8cdb0e04 	Anonymous_GTID	last_committed=71	sequence_number=72	rbr_only=yes	original_committed_timestamp=1789437403554796	immediate_commit_timestamp=1789437403554796	transaction_length=1406
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437403554796 (2026-09-15 08:56:43.554796 SE Asia Standard Time)
# immediate_commit_timestamp=1789437403554796 (2026-09-15 08:56:43.554796 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437403554796*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 95098
#260915  8:56:43 server id 1  end_log_pos 95188 CRC32 0x9fd1c315 	Query	thread_id=83	exec_time=0	error_code=0
SET TIMESTAMP=1789437403/*!*/;
BEGIN
/*!*/;
# at 95188
#260915  8:56:43 server id 1  end_log_pos 95262 CRC32 0x0b309e9d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 95262
#260915  8:56:43 server id 1  end_log_pos 96394 CRC32 0x253ee6ed 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
26WoahMBAAAASgAAAB50AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4J2eMAs=
26Woah8BAAAAbAQAAIp4AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OdOlqGoAKABM
d2xrM1RCeUVNNXdoblJ3b05LSk95R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloy
MHlOemw0Y1RoaU9UbDVNMFptVEZCd1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpw
N2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemc2SW1oMGRIQTZMeTh4TWpjdU1DNHdM
akU2T0RBd01DOXBibVp2Y20xaGMya3ZZbVZ5YVhSaElqdHpPalU2SW5KdmRYUmxJanR6T2pZNklt
SmxjbWwwWVNJN2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURF
MU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3bpahq7eY+JQ==
'/*!*/;
# at 96394
#260915  8:56:43 server id 1  end_log_pos 96425 CRC32 0xdd5b3a52 	Xid = 1307
COMMIT/*!*/;
# at 96425
#260915  8:56:54 server id 1  end_log_pos 96504 CRC32 0x97a2b7fc 	Anonymous_GTID	last_committed=72	sequence_number=73	rbr_only=yes	original_committed_timestamp=1789437414479275	immediate_commit_timestamp=1789437414479275	transaction_length=1434
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437414479275 (2026-09-15 08:56:54.479275 SE Asia Standard Time)
# immediate_commit_timestamp=1789437414479275 (2026-09-15 08:56:54.479275 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437414479275*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 96504
#260915  8:56:54 server id 1  end_log_pos 96594 CRC32 0xc2c2561f 	Query	thread_id=84	exec_time=0	error_code=0
SET TIMESTAMP=1789437414/*!*/;
BEGIN
/*!*/;
# at 96594
#260915  8:56:54 server id 1  end_log_pos 96668 CRC32 0x7e7f5d68 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 96668
#260915  8:56:54 server id 1  end_log_pos 97828 CRC32 0x3853092e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
5qWoahMBAAAASgAAAJx5AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ghdf34=
5qWoah8BAAAAiAQAACR+AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemc2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXBibVp2Y20xaGMy
a3ZZbVZ5YVhSaElqdHpPalU2SW5KdmRYUmxJanR6T2pZNkltSmxjbWwwWVNJN2ZYTTZOVEE2SW14
dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJs
TXpBNU9EbGtJanRwT2pRN2ZRPT3bpahqACgATHdsazNUQnlFTTV3aG5Sd29OS0pPeUdUcGpBYkE5
dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2fAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBabVRGQndTRFpITmts
dGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFY
UmhJanR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT095qWoai4JUzg=
'/*!*/;
# at 97828
#260915  8:56:54 server id 1  end_log_pos 97859 CRC32 0xa5667d4d 	Xid = 1331
COMMIT/*!*/;
# at 97859
#260915  8:56:57 server id 1  end_log_pos 97938 CRC32 0x77f1626b 	Anonymous_GTID	last_committed=73	sequence_number=74	rbr_only=yes	original_committed_timestamp=1789437417688446	immediate_commit_timestamp=1789437417688446	transaction_length=1434
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437417688446 (2026-09-15 08:56:57.688446 SE Asia Standard Time)
# immediate_commit_timestamp=1789437417688446 (2026-09-15 08:56:57.688446 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437417688446*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 97938
#260915  8:56:57 server id 1  end_log_pos 98028 CRC32 0x93e49ec9 	Query	thread_id=85	exec_time=0	error_code=0
SET TIMESTAMP=1789437417/*!*/;
BEGIN
/*!*/;
# at 98028
#260915  8:56:57 server id 1  end_log_pos 98102 CRC32 0x74292e70 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 98102
#260915  8:56:57 server id 1  end_log_pos 99262 CRC32 0xa688d679 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6aWoahMBAAAASgAAADZ/AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HAuKXQ=
6aWoah8BAAAAiAQAAL6DAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemc2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXBibVp2Y20xaGMy
a3ZZbVZ5YVhSaElqdHpPalU2SW5KdmRYUmxJanR6T2pZNkltSmxjbWwwWVNJN2ZYTTZOVEE2SW14
dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJs
TXpBNU9EbGtJanRwT2pRN2ZRPT3mpahqACgATHdsazNUQnlFTTV3aG5Sd29OS0pPeUdUcGpBYkE5
dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2fAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBabVRGQndTRFpITmts
dGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFY
UmhJanR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT096aWoannWiKY=
'/*!*/;
# at 99262
#260915  8:56:57 server id 1  end_log_pos 99293 CRC32 0x37e3df64 	Xid = 1352
COMMIT/*!*/;
# at 99293
#260915  8:56:58 server id 1  end_log_pos 99372 CRC32 0xdf4793cd 	Anonymous_GTID	last_committed=74	sequence_number=75	rbr_only=yes	original_committed_timestamp=1789437418812660	immediate_commit_timestamp=1789437418812660	transaction_length=1462
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437418812660 (2026-09-15 08:56:58.812660 SE Asia Standard Time)
# immediate_commit_timestamp=1789437418812660 (2026-09-15 08:56:58.812660 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437418812660*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 99372
#260915  8:56:58 server id 1  end_log_pos 99462 CRC32 0xc8ea0dd2 	Query	thread_id=86	exec_time=0	error_code=0
SET TIMESTAMP=1789437418/*!*/;
BEGIN
/*!*/;
# at 99462
#260915  8:56:58 server id 1  end_log_pos 99536 CRC32 0xc54095c7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 99536
#260915  8:56:58 server id 1  end_log_pos 100724 CRC32 0xd23e0567 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6qWoahMBAAAASgAAANCEAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MeVQMU=
6qWoah8BAAAApAQAAHSJAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemc2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXBibVp2Y20xaGMy
a3ZZbVZ5YVhSaElqdHpPalU2SW5KdmRYUmxJanR6T2pZNkltSmxjbWwwWVNJN2ZYTTZOVEE2SW14
dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJs
TXpBNU9EbGtJanRwT2pRN2ZRPT3ppahqACgATHdsazNUQnlFTTV3aG5Sd29OS0pPeUdUcGpBYkE5
dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2mAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBabVRGQndTRFpITmts
dGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhibTV2ZFc1alpX
MWxiblJ6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoYm01dmRXNWpaVzFsYm5S
ekxtbHVaR1Y0SWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3
TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OeqlqGpnBT7S
'/*!*/;
# at 100724
#260915  8:56:58 server id 1  end_log_pos 100755 CRC32 0x005109bf 	Xid = 1373
COMMIT/*!*/;
# at 100755
#260915  8:56:59 server id 1  end_log_pos 100834 CRC32 0x249b713d 	Anonymous_GTID	last_committed=75	sequence_number=76	rbr_only=yes	original_committed_timestamp=1789437419557469	immediate_commit_timestamp=1789437419557469	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437419557469 (2026-09-15 08:56:59.557469 SE Asia Standard Time)
# immediate_commit_timestamp=1789437419557469 (2026-09-15 08:56:59.557469 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437419557469*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 100834
#260915  8:56:59 server id 1  end_log_pos 100924 CRC32 0xc9c44265 	Query	thread_id=87	exec_time=0	error_code=0
SET TIMESTAMP=1789437419/*!*/;
BEGIN
/*!*/;
# at 100924
#260915  8:56:59 server id 1  end_log_pos 100998 CRC32 0xa3d310fa 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 100998
#260915  8:56:59 server id 1  end_log_pos 102214 CRC32 0xcbf2df41 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
66WoahMBAAAASgAAAIaKAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PoQ06M=
66Woah8BAAAAwAQAAEaPAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ56qWoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDnrpahqQd/yyw==
'/*!*/;
# at 102214
#260915  8:56:59 server id 1  end_log_pos 102245 CRC32 0x7fb0aac8 	Xid = 1394
COMMIT/*!*/;
# at 102245
#260915  8:57:00 server id 1  end_log_pos 102324 CRC32 0xc52d2fc9 	Anonymous_GTID	last_committed=76	sequence_number=77	rbr_only=yes	original_committed_timestamp=1789437420449243	immediate_commit_timestamp=1789437420449243	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437420449243 (2026-09-15 08:57:00.449243 SE Asia Standard Time)
# immediate_commit_timestamp=1789437420449243 (2026-09-15 08:57:00.449243 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437420449243*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 102324
#260915  8:57:00 server id 1  end_log_pos 102414 CRC32 0xb8f9c4db 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789437420/*!*/;
BEGIN
/*!*/;
# at 102414
#260915  8:57:00 server id 1  end_log_pos 102488 CRC32 0x9b35ef7a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 102488
#260915  8:57:00 server id 1  end_log_pos 103704 CRC32 0xda4f714f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7KWoahMBAAAASgAAAFiQAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HrvNZs=
7KWoah8BAAAAwAQAABiVAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ566WoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDnspahqT3FP2g==
'/*!*/;
# at 103704
#260915  8:57:00 server id 1  end_log_pos 103735 CRC32 0x52d339ac 	Xid = 1415
COMMIT/*!*/;
# at 103735
#260915  8:57:04 server id 1  end_log_pos 103814 CRC32 0xb3fe7912 	Anonymous_GTID	last_committed=77	sequence_number=78	rbr_only=yes	original_committed_timestamp=1789437424393436	immediate_commit_timestamp=1789437424393436	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437424393436 (2026-09-15 08:57:04.393436 SE Asia Standard Time)
# immediate_commit_timestamp=1789437424393436 (2026-09-15 08:57:04.393436 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437424393436*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 103814
#260915  8:57:04 server id 1  end_log_pos 103904 CRC32 0x1c17fad2 	Query	thread_id=90	exec_time=0	error_code=0
SET TIMESTAMP=1789437424/*!*/;
BEGIN
/*!*/;
# at 103904
#260915  8:57:04 server id 1  end_log_pos 103978 CRC32 0x07047e07 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 103978
#260915  8:57:04 server id 1  end_log_pos 105194 CRC32 0xcc915d35 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
8KWoahMBAAAASgAAACqWAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ad+BAc=
8KWoah8BAAAAwAQAAOqaAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ57KWoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDnwpahqNV2RzA==
'/*!*/;
# at 105194
#260915  8:57:04 server id 1  end_log_pos 105225 CRC32 0x3e8d662c 	Xid = 1460
COMMIT/*!*/;
# at 105225
#260915  8:57:07 server id 1  end_log_pos 105304 CRC32 0xb78d60f7 	Anonymous_GTID	last_committed=78	sequence_number=79	rbr_only=yes	original_committed_timestamp=1789437427035042	immediate_commit_timestamp=1789437427035042	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437427035042 (2026-09-15 08:57:07.035042 SE Asia Standard Time)
# immediate_commit_timestamp=1789437427035042 (2026-09-15 08:57:07.035042 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437427035042*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 105304
#260915  8:57:07 server id 1  end_log_pos 105394 CRC32 0xa478baf9 	Query	thread_id=91	exec_time=0	error_code=0
SET TIMESTAMP=1789437427/*!*/;
BEGIN
/*!*/;
# at 105394
#260915  8:57:07 server id 1  end_log_pos 105468 CRC32 0x1696b55e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 105468
#260915  8:57:07 server id 1  end_log_pos 106684 CRC32 0x8e5476ce 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
86WoahMBAAAASgAAAPybAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4F61lhY=
86Woah8BAAAAwAQAALygAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ58KWoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDnzpahqznZUjg==
'/*!*/;
# at 106684
#260915  8:57:07 server id 1  end_log_pos 106715 CRC32 0x1fea7df0 	Xid = 1481
COMMIT/*!*/;
# at 106715
#260915  8:57:13 server id 1  end_log_pos 106794 CRC32 0x9a935e57 	Anonymous_GTID	last_committed=79	sequence_number=80	rbr_only=yes	original_committed_timestamp=1789437433829295	immediate_commit_timestamp=1789437433829295	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437433829295 (2026-09-15 08:57:13.829295 SE Asia Standard Time)
# immediate_commit_timestamp=1789437433829295 (2026-09-15 08:57:13.829295 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437433829295*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 106794
#260915  8:57:13 server id 1  end_log_pos 106884 CRC32 0x08c9dfe9 	Query	thread_id=93	exec_time=0	error_code=0
SET TIMESTAMP=1789437433/*!*/;
BEGIN
/*!*/;
# at 106884
#260915  8:57:13 server id 1  end_log_pos 106958 CRC32 0x102b3c9d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 106958
#260915  8:57:13 server id 1  end_log_pos 108174 CRC32 0xd32d3043 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+aWoahMBAAAASgAAAM6hAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4J08KxA=
+aWoah8BAAAAwAQAAI6mAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ586WoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn5pahqQzAt0w==
'/*!*/;
# at 108174
#260915  8:57:13 server id 1  end_log_pos 108205 CRC32 0x37f5e9ab 	Xid = 1529
COMMIT/*!*/;
# at 108205
#260915  8:57:17 server id 1  end_log_pos 108284 CRC32 0x4ac2bad1 	Anonymous_GTID	last_committed=80	sequence_number=81	rbr_only=yes	original_committed_timestamp=1789437437472841	immediate_commit_timestamp=1789437437472841	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437437472841 (2026-09-15 08:57:17.472841 SE Asia Standard Time)
# immediate_commit_timestamp=1789437437472841 (2026-09-15 08:57:17.472841 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437437472841*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 108284
#260915  8:57:17 server id 1  end_log_pos 108374 CRC32 0x25b2e40a 	Query	thread_id=94	exec_time=0	error_code=0
SET TIMESTAMP=1789437437/*!*/;
BEGIN
/*!*/;
# at 108374
#260915  8:57:17 server id 1  end_log_pos 108448 CRC32 0x4aad0bbd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 108448
#260915  8:57:17 server id 1  end_log_pos 109664 CRC32 0x599a7d1a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/aWoahMBAAAASgAAAKCnAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4L0LrUo=
/aWoah8BAAAAwAQAAGCsAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5+aWoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn9pahqGn2aWQ==
'/*!*/;
# at 109664
#260915  8:57:17 server id 1  end_log_pos 109695 CRC32 0xedbb03d4 	Xid = 1550
COMMIT/*!*/;
# at 109695
#260915  8:57:19 server id 1  end_log_pos 109774 CRC32 0xcfa70176 	Anonymous_GTID	last_committed=81	sequence_number=82	rbr_only=yes	original_committed_timestamp=1789437439535080	immediate_commit_timestamp=1789437439535080	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437439535080 (2026-09-15 08:57:19.535080 SE Asia Standard Time)
# immediate_commit_timestamp=1789437439535080 (2026-09-15 08:57:19.535080 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437439535080*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 109774
#260915  8:57:19 server id 1  end_log_pos 109864 CRC32 0x90dbbe44 	Query	thread_id=95	exec_time=0	error_code=0
SET TIMESTAMP=1789437439/*!*/;
BEGIN
/*!*/;
# at 109864
#260915  8:57:19 server id 1  end_log_pos 109938 CRC32 0x3019ca3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 109938
#260915  8:57:19 server id 1  end_log_pos 111154 CRC32 0x3e74a49a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/6WoahMBAAAASgAAAHKtAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DrKGTA=
/6Woah8BAAAAwAQAADKyAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5/aWoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn/pahqmqR0Pg==
'/*!*/;
# at 111154
#260915  8:57:19 server id 1  end_log_pos 111185 CRC32 0x1acec5e3 	Xid = 1571
COMMIT/*!*/;
# at 111185
#260915  8:57:20 server id 1  end_log_pos 111264 CRC32 0x72c22c5e 	Anonymous_GTID	last_committed=82	sequence_number=83	rbr_only=yes	original_committed_timestamp=1789437440351823	immediate_commit_timestamp=1789437440351823	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437440351823 (2026-09-15 08:57:20.351823 SE Asia Standard Time)
# immediate_commit_timestamp=1789437440351823 (2026-09-15 08:57:20.351823 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437440351823*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 111264
#260915  8:57:20 server id 1  end_log_pos 111354 CRC32 0xa7e9aae7 	Query	thread_id=96	exec_time=0	error_code=0
SET TIMESTAMP=1789437440/*!*/;
BEGIN
/*!*/;
# at 111354
#260915  8:57:20 server id 1  end_log_pos 111428 CRC32 0x5b0536ed 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 111428
#260915  8:57:20 server id 1  end_log_pos 112644 CRC32 0x3e7d86df 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
AKaoahMBAAAASgAAAESzAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O02BVs=
AKaoah8BAAAAwAQAAAS4AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5/6WoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkApqhq34Z9Pg==
'/*!*/;
# at 112644
#260915  8:57:20 server id 1  end_log_pos 112675 CRC32 0x36498225 	Xid = 1592
COMMIT/*!*/;
# at 112675
#260915  8:57:23 server id 1  end_log_pos 112754 CRC32 0xebe460ef 	Anonymous_GTID	last_committed=83	sequence_number=84	rbr_only=yes	original_committed_timestamp=1789437443350083	immediate_commit_timestamp=1789437443350083	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437443350083 (2026-09-15 08:57:23.350083 SE Asia Standard Time)
# immediate_commit_timestamp=1789437443350083 (2026-09-15 08:57:23.350083 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437443350083*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 112754
#260915  8:57:23 server id 1  end_log_pos 112844 CRC32 0x7010ef52 	Query	thread_id=97	exec_time=0	error_code=0
SET TIMESTAMP=1789437443/*!*/;
BEGIN
/*!*/;
# at 112844
#260915  8:57:23 server id 1  end_log_pos 112918 CRC32 0x9ba5c5ca 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 112918
#260915  8:57:23 server id 1  end_log_pos 114134 CRC32 0x5a72d04a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
A6aoahMBAAAASgAAABa5AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MrFpZs=
A6aoah8BAAAAwAQAANa9AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5AKaoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkDpqhqStByWg==
'/*!*/;
# at 114134
#260915  8:57:23 server id 1  end_log_pos 114165 CRC32 0x49c9cfd1 	Xid = 1619
COMMIT/*!*/;
# at 114165
#260915  8:57:27 server id 1  end_log_pos 114244 CRC32 0xd5a015e8 	Anonymous_GTID	last_committed=84	sequence_number=85	rbr_only=yes	original_committed_timestamp=1789437447406025	immediate_commit_timestamp=1789437447406025	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437447406025 (2026-09-15 08:57:27.406025 SE Asia Standard Time)
# immediate_commit_timestamp=1789437447406025 (2026-09-15 08:57:27.406025 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437447406025*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 114244
#260915  8:57:27 server id 1  end_log_pos 114334 CRC32 0x0a6e7d7b 	Query	thread_id=98	exec_time=0	error_code=0
SET TIMESTAMP=1789437447/*!*/;
BEGIN
/*!*/;
# at 114334
#260915  8:57:27 server id 1  end_log_pos 114408 CRC32 0x6e18cbf7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 114408
#260915  8:57:27 server id 1  end_log_pos 115624 CRC32 0x2afedd10 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
B6aoahMBAAAASgAAAOi+AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PfLGG4=
B6aoah8BAAAAwAQAAKjDAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5A6aoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkHpqhqEN3+Kg==
'/*!*/;
# at 115624
#260915  8:57:27 server id 1  end_log_pos 115655 CRC32 0xfa851b92 	Xid = 1640
COMMIT/*!*/;
# at 115655
#260915  8:57:29 server id 1  end_log_pos 115734 CRC32 0xb444e55d 	Anonymous_GTID	last_committed=85	sequence_number=86	rbr_only=yes	original_committed_timestamp=1789437449090803	immediate_commit_timestamp=1789437449090803	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437449090803 (2026-09-15 08:57:29.090803 SE Asia Standard Time)
# immediate_commit_timestamp=1789437449090803 (2026-09-15 08:57:29.090803 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437449090803*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 115734
#260915  8:57:29 server id 1  end_log_pos 115824 CRC32 0x50286d42 	Query	thread_id=99	exec_time=0	error_code=0
SET TIMESTAMP=1789437449/*!*/;
BEGIN
/*!*/;
# at 115824
#260915  8:57:29 server id 1  end_log_pos 115898 CRC32 0xe1758f5a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 115898
#260915  8:57:29 server id 1  end_log_pos 117114 CRC32 0x1162a446 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
CaaoahMBAAAASgAAALrEAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FqPdeE=
Caaoah8BAAAAwAQAAHrJAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5B6aoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkJpqhqRqRiEQ==
'/*!*/;
# at 117114
#260915  8:57:29 server id 1  end_log_pos 117145 CRC32 0x66ca57ab 	Xid = 1661
COMMIT/*!*/;
# at 117145
#260915  8:57:32 server id 1  end_log_pos 117224 CRC32 0x06338a0d 	Anonymous_GTID	last_committed=86	sequence_number=87	rbr_only=yes	original_committed_timestamp=1789437452273415	immediate_commit_timestamp=1789437452273415	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437452273415 (2026-09-15 08:57:32.273415 SE Asia Standard Time)
# immediate_commit_timestamp=1789437452273415 (2026-09-15 08:57:32.273415 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437452273415*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 117224
#260915  8:57:32 server id 1  end_log_pos 117314 CRC32 0x4b80e472 	Query	thread_id=100	exec_time=0	error_code=0
SET TIMESTAMP=1789437452/*!*/;
BEGIN
/*!*/;
# at 117314
#260915  8:57:32 server id 1  end_log_pos 117388 CRC32 0x06b62bcd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 117388
#260915  8:57:32 server id 1  end_log_pos 118604 CRC32 0xfb50b8c2 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
DKaoahMBAAAASgAAAIzKAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4M0rtgY=
DKaoah8BAAAAwAQAAEzPAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5CaaoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkMpqhqwrhQ+w==
'/*!*/;
# at 118604
#260915  8:57:32 server id 1  end_log_pos 118635 CRC32 0x1b6057b5 	Xid = 1682
COMMIT/*!*/;
# at 118635
#260915  8:57:35 server id 1  end_log_pos 118714 CRC32 0x97a99a39 	Anonymous_GTID	last_committed=87	sequence_number=88	rbr_only=yes	original_committed_timestamp=1789437455628328	immediate_commit_timestamp=1789437455628328	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437455628328 (2026-09-15 08:57:35.628328 SE Asia Standard Time)
# immediate_commit_timestamp=1789437455628328 (2026-09-15 08:57:35.628328 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437455628328*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 118714
#260915  8:57:35 server id 1  end_log_pos 118804 CRC32 0xaf9982be 	Query	thread_id=101	exec_time=0	error_code=0
SET TIMESTAMP=1789437455/*!*/;
BEGIN
/*!*/;
# at 118804
#260915  8:57:35 server id 1  end_log_pos 118878 CRC32 0x2744e910 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 118878
#260915  8:57:35 server id 1  end_log_pos 120094 CRC32 0xa2121578 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
D6aoahMBAAAASgAAAF7QAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BDpRCc=
D6aoah8BAAAAwAQAAB7VAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5DKaoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkPpqhqeBUSog==
'/*!*/;
# at 120094
#260915  8:57:35 server id 1  end_log_pos 120125 CRC32 0xaf4d7269 	Xid = 1706
COMMIT/*!*/;
# at 120125
#260915  8:57:38 server id 1  end_log_pos 120204 CRC32 0x3b50c716 	Anonymous_GTID	last_committed=88	sequence_number=89	rbr_only=yes	original_committed_timestamp=1789437458484877	immediate_commit_timestamp=1789437458484877	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437458484877 (2026-09-15 08:57:38.484877 SE Asia Standard Time)
# immediate_commit_timestamp=1789437458484877 (2026-09-15 08:57:38.484877 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437458484877*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 120204
#260915  8:57:38 server id 1  end_log_pos 120294 CRC32 0xdacb1be2 	Query	thread_id=102	exec_time=0	error_code=0
SET TIMESTAMP=1789437458/*!*/;
BEGIN
/*!*/;
# at 120294
#260915  8:57:38 server id 1  end_log_pos 120368 CRC32 0x1432bab7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 120368
#260915  8:57:38 server id 1  end_log_pos 121560 CRC32 0x2e401d09 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
EqaoahMBAAAASgAAADDWAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Le6MhQ=
Eqaoah8BAAAAqAQAANjaAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5D6aoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoAB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkSpqhqCR1ALg==
'/*!*/;
# at 121560
#260915  8:57:38 server id 1  end_log_pos 121591 CRC32 0x08f5d301 	Xid = 1730
COMMIT/*!*/;
# at 121591
#260915  8:57:40 server id 1  end_log_pos 121670 CRC32 0x4a9ae32e 	Anonymous_GTID	last_committed=89	sequence_number=90	rbr_only=yes	original_committed_timestamp=1789437460983535	immediate_commit_timestamp=1789437460983535	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437460983535 (2026-09-15 08:57:40.983535 SE Asia Standard Time)
# immediate_commit_timestamp=1789437460983535 (2026-09-15 08:57:40.983535 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437460983535*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 121670
#260915  8:57:40 server id 1  end_log_pos 121760 CRC32 0xeabc22db 	Query	thread_id=103	exec_time=0	error_code=0
SET TIMESTAMP=1789437460/*!*/;
BEGIN
/*!*/;
# at 121760
#260915  8:57:40 server id 1  end_log_pos 121834 CRC32 0x45d274d8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 121834
#260915  8:57:40 server id 1  end_log_pos 123002 CRC32 0x2208ef72 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
FKaoahMBAAAASgAAAOrbAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Nh00kU=
FKaoah8BAAAAkAQAAHrgAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5EqaoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDkUpqhqcu8IIg==
'/*!*/;
# at 123002
#260915  8:57:40 server id 1  end_log_pos 123033 CRC32 0x6192f5f8 	Xid = 1754
COMMIT/*!*/;
# at 123033
#260915  8:57:41 server id 1  end_log_pos 123112 CRC32 0x4facec46 	Anonymous_GTID	last_committed=90	sequence_number=91	rbr_only=yes	original_committed_timestamp=1789437461667932	immediate_commit_timestamp=1789437461667932	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437461667932 (2026-09-15 08:57:41.667932 SE Asia Standard Time)
# immediate_commit_timestamp=1789437461667932 (2026-09-15 08:57:41.667932 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437461667932*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 123112
#260915  8:57:41 server id 1  end_log_pos 123202 CRC32 0x6927b7c0 	Query	thread_id=104	exec_time=0	error_code=0
SET TIMESTAMP=1789437461/*!*/;
BEGIN
/*!*/;
# at 123202
#260915  8:57:41 server id 1  end_log_pos 123276 CRC32 0xa11193e9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 123276
#260915  8:57:41 server id 1  end_log_pos 124444 CRC32 0x10672cb0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
FaaoahMBAAAASgAAAIzhAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OmTEaE=
Faaoah8BAAAAkAQAABzmAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5FKaoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDkVpqhqsCxnEA==
'/*!*/;
# at 124444
#260915  8:57:41 server id 1  end_log_pos 124475 CRC32 0xcdaf3fea 	Xid = 1775
COMMIT/*!*/;
# at 124475
#260915  8:57:43 server id 1  end_log_pos 124554 CRC32 0x49ca7538 	Anonymous_GTID	last_committed=91	sequence_number=92	rbr_only=yes	original_committed_timestamp=1789437463885505	immediate_commit_timestamp=1789437463885505	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437463885505 (2026-09-15 08:57:43.885505 SE Asia Standard Time)
# immediate_commit_timestamp=1789437463885505 (2026-09-15 08:57:43.885505 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437463885505*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 124554
#260915  8:57:43 server id 1  end_log_pos 124644 CRC32 0x04eb051c 	Query	thread_id=105	exec_time=0	error_code=0
SET TIMESTAMP=1789437463/*!*/;
BEGIN
/*!*/;
# at 124644
#260915  8:57:43 server id 1  end_log_pos 124718 CRC32 0x2f3c65cc 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 124718
#260915  8:57:43 server id 1  end_log_pos 125910 CRC32 0x06ad2a49 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
F6aoahMBAAAASgAAAC7nAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MxlPC8=
F6aoah8BAAAAqAQAANbrAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5FaaoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloYm01dmRX
NWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcx
bGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkXpqhqSSqtBg==
'/*!*/;
# at 125910
#260915  8:57:43 server id 1  end_log_pos 125941 CRC32 0x26071606 	Xid = 1796
COMMIT/*!*/;
# at 125941
#260915  8:57:46 server id 1  end_log_pos 126020 CRC32 0xbc0362fe 	Anonymous_GTID	last_committed=92	sequence_number=93	rbr_only=yes	original_committed_timestamp=1789437466297775	immediate_commit_timestamp=1789437466297775	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437466297775 (2026-09-15 08:57:46.297775 SE Asia Standard Time)
# immediate_commit_timestamp=1789437466297775 (2026-09-15 08:57:46.297775 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437466297775*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 126020
#260915  8:57:46 server id 1  end_log_pos 126110 CRC32 0x64caf85b 	Query	thread_id=106	exec_time=0	error_code=0
SET TIMESTAMP=1789437466/*!*/;
BEGIN
/*!*/;
# at 126110
#260915  8:57:46 server id 1  end_log_pos 126184 CRC32 0x888bb8c6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 126184
#260915  8:57:46 server id 1  end_log_pos 127400 CRC32 0x61d142ab 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
GqaoahMBAAAASgAAAOjsAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ma4i4g=
Gqaoah8BAAAAwAQAAKjxAQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5F6aoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkapqhqq0LRYQ==
'/*!*/;
# at 127400
#260915  8:57:46 server id 1  end_log_pos 127431 CRC32 0xc816d497 	Xid = 1817
COMMIT/*!*/;
# at 127431
#260915  8:57:47 server id 1  end_log_pos 127510 CRC32 0xd8883a51 	Anonymous_GTID	last_committed=93	sequence_number=94	rbr_only=yes	original_committed_timestamp=1789437467018546	immediate_commit_timestamp=1789437467018546	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789437467018546 (2026-09-15 08:57:47.018546 SE Asia Standard Time)
# immediate_commit_timestamp=1789437467018546 (2026-09-15 08:57:47.018546 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789437467018546*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 127510
#260915  8:57:47 server id 1  end_log_pos 127600 CRC32 0xbb92f5d4 	Query	thread_id=107	exec_time=0	error_code=0
SET TIMESTAMP=1789437467/*!*/;
BEGIN
/*!*/;
# at 127600
#260915  8:57:47 server id 1  end_log_pos 127674 CRC32 0x8e934f5a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 127674
#260915  8:57:47 server id 1  end_log_pos 128890 CRC32 0x557b22be 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
G6aoahMBAAAASgAAALryAQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FpPk44=
G6aoah8BAAAAwAQAAHr3AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5GqaoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkbpqhqviJ7VQ==
'/*!*/;
# at 128890
#260915  8:57:47 server id 1  end_log_pos 128921 CRC32 0xc07cf7f5 	Xid = 1841
COMMIT/*!*/;
# at 128921
#260915  9:18:46 server id 1  end_log_pos 129000 CRC32 0xaafecfe6 	Anonymous_GTID	last_committed=94	sequence_number=95	rbr_only=yes	original_committed_timestamp=1789438726955596	immediate_commit_timestamp=1789438726955596	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438726955596 (2026-09-15 09:18:46.955596 SE Asia Standard Time)
# immediate_commit_timestamp=1789438726955596 (2026-09-15 09:18:46.955596 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438726955596*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 129000
#260915  9:18:46 server id 1  end_log_pos 129090 CRC32 0x1f84f980 	Query	thread_id=108	exec_time=0	error_code=0
SET TIMESTAMP=1789438726/*!*/;
BEGIN
/*!*/;
# at 129090
#260915  9:18:46 server id 1  end_log_pos 129164 CRC32 0x06fe85d6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 129164
#260915  9:18:46 server id 1  end_log_pos 130380 CRC32 0xefc9e92c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BquoahMBAAAASgAAAIz4AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NaF/gY=
Bquoah8BAAAAwAQAAEz9AQAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5G6aoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkGq6hqLOnJ7w==
'/*!*/;
# at 130380
#260915  9:18:46 server id 1  end_log_pos 130411 CRC32 0x067f93d2 	Xid = 1865
COMMIT/*!*/;
# at 130411
#260915  9:18:54 server id 1  end_log_pos 130490 CRC32 0xedfbcce6 	Anonymous_GTID	last_committed=95	sequence_number=96	rbr_only=yes	original_committed_timestamp=1789438734506033	immediate_commit_timestamp=1789438734506033	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438734506033 (2026-09-15 09:18:54.506033 SE Asia Standard Time)
# immediate_commit_timestamp=1789438734506033 (2026-09-15 09:18:54.506033 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438734506033*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 130490
#260915  9:18:54 server id 1  end_log_pos 130580 CRC32 0xc41f9c5f 	Query	thread_id=109	exec_time=0	error_code=0
SET TIMESTAMP=1789438734/*!*/;
BEGIN
/*!*/;
# at 130580
#260915  9:18:54 server id 1  end_log_pos 130654 CRC32 0xf2d82cf8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 130654
#260915  9:18:54 server id 1  end_log_pos 131870 CRC32 0x94f7676d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
DquoahMBAAAASgAAAF7+AQAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Pgs2PI=
Dquoah8BAAAAwAQAAB4DAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5BquoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkOq6hqbWf3lA==
'/*!*/;
# at 131870
#260915  9:18:54 server id 1  end_log_pos 131901 CRC32 0xeea13527 	Xid = 1892
COMMIT/*!*/;
# at 131901
#260915  9:22:06 server id 1  end_log_pos 131980 CRC32 0xc478c5b5 	Anonymous_GTID	last_committed=96	sequence_number=97	rbr_only=yes	original_committed_timestamp=1789438926908857	immediate_commit_timestamp=1789438926908857	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438926908857 (2026-09-15 09:22:06.908857 SE Asia Standard Time)
# immediate_commit_timestamp=1789438926908857 (2026-09-15 09:22:06.908857 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438926908857*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 131980
#260915  9:22:06 server id 1  end_log_pos 132070 CRC32 0xc68e736b 	Query	thread_id=110	exec_time=0	error_code=0
SET TIMESTAMP=1789438926/*!*/;
BEGIN
/*!*/;
# at 132070
#260915  9:22:06 server id 1  end_log_pos 132144 CRC32 0xaa6d61df 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 132144
#260915  9:22:06 server id 1  end_log_pos 133360 CRC32 0x2ff57d47 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
zquoahMBAAAASgAAADAEAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N9hbao=
zquoah8BAAAAwAQAAPAIAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5DquoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDnOq6hqR331Lw==
'/*!*/;
# at 133360
#260915  9:22:06 server id 1  end_log_pos 133391 CRC32 0x456d0c9c 	Xid = 1913
COMMIT/*!*/;
# at 133391
#260915  9:22:44 server id 1  end_log_pos 133470 CRC32 0x62eb9e5b 	Anonymous_GTID	last_committed=97	sequence_number=98	rbr_only=yes	original_committed_timestamp=1789438964789933	immediate_commit_timestamp=1789438964789933	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438964789933 (2026-09-15 09:22:44.789933 SE Asia Standard Time)
# immediate_commit_timestamp=1789438964789933 (2026-09-15 09:22:44.789933 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438964789933*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 133470
#260915  9:22:44 server id 1  end_log_pos 133560 CRC32 0xa2085055 	Query	thread_id=111	exec_time=0	error_code=0
SET TIMESTAMP=1789438964/*!*/;
BEGIN
/*!*/;
# at 133560
#260915  9:22:44 server id 1  end_log_pos 133634 CRC32 0xbdc853cb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 133634
#260915  9:22:44 server id 1  end_log_pos 134850 CRC32 0x1757f114 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
9KuoahMBAAAASgAAAAIKAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MtTyL0=
9Kuoah8BAAAAwAQAAMIOAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5zquoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn0q6hqFPFXFw==
'/*!*/;
# at 134850
#260915  9:22:44 server id 1  end_log_pos 134881 CRC32 0xf4823f2b 	Xid = 1934
COMMIT/*!*/;
# at 134881
#260915  9:22:46 server id 1  end_log_pos 134960 CRC32 0x1bec7f9f 	Anonymous_GTID	last_committed=98	sequence_number=99	rbr_only=yes	original_committed_timestamp=1789438966189436	immediate_commit_timestamp=1789438966189436	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438966189436 (2026-09-15 09:22:46.189436 SE Asia Standard Time)
# immediate_commit_timestamp=1789438966189436 (2026-09-15 09:22:46.189436 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438966189436*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 134960
#260915  9:22:46 server id 1  end_log_pos 135050 CRC32 0xb2499a1d 	Query	thread_id=112	exec_time=0	error_code=0
SET TIMESTAMP=1789438966/*!*/;
BEGIN
/*!*/;
# at 135050
#260915  9:22:46 server id 1  end_log_pos 135124 CRC32 0x19943e41 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 135124
#260915  9:22:46 server id 1  end_log_pos 136340 CRC32 0x4c9a1817 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
9quoahMBAAAASgAAANQPAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EE+lBk=
9quoah8BAAAAwAQAAJQUAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ59KuoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn2q6hqFxiaTA==
'/*!*/;
# at 136340
#260915  9:22:46 server id 1  end_log_pos 136371 CRC32 0x03d4b1e2 	Xid = 1955
COMMIT/*!*/;
# at 136371
#260915  9:22:48 server id 1  end_log_pos 136450 CRC32 0xb3f50283 	Anonymous_GTID	last_committed=99	sequence_number=100	rbr_only=yes	original_committed_timestamp=1789438968707899	immediate_commit_timestamp=1789438968707899	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438968707899 (2026-09-15 09:22:48.707899 SE Asia Standard Time)
# immediate_commit_timestamp=1789438968707899 (2026-09-15 09:22:48.707899 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438968707899*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 136450
#260915  9:22:48 server id 1  end_log_pos 136540 CRC32 0x922522cc 	Query	thread_id=113	exec_time=0	error_code=0
SET TIMESTAMP=1789438968/*!*/;
BEGIN
/*!*/;
# at 136540
#260915  9:22:48 server id 1  end_log_pos 136614 CRC32 0x3981a048 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 136614
#260915  9:22:48 server id 1  end_log_pos 137830 CRC32 0x02dea1e6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+KuoahMBAAAASgAAAKYVAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EiggTk=
+Kuoah8BAAAAwAQAAGYaAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ59quoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn4q6hq5qHeAg==
'/*!*/;
# at 137830
#260915  9:22:48 server id 1  end_log_pos 137861 CRC32 0xf52c1460 	Xid = 1976
COMMIT/*!*/;
# at 137861
#260915  9:22:49 server id 1  end_log_pos 137940 CRC32 0x87e89f10 	Anonymous_GTID	last_committed=100	sequence_number=101	rbr_only=yes	original_committed_timestamp=1789438969376981	immediate_commit_timestamp=1789438969376981	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438969376981 (2026-09-15 09:22:49.376981 SE Asia Standard Time)
# immediate_commit_timestamp=1789438969376981 (2026-09-15 09:22:49.376981 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438969376981*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 137940
#260915  9:22:49 server id 1  end_log_pos 138030 CRC32 0xfdd827d1 	Query	thread_id=114	exec_time=0	error_code=0
SET TIMESTAMP=1789438969/*!*/;
BEGIN
/*!*/;
# at 138030
#260915  9:22:49 server id 1  end_log_pos 138104 CRC32 0x7936bc9e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 138104
#260915  9:22:49 server id 1  end_log_pos 139320 CRC32 0x0aed103e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+auoahMBAAAASgAAAHgbAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4J68Nnk=
+auoah8BAAAAwAQAADggAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5+KuoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn5q6hqPhDtCg==
'/*!*/;
# at 139320
#260915  9:22:49 server id 1  end_log_pos 139351 CRC32 0x0720fb0e 	Xid = 1997
COMMIT/*!*/;
# at 139351
#260915  9:22:51 server id 1  end_log_pos 139430 CRC32 0xa6965021 	Anonymous_GTID	last_committed=101	sequence_number=102	rbr_only=yes	original_committed_timestamp=1789438971836740	immediate_commit_timestamp=1789438971836740	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438971836740 (2026-09-15 09:22:51.836740 SE Asia Standard Time)
# immediate_commit_timestamp=1789438971836740 (2026-09-15 09:22:51.836740 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438971836740*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 139430
#260915  9:22:51 server id 1  end_log_pos 139520 CRC32 0xe45378c0 	Query	thread_id=115	exec_time=0	error_code=0
SET TIMESTAMP=1789438971/*!*/;
BEGIN
/*!*/;
# at 139520
#260915  9:22:51 server id 1  end_log_pos 139594 CRC32 0xd929fcc6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 139594
#260915  9:22:51 server id 1  end_log_pos 140810 CRC32 0xabd12f52 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+6uoahMBAAAASgAAAEohAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Mb8Kdk=
+6uoah8BAAAAwAQAAAomAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5+auoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn7q6hqUi/Rqw==
'/*!*/;
# at 140810
#260915  9:22:51 server id 1  end_log_pos 140841 CRC32 0xeabf98a6 	Xid = 2024
COMMIT/*!*/;
# at 140841
#260915  9:22:54 server id 1  end_log_pos 140920 CRC32 0xc0dfed76 	Anonymous_GTID	last_committed=102	sequence_number=103	rbr_only=yes	original_committed_timestamp=1789438974345057	immediate_commit_timestamp=1789438974345057	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789438974345057 (2026-09-15 09:22:54.345057 SE Asia Standard Time)
# immediate_commit_timestamp=1789438974345057 (2026-09-15 09:22:54.345057 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789438974345057*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 140920
#260915  9:22:54 server id 1  end_log_pos 141010 CRC32 0xa503b97e 	Query	thread_id=116	exec_time=0	error_code=0
SET TIMESTAMP=1789438974/*!*/;
BEGIN
/*!*/;
# at 141010
#260915  9:22:54 server id 1  end_log_pos 141084 CRC32 0xedfb00ae 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 141084
#260915  9:22:54 server id 1  end_log_pos 142300 CRC32 0x535e42a0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/quoahMBAAAASgAAABwnAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K4A++0=
/quoah8BAAAAwAQAANwrAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5+6uoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDn+q6hqoEJeUw==
'/*!*/;
# at 142300
#260915  9:22:54 server id 1  end_log_pos 142331 CRC32 0xd3135741 	Xid = 2045
COMMIT/*!*/;
# at 142331
#260915  9:31:41 server id 1  end_log_pos 142410 CRC32 0x9b16fb7c 	Anonymous_GTID	last_committed=103	sequence_number=104	rbr_only=yes	original_committed_timestamp=1789439501654862	immediate_commit_timestamp=1789439501654862	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439501654862 (2026-09-15 09:31:41.654862 SE Asia Standard Time)
# immediate_commit_timestamp=1789439501654862 (2026-09-15 09:31:41.654862 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439501654862*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 142410
#260915  9:31:41 server id 1  end_log_pos 142500 CRC32 0xc7abcb8f 	Query	thread_id=117	exec_time=0	error_code=0
SET TIMESTAMP=1789439501/*!*/;
BEGIN
/*!*/;
# at 142500
#260915  9:31:41 server id 1  end_log_pos 142574 CRC32 0x79197360 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 142574
#260915  9:31:41 server id 1  end_log_pos 143790 CRC32 0xf6c61eb2 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Da6oahMBAAAASgAAAO4sAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GBzGXk=
Da6oah8BAAAAwAQAAK4xAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5/quoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkNrqhqsh7G9g==
'/*!*/;
# at 143790
#260915  9:31:41 server id 1  end_log_pos 143821 CRC32 0x02f2c490 	Xid = 2066
COMMIT/*!*/;
# at 143821
#260915  9:31:44 server id 1  end_log_pos 143900 CRC32 0x6be452d9 	Anonymous_GTID	last_committed=104	sequence_number=105	rbr_only=yes	original_committed_timestamp=1789439504473654	immediate_commit_timestamp=1789439504473654	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439504473654 (2026-09-15 09:31:44.473654 SE Asia Standard Time)
# immediate_commit_timestamp=1789439504473654 (2026-09-15 09:31:44.473654 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439504473654*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 143900
#260915  9:31:44 server id 1  end_log_pos 143990 CRC32 0xf3fad8d5 	Query	thread_id=118	exec_time=0	error_code=0
SET TIMESTAMP=1789439504/*!*/;
BEGIN
/*!*/;
# at 143990
#260915  9:31:44 server id 1  end_log_pos 144064 CRC32 0x38e6030b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 144064
#260915  9:31:44 server id 1  end_log_pos 145280 CRC32 0x4f242d4f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
EK6oahMBAAAASgAAAMAyAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AsD5jg=
EK6oah8BAAAAwAQAAIA3AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5Da6oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkQrqhqTy0kTw==
'/*!*/;
# at 145280
#260915  9:31:44 server id 1  end_log_pos 145311 CRC32 0x3a6444bf 	Xid = 2087
COMMIT/*!*/;
# at 145311
#260915  9:31:47 server id 1  end_log_pos 145390 CRC32 0xe859b95c 	Anonymous_GTID	last_committed=105	sequence_number=106	rbr_only=yes	original_committed_timestamp=1789439507191360	immediate_commit_timestamp=1789439507191360	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439507191360 (2026-09-15 09:31:47.191360 SE Asia Standard Time)
# immediate_commit_timestamp=1789439507191360 (2026-09-15 09:31:47.191360 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439507191360*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 145390
#260915  9:31:47 server id 1  end_log_pos 145480 CRC32 0xf7a56414 	Query	thread_id=119	exec_time=0	error_code=0
SET TIMESTAMP=1789439507/*!*/;
BEGIN
/*!*/;
# at 145480
#260915  9:31:47 server id 1  end_log_pos 145554 CRC32 0xf846f02c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 145554
#260915  9:31:47 server id 1  end_log_pos 146746 CRC32 0x17ee08cc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
E66oahMBAAAASgAAAJI4AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CzwRvg=
E66oah8BAAAAqAQAADo9AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5EK6oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoAB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkTrqhqzAjuFw==
'/*!*/;
# at 146746
#260915  9:31:47 server id 1  end_log_pos 146777 CRC32 0x26f97661 	Xid = 2111
COMMIT/*!*/;
# at 146777
#260915  9:31:50 server id 1  end_log_pos 146856 CRC32 0xf77c8beb 	Anonymous_GTID	last_committed=106	sequence_number=107	rbr_only=yes	original_committed_timestamp=1789439510102039	immediate_commit_timestamp=1789439510102039	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439510102039 (2026-09-15 09:31:50.102039 SE Asia Standard Time)
# immediate_commit_timestamp=1789439510102039 (2026-09-15 09:31:50.102039 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439510102039*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 146856
#260915  9:31:50 server id 1  end_log_pos 146946 CRC32 0x5148656f 	Query	thread_id=120	exec_time=0	error_code=0
SET TIMESTAMP=1789439510/*!*/;
BEGIN
/*!*/;
# at 146946
#260915  9:31:50 server id 1  end_log_pos 147020 CRC32 0xeab095af 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 147020
#260915  9:31:50 server id 1  end_log_pos 148196 CRC32 0x2e9a04cc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Fq6oahMBAAAASgAAAEw+AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K+VsOo=
Fq6oah8BAAAAmAQAAORCAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5E66oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1lt
OWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PRauqGrMBJou
'/*!*/;
# at 148196
#260915  9:31:50 server id 1  end_log_pos 148227 CRC32 0x101c863d 	Xid = 2144
COMMIT/*!*/;
# at 148227
#260915  9:31:53 server id 1  end_log_pos 148306 CRC32 0xa5367e7e 	Anonymous_GTID	last_committed=107	sequence_number=108	rbr_only=yes	original_committed_timestamp=1789439513393091	immediate_commit_timestamp=1789439513393091	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439513393091 (2026-09-15 09:31:53.393091 SE Asia Standard Time)
# immediate_commit_timestamp=1789439513393091 (2026-09-15 09:31:53.393091 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439513393091*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 148306
#260915  9:31:53 server id 1  end_log_pos 148396 CRC32 0x46ea25b7 	Query	thread_id=121	exec_time=0	error_code=0
SET TIMESTAMP=1789439513/*!*/;
BEGIN
/*!*/;
# at 148396
#260915  9:31:53 server id 1  end_log_pos 148470 CRC32 0x75cdcde0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 148470
#260915  9:31:53 server id 1  end_log_pos 149646 CRC32 0x640c9703 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Ga6oahMBAAAASgAAAPZDAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ODNzXU=
Ga6oah8BAAAAmAQAAI5IAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0WrqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0ORmuqGoDlwxk
'/*!*/;
# at 149646
#260915  9:31:53 server id 1  end_log_pos 149677 CRC32 0xcd5041b6 	Xid = 2168
COMMIT/*!*/;
# at 149677
#260915  9:31:56 server id 1  end_log_pos 149756 CRC32 0x68993699 	Anonymous_GTID	last_committed=108	sequence_number=109	rbr_only=yes	original_committed_timestamp=1789439516078879	immediate_commit_timestamp=1789439516078879	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439516078879 (2026-09-15 09:31:56.078879 SE Asia Standard Time)
# immediate_commit_timestamp=1789439516078879 (2026-09-15 09:31:56.078879 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439516078879*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 149756
#260915  9:31:56 server id 1  end_log_pos 149846 CRC32 0x7f49f7ec 	Query	thread_id=122	exec_time=0	error_code=0
SET TIMESTAMP=1789439516/*!*/;
BEGIN
/*!*/;
# at 149846
#260915  9:31:56 server id 1  end_log_pos 149920 CRC32 0xdbe3e06c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 149920
#260915  9:31:56 server id 1  end_log_pos 151112 CRC32 0x4708f03d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
HK6oahMBAAAASgAAAKBJAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Gzg49s=
HK6oah8BAAAAqAQAAEhOAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5Ga6oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloYm01dmRX
NWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcx
bGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkcrqhqPfAIRw==
'/*!*/;
# at 151112
#260915  9:31:56 server id 1  end_log_pos 151143 CRC32 0xc50e36c9 	Xid = 2189
COMMIT/*!*/;
# at 151143
#260915  9:31:57 server id 1  end_log_pos 151222 CRC32 0x5c8ed4a3 	Anonymous_GTID	last_committed=109	sequence_number=110	rbr_only=yes	original_committed_timestamp=1789439517952991	immediate_commit_timestamp=1789439517952991	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439517952991 (2026-09-15 09:31:57.952991 SE Asia Standard Time)
# immediate_commit_timestamp=1789439517952991 (2026-09-15 09:31:57.952991 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439517952991*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 151222
#260915  9:31:57 server id 1  end_log_pos 151312 CRC32 0x4cddd226 	Query	thread_id=123	exec_time=0	error_code=0
SET TIMESTAMP=1789439517/*!*/;
BEGIN
/*!*/;
# at 151312
#260915  9:31:57 server id 1  end_log_pos 151386 CRC32 0xb6ef6b90 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 151386
#260915  9:31:57 server id 1  end_log_pos 152602 CRC32 0x314ecc98 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Ha6oahMBAAAASgAAAFpPAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JBr77Y=
Ha6oah8BAAAAwAQAABpUAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5HK6oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkdrqhqmMxOMQ==
'/*!*/;
# at 152602
#260915  9:31:57 server id 1  end_log_pos 152633 CRC32 0xe91c0393 	Xid = 2210
COMMIT/*!*/;
# at 152633
#260915  9:32:00 server id 1  end_log_pos 152712 CRC32 0x94873453 	Anonymous_GTID	last_committed=110	sequence_number=111	rbr_only=yes	original_committed_timestamp=1789439520217723	immediate_commit_timestamp=1789439520217723	transaction_length=1470
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439520217723 (2026-09-15 09:32:00.217723 SE Asia Standard Time)
# immediate_commit_timestamp=1789439520217723 (2026-09-15 09:32:00.217723 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439520217723*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 152712
#260915  9:32:00 server id 1  end_log_pos 152802 CRC32 0x99cabfd2 	Query	thread_id=124	exec_time=0	error_code=0
SET TIMESTAMP=1789439520/*!*/;
BEGIN
/*!*/;
# at 152802
#260915  9:32:00 server id 1  end_log_pos 152876 CRC32 0x7ed74d6c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 152876
#260915  9:32:00 server id 1  end_log_pos 154072 CRC32 0x4b24b8f5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
IK6oahMBAAAASgAAACxVAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GxN134=
IK6oah8BAAAArAQAANhZAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5Ha6oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoQB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTkxYzJWeWN5STdjem8xT2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0
dWRYTmxjbk11YVc1a1pYZ2lPMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekpp
TW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9IK6oavW4JEs=
'/*!*/;
# at 154072
#260915  9:32:00 server id 1  end_log_pos 154103 CRC32 0x2d285688 	Xid = 2237
COMMIT/*!*/;
# at 154103
#260915  9:32:02 server id 1  end_log_pos 154182 CRC32 0xed825546 	Anonymous_GTID	last_committed=111	sequence_number=112	rbr_only=yes	original_committed_timestamp=1789439522505535	immediate_commit_timestamp=1789439522505535	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439522505535 (2026-09-15 09:32:02.505535 SE Asia Standard Time)
# immediate_commit_timestamp=1789439522505535 (2026-09-15 09:32:02.505535 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439522505535*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 154182
#260915  9:32:02 server id 1  end_log_pos 154272 CRC32 0xc72d393a 	Query	thread_id=125	exec_time=0	error_code=0
SET TIMESTAMP=1789439522/*!*/;
BEGIN
/*!*/;
# at 154272
#260915  9:32:02 server id 1  end_log_pos 154346 CRC32 0x5cd5b9f1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 154346
#260915  9:32:02 server id 1  end_log_pos 155526 CRC32 0x3bf0fe80 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Iq6oahMBAAAASgAAAOpaAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PG51Vw=
Iq6oah8BAAAAnAQAAIZfAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPSCuqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0irqhqgP7wOw==
'/*!*/;
# at 155526
#260915  9:32:02 server id 1  end_log_pos 155557 CRC32 0x9f7b02f0 	Xid = 2258
COMMIT/*!*/;
# at 155557
#260915  9:32:05 server id 1  end_log_pos 155636 CRC32 0xba396598 	Anonymous_GTID	last_committed=112	sequence_number=113	rbr_only=yes	original_committed_timestamp=1789439525139300	immediate_commit_timestamp=1789439525139300	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439525139300 (2026-09-15 09:32:05.139300 SE Asia Standard Time)
# immediate_commit_timestamp=1789439525139300 (2026-09-15 09:32:05.139300 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439525139300*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 155636
#260915  9:32:05 server id 1  end_log_pos 155726 CRC32 0xfe2424f4 	Query	thread_id=126	exec_time=0	error_code=0
SET TIMESTAMP=1789439525/*!*/;
BEGIN
/*!*/;
# at 155726
#260915  9:32:05 server id 1  end_log_pos 155800 CRC32 0x8744a06a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 155800
#260915  9:32:05 server id 1  end_log_pos 156984 CRC32 0x3d6d8b26 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Ja6oahMBAAAASgAAAJhgAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GqgRIc=
Ja6oah8BAAAAoAQAADhlAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0irqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OW5ZV3hsY21raU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1TG1kaGJHVnlhUzVwYm1S
bGVDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09Ja6oaiaLbT0=
'/*!*/;
# at 156984
#260915  9:32:05 server id 1  end_log_pos 157015 CRC32 0x35d70a6c 	Xid = 2279
COMMIT/*!*/;
# at 157015
#260915  9:32:21 server id 1  end_log_pos 157094 CRC32 0x084dec88 	Anonymous_GTID	last_committed=113	sequence_number=114	rbr_only=yes	original_committed_timestamp=1789439541879671	immediate_commit_timestamp=1789439541879671	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439541879671 (2026-09-15 09:32:21.879671 SE Asia Standard Time)
# immediate_commit_timestamp=1789439541879671 (2026-09-15 09:32:21.879671 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439541879671*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 157094
#260915  9:32:21 server id 1  end_log_pos 157184 CRC32 0x99adc78c 	Query	thread_id=127	exec_time=0	error_code=0
SET TIMESTAMP=1789439541/*!*/;
BEGIN
/*!*/;
# at 157184
#260915  9:32:21 server id 1  end_log_pos 157258 CRC32 0x43f455a8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 157258
#260915  9:32:21 server id 1  end_log_pos 158442 CRC32 0xb67e4b6d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Na6oahMBAAAASgAAAEpmAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KhV9EM=
Na6oah8BAAAAoAQAAOpqAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0lrqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OW5ZV3hsY21raU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1TG1kaGJHVnlhUzVwYm1S
bGVDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09Na6oam1LfrY=
'/*!*/;
# at 158442
#260915  9:32:21 server id 1  end_log_pos 158473 CRC32 0x14e4108d 	Xid = 2297
COMMIT/*!*/;
# at 158473
#260915  9:32:22 server id 1  end_log_pos 158552 CRC32 0x9a1be7b7 	Anonymous_GTID	last_committed=114	sequence_number=115	rbr_only=yes	original_committed_timestamp=1789439542669338	immediate_commit_timestamp=1789439542669338	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439542669338 (2026-09-15 09:32:22.669338 SE Asia Standard Time)
# immediate_commit_timestamp=1789439542669338 (2026-09-15 09:32:22.669338 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439542669338*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 158552
#260915  9:32:22 server id 1  end_log_pos 158642 CRC32 0xf459c07d 	Query	thread_id=128	exec_time=0	error_code=0
SET TIMESTAMP=1789439542/*!*/;
BEGIN
/*!*/;
# at 158642
#260915  9:32:22 server id 1  end_log_pos 158716 CRC32 0x6ddf58b6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 158716
#260915  9:32:22 server id 1  end_log_pos 159896 CRC32 0x25eb2746 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Nq6oahMBAAAASgAAAPxrAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LZY320=
Nq6oah8BAAAAnAQAAJhwAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT01rqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OTFjMlZ5Y3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhn
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD02rqhqRifrJQ==
'/*!*/;
# at 159896
#260915  9:32:22 server id 1  end_log_pos 159927 CRC32 0xa922e1e5 	Xid = 2324
COMMIT/*!*/;
# at 159927
#260915  9:32:25 server id 1  end_log_pos 160006 CRC32 0xc5477943 	Anonymous_GTID	last_committed=115	sequence_number=116	rbr_only=yes	original_committed_timestamp=1789439545923765	immediate_commit_timestamp=1789439545923765	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439545923765 (2026-09-15 09:32:25.923765 SE Asia Standard Time)
# immediate_commit_timestamp=1789439545923765 (2026-09-15 09:32:25.923765 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439545923765*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 160006
#260915  9:32:25 server id 1  end_log_pos 160096 CRC32 0x2752367c 	Query	thread_id=129	exec_time=0	error_code=0
SET TIMESTAMP=1789439545/*!*/;
BEGIN
/*!*/;
# at 160096
#260915  9:32:25 server id 1  end_log_pos 160170 CRC32 0xd5bff746 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 160170
#260915  9:32:25 server id 1  end_log_pos 161346 CRC32 0x62d3fc0b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Oa6oahMBAAAASgAAAKpxAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Eb3v9U=
Oa6oah8BAAAAmAQAAEJ2AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTauqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTmuqGoL/NNi
'/*!*/;
# at 161346
#260915  9:32:25 server id 1  end_log_pos 161377 CRC32 0x9d8d8ed6 	Xid = 2351
COMMIT/*!*/;
# at 161377
#260915  9:32:28 server id 1  end_log_pos 161456 CRC32 0xa907ffe8 	Anonymous_GTID	last_committed=116	sequence_number=117	rbr_only=yes	original_committed_timestamp=1789439548700215	immediate_commit_timestamp=1789439548700215	transaction_length=1470
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439548700215 (2026-09-15 09:32:28.700215 SE Asia Standard Time)
# immediate_commit_timestamp=1789439548700215 (2026-09-15 09:32:28.700215 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439548700215*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 161456
#260915  9:32:28 server id 1  end_log_pos 161546 CRC32 0x907b72b0 	Query	thread_id=130	exec_time=0	error_code=0
SET TIMESTAMP=1789439548/*!*/;
BEGIN
/*!*/;
# at 161546
#260915  9:32:28 server id 1  end_log_pos 161620 CRC32 0x64f1d2c7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 161620
#260915  9:32:28 server id 1  end_log_pos 162816 CRC32 0x6e321e2f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
PK6oahMBAAAASgAAAFR3AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MfS8WQ=
PK6oah8BAAAArAQAAAB8AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTmuqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5PK6oai8eMm4=
'/*!*/;
# at 162816
#260915  9:32:28 server id 1  end_log_pos 162847 CRC32 0x046ac2dc 	Xid = 2372
COMMIT/*!*/;
# at 162847
#260915  9:32:30 server id 1  end_log_pos 162926 CRC32 0xc2d57031 	Anonymous_GTID	last_committed=117	sequence_number=118	rbr_only=yes	original_committed_timestamp=1789439550335542	immediate_commit_timestamp=1789439550335542	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439550335542 (2026-09-15 09:32:30.335542 SE Asia Standard Time)
# immediate_commit_timestamp=1789439550335542 (2026-09-15 09:32:30.335542 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439550335542*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 162926
#260915  9:32:30 server id 1  end_log_pos 163016 CRC32 0xe22c4a95 	Query	thread_id=131	exec_time=0	error_code=0
SET TIMESTAMP=1789439550/*!*/;
BEGIN
/*!*/;
# at 163016
#260915  9:32:30 server id 1  end_log_pos 163090 CRC32 0xce40701a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 163090
#260915  9:32:30 server id 1  end_log_pos 164306 CRC32 0x5539ba59 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Pq6oahMBAAAASgAAABJ9AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BpwQM4=
Pq6oah8BAAAAwAQAANKBAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5PK6oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDk+rqhqWbo5VQ==
'/*!*/;
# at 164306
#260915  9:32:30 server id 1  end_log_pos 164337 CRC32 0xa74bdc02 	Xid = 2393
COMMIT/*!*/;
# at 164337
#260915  9:32:31 server id 1  end_log_pos 164416 CRC32 0x193bd6af 	Anonymous_GTID	last_committed=118	sequence_number=119	rbr_only=yes	original_committed_timestamp=1789439551192743	immediate_commit_timestamp=1789439551192743	transaction_length=1470
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439551192743 (2026-09-15 09:32:31.192743 SE Asia Standard Time)
# immediate_commit_timestamp=1789439551192743 (2026-09-15 09:32:31.192743 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439551192743*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 164416
#260915  9:32:31 server id 1  end_log_pos 164506 CRC32 0x8df280a4 	Query	thread_id=132	exec_time=0	error_code=0
SET TIMESTAMP=1789439551/*!*/;
BEGIN
/*!*/;
# at 164506
#260915  9:32:31 server id 1  end_log_pos 164580 CRC32 0xea6dd426 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 164580
#260915  9:32:31 server id 1  end_log_pos 165776 CRC32 0x9e4147c6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
P66oahMBAAAASgAAAOSCAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CbUbeo=
P66oah8BAAAArAQAAJCHAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5Pq6oagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoQB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTkxYzJWeWN5STdjem8xT2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0
dWRYTmxjbk11YVc1a1pYZ2lPMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekpp
TW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9P66oasZHQZ4=
'/*!*/;
# at 165776
#260915  9:32:31 server id 1  end_log_pos 165807 CRC32 0xe7c1f104 	Xid = 2420
COMMIT/*!*/;
# at 165807
#260915  9:32:41 server id 1  end_log_pos 165886 CRC32 0xd9b9b25d 	Anonymous_GTID	last_committed=119	sequence_number=120	rbr_only=yes	original_committed_timestamp=1789439561501554	immediate_commit_timestamp=1789439561501554	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439561501554 (2026-09-15 09:32:41.501554 SE Asia Standard Time)
# immediate_commit_timestamp=1789439561501554 (2026-09-15 09:32:41.501554 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439561501554*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 165886
#260915  9:32:41 server id 1  end_log_pos 165976 CRC32 0x05c0083a 	Query	thread_id=133	exec_time=0	error_code=0
SET TIMESTAMP=1789439561/*!*/;
BEGIN
/*!*/;
# at 165976
#260915  9:32:41 server id 1  end_log_pos 166050 CRC32 0xaa5877d1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 166050
#260915  9:32:41 server id 1  end_log_pos 167226 CRC32 0x00f62cb3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Sa6oahMBAAAASgAAAKKIAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NF3WKo=
Sa6oah8BAAAAmAQAADqNAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPT+uqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPUmuqGqzLPYA
'/*!*/;
# at 167226
#260915  9:32:41 server id 1  end_log_pos 167257 CRC32 0xd4498a85 	Xid = 2441
COMMIT/*!*/;
# at 167257
#260915  9:32:50 server id 1  end_log_pos 167336 CRC32 0xcef63fe0 	Anonymous_GTID	last_committed=120	sequence_number=121	rbr_only=yes	original_committed_timestamp=1789439570521260	immediate_commit_timestamp=1789439570521260	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439570521260 (2026-09-15 09:32:50.521260 SE Asia Standard Time)
# immediate_commit_timestamp=1789439570521260 (2026-09-15 09:32:50.521260 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439570521260*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 167336
#260915  9:32:50 server id 1  end_log_pos 167426 CRC32 0xcc7e7b89 	Query	thread_id=134	exec_time=0	error_code=0
SET TIMESTAMP=1789439570/*!*/;
BEGIN
/*!*/;
# at 167426
#260915  9:32:50 server id 1  end_log_pos 167500 CRC32 0x7679b986 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 167500
#260915  9:32:50 server id 1  end_log_pos 168680 CRC32 0xb9243c05 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Uq6oahMBAAAASgAAAEyOAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ia5eXY=
Uq6oah8BAAAAnAQAAOiSAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPUmuqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1SrqhqBTwkuQ==
'/*!*/;
# at 168680
#260915  9:32:50 server id 1  end_log_pos 168711 CRC32 0x2f24d6dc 	Xid = 2462
COMMIT/*!*/;
# at 168711
#260915  9:33:05 server id 1  end_log_pos 168790 CRC32 0x3b213257 	Anonymous_GTID	last_committed=121	sequence_number=122	rbr_only=yes	original_committed_timestamp=1789439585452087	immediate_commit_timestamp=1789439585452087	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439585452087 (2026-09-15 09:33:05.452087 SE Asia Standard Time)
# immediate_commit_timestamp=1789439585452087 (2026-09-15 09:33:05.452087 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439585452087*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 168790
#260915  9:33:05 server id 1  end_log_pos 168880 CRC32 0x1e895518 	Query	thread_id=135	exec_time=0	error_code=0
SET TIMESTAMP=1789439585/*!*/;
BEGIN
/*!*/;
# at 168880
#260915  9:33:05 server id 1  end_log_pos 168954 CRC32 0x3b5e3671 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 168954
#260915  9:33:05 server id 1  end_log_pos 170138 CRC32 0xb8d5962f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Ya6oahMBAAAASgAAAPqTAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HE2Xjs=
Ya6oah8BAAAAoAQAAJqYAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1SrqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OW5ZV3hsY21raU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1TG1kaGJHVnlhUzVwYm1S
bGVDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09Ya6oai+W1bg=
'/*!*/;
# at 170138
#260915  9:33:05 server id 1  end_log_pos 170169 CRC32 0x18a93012 	Xid = 2483
COMMIT/*!*/;
# at 170169
#260915  9:33:38 server id 1  end_log_pos 170248 CRC32 0x23a3d083 	Anonymous_GTID	last_committed=122	sequence_number=123	rbr_only=yes	original_committed_timestamp=1789439618510066	immediate_commit_timestamp=1789439618510066	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439618510066 (2026-09-15 09:33:38.510066 SE Asia Standard Time)
# immediate_commit_timestamp=1789439618510066 (2026-09-15 09:33:38.510066 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439618510066*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 170248
#260915  9:33:38 server id 1  end_log_pos 170338 CRC32 0xaa48daf6 	Query	thread_id=136	exec_time=0	error_code=0
SET TIMESTAMP=1789439618/*!*/;
BEGIN
/*!*/;
# at 170338
#260915  9:33:38 server id 1  end_log_pos 170412 CRC32 0x318e4148 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 170412
#260915  9:33:38 server id 1  end_log_pos 171592 CRC32 0x9e466a71 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
gq6oahMBAAAASgAAAKyZAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EhBjjE=
gq6oah8BAAAAnAQAAEieAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1hrqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OTFjMlZ5Y3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhn
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2CrqhqcWpGng==
'/*!*/;
# at 171592
#260915  9:33:38 server id 1  end_log_pos 171623 CRC32 0xd3129a66 	Xid = 2510
COMMIT/*!*/;
# at 171623
#260915  9:33:43 server id 1  end_log_pos 171702 CRC32 0xaa60ff2b 	Anonymous_GTID	last_committed=123	sequence_number=124	rbr_only=yes	original_committed_timestamp=1789439623334320	immediate_commit_timestamp=1789439623334320	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439623334320 (2026-09-15 09:33:43.334320 SE Asia Standard Time)
# immediate_commit_timestamp=1789439623334320 (2026-09-15 09:33:43.334320 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439623334320*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 171702
#260915  9:33:43 server id 1  end_log_pos 171792 CRC32 0x73095d16 	Query	thread_id=137	exec_time=0	error_code=0
SET TIMESTAMP=1789439623/*!*/;
BEGIN
/*!*/;
# at 171792
#260915  9:33:43 server id 1  end_log_pos 171866 CRC32 0x4596f7e9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 171866
#260915  9:33:43 server id 1  end_log_pos 173050 CRC32 0x607cc73f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
h66oahMBAAAASgAAAFqfAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4On3lkU=
h66oah8BAAAAoAQAAPqjAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPYKuqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaMAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeTgyTDJWa2FYUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UWTZJbUZrYldsdUxuVnpaWEp6TG1W
a2FYUWlPMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3
WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9h66oaj/HfGA=
'/*!*/;
# at 173050
#260915  9:33:43 server id 1  end_log_pos 173081 CRC32 0x33beece1 	Xid = 2537
COMMIT/*!*/;
# at 173081
#260915  9:33:55 server id 1  end_log_pos 173160 CRC32 0x1e4b184f 	Anonymous_GTID	last_committed=124	sequence_number=125	rbr_only=yes	original_committed_timestamp=1789439635051340	immediate_commit_timestamp=1789439635051340	transaction_length=1462
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439635051340 (2026-09-15 09:33:55.051340 SE Asia Standard Time)
# immediate_commit_timestamp=1789439635051340 (2026-09-15 09:33:55.051340 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439635051340*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 173160
#260915  9:33:55 server id 1  end_log_pos 173250 CRC32 0xb399d62a 	Query	thread_id=138	exec_time=0	error_code=0
SET TIMESTAMP=1789439635/*!*/;
BEGIN
/*!*/;
# at 173250
#260915  9:33:55 server id 1  end_log_pos 173324 CRC32 0x228a3a2a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 173324
#260915  9:33:55 server id 1  end_log_pos 174512 CRC32 0xcdff3c3c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
k66oahMBAAAASgAAAAylAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Co6iiI=
k66oah8BAAAApAQAALCpAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaMAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeTgyTDJWa2FYUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UWTZJbUZrYldsdUxuVnpaWEp6TG1W
a2FYUWlPMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3
WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9h66oagAoAEx3bGszVEJ5RU01d2hu
UndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4w
IChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUws
IGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9q
WTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1Rs
NU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1Fp
TzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZN
anA3Y3pvek9pSjFjbXdpTzNNNk16UTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpH
MXBiaTluWVd4bGNta2lPM002TlRvaWNtOTFkR1VpTzNNNk1UZzZJbUZrYldsdUxtZGhiR1Z5YVM1
cGJtUmxlQ0k3ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUx
T0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PZOuqGo8PP/N
'/*!*/;
# at 174512
#260915  9:33:55 server id 1  end_log_pos 174543 CRC32 0x61631b74 	Xid = 2558
COMMIT/*!*/;
# at 174543
#260915  9:34:09 server id 1  end_log_pos 174622 CRC32 0x8d7a69a9 	Anonymous_GTID	last_committed=125	sequence_number=126	rbr_only=yes	original_committed_timestamp=1789439649592567	immediate_commit_timestamp=1789439649592567	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439649592567 (2026-09-15 09:34:09.592567 SE Asia Standard Time)
# immediate_commit_timestamp=1789439649592567 (2026-09-15 09:34:09.592567 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439649592567*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 174622
#260915  9:34:09 server id 1  end_log_pos 174712 CRC32 0xe10bdf96 	Query	thread_id=139	exec_time=0	error_code=0
SET TIMESTAMP=1789439649/*!*/;
BEGIN
/*!*/;
# at 174712
#260915  9:34:09 server id 1  end_log_pos 174786 CRC32 0xa4f2e44f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 174786
#260915  9:34:09 server id 1  end_log_pos 175962 CRC32 0x0a6c76d9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
oa6oahMBAAAASgAAAMKqAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E/k8qQ=
oa6oah8BAAAAmAQAAFqvAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2TrqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OaGuqGrZdmwK
'/*!*/;
# at 175962
#260915  9:34:09 server id 1  end_log_pos 175993 CRC32 0x4fb9cb7d 	Xid = 2582
COMMIT/*!*/;
# at 175993
#260915  9:34:14 server id 1  end_log_pos 176072 CRC32 0x7805ecdb 	Anonymous_GTID	last_committed=126	sequence_number=127	rbr_only=yes	original_committed_timestamp=1789439654163771	immediate_commit_timestamp=1789439654163771	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439654163771 (2026-09-15 09:34:14.163771 SE Asia Standard Time)
# immediate_commit_timestamp=1789439654163771 (2026-09-15 09:34:14.163771 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439654163771*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 176072
#260915  9:34:14 server id 1  end_log_pos 176162 CRC32 0x2142aaad 	Query	thread_id=140	exec_time=0	error_code=0
SET TIMESTAMP=1789439654/*!*/;
BEGIN
/*!*/;
# at 176162
#260915  9:34:14 server id 1  end_log_pos 176236 CRC32 0xf271fd89 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 176236
#260915  9:34:14 server id 1  end_log_pos 177404 CRC32 0xcaedcbfb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
pq6oahMBAAAASgAAAGywAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4In9cfI=
pq6oah8BAAAAkAQAAPy0AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5oa6oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDmmrqhq+8vtyg==
'/*!*/;
# at 177404
#260915  9:34:14 server id 1  end_log_pos 177435 CRC32 0x28af4e4b 	Xid = 2606
COMMIT/*!*/;
# at 177435
#260915  9:34:20 server id 1  end_log_pos 177514 CRC32 0x8a1a6b3f 	Anonymous_GTID	last_committed=127	sequence_number=128	rbr_only=yes	original_committed_timestamp=1789439660497532	immediate_commit_timestamp=1789439660497532	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439660497532 (2026-09-15 09:34:20.497532 SE Asia Standard Time)
# immediate_commit_timestamp=1789439660497532 (2026-09-15 09:34:20.497532 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439660497532*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 177514
#260915  9:34:20 server id 1  end_log_pos 177604 CRC32 0xeeeceb2b 	Query	thread_id=141	exec_time=0	error_code=0
SET TIMESTAMP=1789439660/*!*/;
BEGIN
/*!*/;
# at 177604
#260915  9:34:20 server id 1  end_log_pos 177678 CRC32 0xa58d4eb9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 177678
#260915  9:34:20 server id 1  end_log_pos 178854 CRC32 0xa18c9465 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
rK6oahMBAAAASgAAAA62AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LlOjaU=
rK6oah8BAAAAmAQAAKa6AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5pq6oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16UTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTluWVd4bGNt
a2lPM002TlRvaWNtOTFkR1VpTzNNNk1UZzZJbUZrYldsdUxtZGhiR1Z5YVM1cGJtUmxlQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PayuqGpllIyh
'/*!*/;
# at 178854
#260915  9:34:20 server id 1  end_log_pos 178885 CRC32 0x3448bfe3 	Xid = 2627
COMMIT/*!*/;
# at 178885
#260915  9:34:24 server id 1  end_log_pos 178964 CRC32 0x792a233b 	Anonymous_GTID	last_committed=128	sequence_number=129	rbr_only=yes	original_committed_timestamp=1789439664857507	immediate_commit_timestamp=1789439664857507	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789439664857507 (2026-09-15 09:34:24.857507 SE Asia Standard Time)
# immediate_commit_timestamp=1789439664857507 (2026-09-15 09:34:24.857507 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789439664857507*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 178964
#260915  9:34:24 server id 1  end_log_pos 179054 CRC32 0xdc73e4bf 	Query	thread_id=142	exec_time=0	error_code=0
SET TIMESTAMP=1789439664/*!*/;
BEGIN
/*!*/;
# at 179054
#260915  9:34:24 server id 1  end_log_pos 179128 CRC32 0xee73b01b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 179128
#260915  9:34:24 server id 1  end_log_pos 180304 CRC32 0xba7b0ea6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
sK6oahMBAAAASgAAALi7AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Buwc+4=
sK6oah8BAAAAmAQAAFDAAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2srqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0ObCuqGqmDnu6
'/*!*/;
# at 180304
#260915  9:34:24 server id 1  end_log_pos 180335 CRC32 0x7a2ad4e4 	Xid = 2651
COMMIT/*!*/;
# at 180335
#260915  9:44:37 server id 1  end_log_pos 180414 CRC32 0xa4a5156d 	Anonymous_GTID	last_committed=129	sequence_number=130	rbr_only=yes	original_committed_timestamp=1789440277501062	immediate_commit_timestamp=1789440277501062	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789440277501062 (2026-09-15 09:44:37.501062 SE Asia Standard Time)
# immediate_commit_timestamp=1789440277501062 (2026-09-15 09:44:37.501062 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789440277501062*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 180414
#260915  9:44:37 server id 1  end_log_pos 180504 CRC32 0x0070cb1f 	Query	thread_id=143	exec_time=0	error_code=0
SET TIMESTAMP=1789440277/*!*/;
BEGIN
/*!*/;
# at 180504
#260915  9:44:37 server id 1  end_log_pos 180578 CRC32 0xf28204b2 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 180578
#260915  9:44:37 server id 1  end_log_pos 181754 CRC32 0xbe3db230 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
FbGoahMBAAAASgAAAGLBAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LIEgvI=
FbGoah8BAAAAmAQAAPrFAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5sK6oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1lt
OWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PRWxqGowsj2+
'/*!*/;
# at 181754
#260915  9:44:37 server id 1  end_log_pos 181785 CRC32 0x317be3a2 	Xid = 2684
COMMIT/*!*/;
# at 181785
#260915  9:45:00 server id 1  end_log_pos 181864 CRC32 0xc8653690 	Anonymous_GTID	last_committed=130	sequence_number=131	rbr_only=yes	original_committed_timestamp=1789440300595397	immediate_commit_timestamp=1789440300595397	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789440300595397 (2026-09-15 09:45:00.595397 SE Asia Standard Time)
# immediate_commit_timestamp=1789440300595397 (2026-09-15 09:45:00.595397 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789440300595397*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 181864
#260915  9:45:00 server id 1  end_log_pos 181954 CRC32 0xb459ff17 	Query	thread_id=144	exec_time=0	error_code=0
SET TIMESTAMP=1789440300/*!*/;
BEGIN
/*!*/;
# at 181954
#260915  9:45:00 server id 1  end_log_pos 182028 CRC32 0x88059c57 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 182028
#260915  9:45:00 server id 1  end_log_pos 183204 CRC32 0xfbc56bf4 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
LLGoahMBAAAASgAAAAzHAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FecBYg=
LLGoah8BAAAAmAQAAKTLAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0VsahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OSyxqGr0a8X7
'/*!*/;
# at 183204
#260915  9:45:00 server id 1  end_log_pos 183235 CRC32 0x1ebe73d8 	Xid = 2708
COMMIT/*!*/;
# at 183235
#260915  9:45:03 server id 1  end_log_pos 183314 CRC32 0x06a69582 	Anonymous_GTID	last_committed=131	sequence_number=132	rbr_only=yes	original_committed_timestamp=1789440303458781	immediate_commit_timestamp=1789440303458781	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789440303458781 (2026-09-15 09:45:03.458781 SE Asia Standard Time)
# immediate_commit_timestamp=1789440303458781 (2026-09-15 09:45:03.458781 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789440303458781*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 183314
#260915  9:45:03 server id 1  end_log_pos 183404 CRC32 0x9b3f1eb5 	Query	thread_id=145	exec_time=0	error_code=0
SET TIMESTAMP=1789440303/*!*/;
BEGIN
/*!*/;
# at 183404
#260915  9:45:03 server id 1  end_log_pos 183478 CRC32 0x4cad230b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 183478
#260915  9:45:03 server id 1  end_log_pos 184670 CRC32 0x143727cc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
L7GoahMBAAAASgAAALbMAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AsjrUw=
L7Goah8BAAAAqAQAAF7RAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5LLGoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloYm01dmRX
NWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcx
bGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkvsahqzCc3FA==
'/*!*/;
# at 184670
#260915  9:45:03 server id 1  end_log_pos 184701 CRC32 0xde84269d 	Xid = 2729
COMMIT/*!*/;
# at 184701
#260915  9:45:05 server id 1  end_log_pos 184780 CRC32 0x284305a1 	Anonymous_GTID	last_committed=132	sequence_number=133	rbr_only=yes	original_committed_timestamp=1789440305055156	immediate_commit_timestamp=1789440305055156	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789440305055156 (2026-09-15 09:45:05.055156 SE Asia Standard Time)
# immediate_commit_timestamp=1789440305055156 (2026-09-15 09:45:05.055156 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789440305055156*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 184780
#260915  9:45:05 server id 1  end_log_pos 184870 CRC32 0x235cf907 	Query	thread_id=146	exec_time=0	error_code=0
SET TIMESTAMP=1789440305/*!*/;
BEGIN
/*!*/;
# at 184870
#260915  9:45:05 server id 1  end_log_pos 184944 CRC32 0xff654471 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 184944
#260915  9:45:05 server id 1  end_log_pos 186160 CRC32 0x6f3d2ebd 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
MbGoahMBAAAASgAAAHDSAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HFEZf8=
MbGoah8BAAAAwAQAADDXAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5L7GoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJ
MU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkxsahqvS49bw==
'/*!*/;
# at 186160
#260915  9:45:05 server id 1  end_log_pos 186191 CRC32 0x62086173 	Xid = 2750
COMMIT/*!*/;
# at 186191
#260915  9:45:08 server id 1  end_log_pos 186270 CRC32 0x0f1c81b0 	Anonymous_GTID	last_committed=133	sequence_number=134	rbr_only=yes	original_committed_timestamp=1789440308804922	immediate_commit_timestamp=1789440308804922	transaction_length=1470
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789440308804922 (2026-09-15 09:45:08.804922 SE Asia Standard Time)
# immediate_commit_timestamp=1789440308804922 (2026-09-15 09:45:08.804922 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789440308804922*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 186270
#260915  9:45:08 server id 1  end_log_pos 186360 CRC32 0xc678494c 	Query	thread_id=147	exec_time=0	error_code=0
SET TIMESTAMP=1789440308/*!*/;
BEGIN
/*!*/;
# at 186360
#260915  9:45:08 server id 1  end_log_pos 186434 CRC32 0x0c59e62a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 186434
#260915  9:45:08 server id 1  end_log_pos 187630 CRC32 0x79fc2315 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
NLGoahMBAAAASgAAAELYAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CrmWQw=
NLGoah8BAAAArAQAAO7cAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5MbGoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoQB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTkxYzJWeWN5STdjem8xT2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0
dWRYTmxjbk11YVc1a1pYZ2lPMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekpp
TW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9NLGoahUj/Hk=
'/*!*/;
# at 187630
#260915  9:45:08 server id 1  end_log_pos 187661 CRC32 0x2d63edaf 	Xid = 2777
COMMIT/*!*/;
# at 187661
#260915  9:45:12 server id 1  end_log_pos 187740 CRC32 0xc3038f2c 	Anonymous_GTID	last_committed=134	sequence_number=135	rbr_only=yes	original_committed_timestamp=1789440312767329	immediate_commit_timestamp=1789440312767329	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789440312767329 (2026-09-15 09:45:12.767329 SE Asia Standard Time)
# immediate_commit_timestamp=1789440312767329 (2026-09-15 09:45:12.767329 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789440312767329*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 187740
#260915  9:45:12 server id 1  end_log_pos 187830 CRC32 0x89ef7c83 	Query	thread_id=148	exec_time=0	error_code=0
SET TIMESTAMP=1789440312/*!*/;
BEGIN
/*!*/;
# at 187830
#260915  9:45:12 server id 1  end_log_pos 187904 CRC32 0xf4388223 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 187904
#260915  9:45:12 server id 1  end_log_pos 189080 CRC32 0xb98022c9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
OLGoahMBAAAASgAAAADeAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4COCOPQ=
OLGoah8BAAAAmAQAAJjiAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTSxqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTixqGrJIoC5
'/*!*/;
# at 189080
#260915  9:45:12 server id 1  end_log_pos 189111 CRC32 0x36486e30 	Xid = 2804
COMMIT/*!*/;
# at 189111
#260915 10:05:11 server id 1  end_log_pos 189190 CRC32 0x70944aee 	Anonymous_GTID	last_committed=135	sequence_number=136	rbr_only=yes	original_committed_timestamp=1789441511893716	immediate_commit_timestamp=1789441511893716	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441511893716 (2026-09-15 10:05:11.893716 SE Asia Standard Time)
# immediate_commit_timestamp=1789441511893716 (2026-09-15 10:05:11.893716 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441511893716*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 189190
#260915 10:05:11 server id 1  end_log_pos 189280 CRC32 0x5282ad0e 	Query	thread_id=149	exec_time=0	error_code=0
SET TIMESTAMP=1789441511/*!*/;
BEGIN
/*!*/;
# at 189280
#260915 10:05:11 server id 1  end_log_pos 189354 CRC32 0x19199f8d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 189354
#260915 10:05:11 server id 1  end_log_pos 190530 CRC32 0xf4372532 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
57WoahMBAAAASgAAAKrjAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4I2fGRk=
57Woah8BAAAAmAQAAELoAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTixqGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPee1qGoyJTf0
'/*!*/;
# at 190530
#260915 10:05:11 server id 1  end_log_pos 190561 CRC32 0x0cf9328e 	Xid = 2831
COMMIT/*!*/;
# at 190561
#260915 10:05:28 server id 1  end_log_pos 190640 CRC32 0xa8535c62 	Anonymous_GTID	last_committed=136	sequence_number=137	rbr_only=yes	original_committed_timestamp=1789441528957784	immediate_commit_timestamp=1789441528957784	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441528957784 (2026-09-15 10:05:28.957784 SE Asia Standard Time)
# immediate_commit_timestamp=1789441528957784 (2026-09-15 10:05:28.957784 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441528957784*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 190640
#260915 10:05:28 server id 1  end_log_pos 190730 CRC32 0xbd89cbd9 	Query	thread_id=150	exec_time=0	error_code=0
SET TIMESTAMP=1789441528/*!*/;
BEGIN
/*!*/;
# at 190730
#260915 10:05:28 server id 1  end_log_pos 190804 CRC32 0xb0f147d2 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 190804
#260915 10:05:28 server id 1  end_log_pos 191980 CRC32 0x950eb9e5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+LWoahMBAAAASgAAAFTpAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NJH8bA=
+LWoah8BAAAAmAQAAOztAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPee1qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfi1qGrluQ6V
'/*!*/;
# at 191980
#260915 10:05:28 server id 1  end_log_pos 192011 CRC32 0x0d43ef8a 	Xid = 2858
COMMIT/*!*/;
# at 192011
#260915 10:05:30 server id 1  end_log_pos 192090 CRC32 0xd4a2ca9e 	Anonymous_GTID	last_committed=137	sequence_number=138	rbr_only=yes	original_committed_timestamp=1789441530610594	immediate_commit_timestamp=1789441530610594	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441530610594 (2026-09-15 10:05:30.610594 SE Asia Standard Time)
# immediate_commit_timestamp=1789441530610594 (2026-09-15 10:05:30.610594 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441530610594*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 192090
#260915 10:05:30 server id 1  end_log_pos 192180 CRC32 0x7fdf74d8 	Query	thread_id=151	exec_time=0	error_code=0
SET TIMESTAMP=1789441530/*!*/;
BEGIN
/*!*/;
# at 192180
#260915 10:05:30 server id 1  end_log_pos 192254 CRC32 0xe61f3100 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 192254
#260915 10:05:30 server id 1  end_log_pos 193434 CRC32 0xe8fa3eb9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+rWoahMBAAAASgAAAP7uAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AAxH+Y=
+rWoah8BAAAAnAQAAJrzAgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfi1qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT36tahquT766A==
'/*!*/;
# at 193434
#260915 10:05:30 server id 1  end_log_pos 193465 CRC32 0xdee04f18 	Xid = 2879
COMMIT/*!*/;
# at 193465
#260915 10:05:35 server id 1  end_log_pos 193544 CRC32 0x953fa690 	Anonymous_GTID	last_committed=138	sequence_number=139	rbr_only=yes	original_committed_timestamp=1789441535924722	immediate_commit_timestamp=1789441535924722	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441535924722 (2026-09-15 10:05:35.924722 SE Asia Standard Time)
# immediate_commit_timestamp=1789441535924722 (2026-09-15 10:05:35.924722 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441535924722*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 193544
#260915 10:05:35 server id 1  end_log_pos 193634 CRC32 0x0dd67834 	Query	thread_id=152	exec_time=0	error_code=0
SET TIMESTAMP=1789441535/*!*/;
BEGIN
/*!*/;
# at 193634
#260915 10:05:35 server id 1  end_log_pos 193708 CRC32 0x28ba6e2d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 193708
#260915 10:05:35 server id 1  end_log_pos 194892 CRC32 0x81687e53 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/7WoahMBAAAASgAAAKz0AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4C1uuig=
/7Woah8BAAAAoAQAAEz5AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT36tahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OW5ZV3hsY21raU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1TG1kaGJHVnlhUzVwYm1S
bGVDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09/7WoalN+aIE=
'/*!*/;
# at 194892
#260915 10:05:35 server id 1  end_log_pos 194923 CRC32 0x23e50505 	Xid = 2900
COMMIT/*!*/;
# at 194923
#260915 10:05:40 server id 1  end_log_pos 195002 CRC32 0xa9848d06 	Anonymous_GTID	last_committed=139	sequence_number=140	rbr_only=yes	original_committed_timestamp=1789441540410851	immediate_commit_timestamp=1789441540410851	transaction_length=1474
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441540410851 (2026-09-15 10:05:40.410851 SE Asia Standard Time)
# immediate_commit_timestamp=1789441540410851 (2026-09-15 10:05:40.410851 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441540410851*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 195002
#260915 10:05:40 server id 1  end_log_pos 195092 CRC32 0x8d430386 	Query	thread_id=153	exec_time=0	error_code=0
SET TIMESTAMP=1789441540/*!*/;
BEGIN
/*!*/;
# at 195092
#260915 10:05:40 server id 1  end_log_pos 195166 CRC32 0xe2b78b38 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 195166
#260915 10:05:40 server id 1  end_log_pos 196366 CRC32 0xa6fa4eaa 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BLaoahMBAAAASgAAAF76AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DiLt+I=
BLaoah8BAAAAsAQAAA7/AgAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3/tahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2mAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWhibTV2ZFc1alpXMWxiblJ6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoYm01
dmRXNWpaVzFsYm5SekxtbHVaR1Y0SWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZr
WkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OQS2qGqq
Tvqm
'/*!*/;
# at 196366
#260915 10:05:40 server id 1  end_log_pos 196397 CRC32 0x79fa3003 	Xid = 2921
COMMIT/*!*/;
# at 196397
#260915 10:05:41 server id 1  end_log_pos 196476 CRC32 0x958422e0 	Anonymous_GTID	last_committed=140	sequence_number=141	rbr_only=yes	original_committed_timestamp=1789441541958864	immediate_commit_timestamp=1789441541958864	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441541958864 (2026-09-15 10:05:41.958864 SE Asia Standard Time)
# immediate_commit_timestamp=1789441541958864 (2026-09-15 10:05:41.958864 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441541958864*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 196476
#260915 10:05:41 server id 1  end_log_pos 196566 CRC32 0x689fcf30 	Query	thread_id=154	exec_time=0	error_code=0
SET TIMESTAMP=1789441541/*!*/;
BEGIN
/*!*/;
# at 196566
#260915 10:05:41 server id 1  end_log_pos 196640 CRC32 0xa97c5974 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 196640
#260915 10:05:41 server id 1  end_log_pos 197832 CRC32 0x0265c19a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BbaoahMBAAAASgAAACAAAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HRZfKk=
Bbaoah8BAAAAqAQAAMgEAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJt
NXZkVzVqWlcxbGJuUnpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhibTV2ZFc1
alpXMWxiblJ6TG1sdVpHVjRJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5BLaoagAoAEx3
bGszVEJ5RU01d2huUndvTktKT3lHVHBqQWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoAB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIw
eU56bDRjVGhpT1RsNU0wWm1URkJ3U0RaSE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkFtqhqmsFlAg==
'/*!*/;
# at 197832
#260915 10:05:41 server id 1  end_log_pos 197863 CRC32 0x314c7d41 	Xid = 2945
COMMIT/*!*/;
# at 197863
#260915 10:05:44 server id 1  end_log_pos 197942 CRC32 0x934b7c2a 	Anonymous_GTID	last_committed=141	sequence_number=142	rbr_only=yes	original_committed_timestamp=1789441544070914	immediate_commit_timestamp=1789441544070914	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441544070914 (2026-09-15 10:05:44.070914 SE Asia Standard Time)
# immediate_commit_timestamp=1789441544070914 (2026-09-15 10:05:44.070914 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441544070914*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 197942
#260915 10:05:44 server id 1  end_log_pos 198032 CRC32 0x8d8b0786 	Query	thread_id=155	exec_time=0	error_code=0
SET TIMESTAMP=1789441544/*!*/;
BEGIN
/*!*/;
# at 198032
#260915 10:05:44 server id 1  end_log_pos 198106 CRC32 0xfa84c887 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 198106
#260915 10:05:44 server id 1  end_log_pos 199282 CRC32 0xeb2891e9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
CLaoahMBAAAASgAAANoFAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IfIhPo=
CLaoah8BAAAAmAQAAHIKAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5BbaoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1lt
OWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PQi2qGrpkSjr
'/*!*/;
# at 199282
#260915 10:05:44 server id 1  end_log_pos 199313 CRC32 0x63b14a39 	Xid = 2978
COMMIT/*!*/;
# at 199313
#260915 10:05:46 server id 1  end_log_pos 199392 CRC32 0x1755353b 	Anonymous_GTID	last_committed=142	sequence_number=143	rbr_only=yes	original_committed_timestamp=1789441546537303	immediate_commit_timestamp=1789441546537303	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789441546537303 (2026-09-15 10:05:46.537303 SE Asia Standard Time)
# immediate_commit_timestamp=1789441546537303 (2026-09-15 10:05:46.537303 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789441546537303*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 199392
#260915 10:05:46 server id 1  end_log_pos 199482 CRC32 0x1d52b935 	Query	thread_id=156	exec_time=0	error_code=0
SET TIMESTAMP=1789441546/*!*/;
BEGIN
/*!*/;
# at 199482
#260915 10:05:46 server id 1  end_log_pos 199556 CRC32 0xb2eb9627 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 199556
#260915 10:05:46 server id 1  end_log_pos 200740 CRC32 0x40f535ca 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
CraoahMBAAAASgAAAIQLAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CeW67I=
Craoah8BAAAAoAQAACQQAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0ItqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09Craoaso19UA=
'/*!*/;
# at 200740
#260915 10:05:46 server id 1  end_log_pos 200771 CRC32 0x69a6fcb0 	Xid = 3011
COMMIT/*!*/;
# at 200771
#260915 10:26:06 server id 1  end_log_pos 200850 CRC32 0xe74648a0 	Anonymous_GTID	last_committed=143	sequence_number=144	rbr_only=yes	original_committed_timestamp=1789442766347245	immediate_commit_timestamp=1789442766347245	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442766347245 (2026-09-15 10:26:06.347245 SE Asia Standard Time)
# immediate_commit_timestamp=1789442766347245 (2026-09-15 10:26:06.347245 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442766347245*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 200850
#260915 10:26:06 server id 1  end_log_pos 200940 CRC32 0x9de67bef 	Query	thread_id=157	exec_time=0	error_code=0
SET TIMESTAMP=1789442766/*!*/;
BEGIN
/*!*/;
# at 200940
#260915 10:26:06 server id 1  end_log_pos 201014 CRC32 0x5a49dd1b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 201014
#260915 10:26:06 server id 1  end_log_pos 202198 CRC32 0x0eb31733 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
zrqoahMBAAAASgAAADYRAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BvdSVo=
zrqoah8BAAAAoAQAANYVAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0KtqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09zrqoajMXsw4=
'/*!*/;
# at 202198
#260915 10:26:06 server id 1  end_log_pos 202229 CRC32 0x7534ef55 	Xid = 3044
COMMIT/*!*/;
# at 202229
#260915 10:26:07 server id 1  end_log_pos 202308 CRC32 0x35281776 	Anonymous_GTID	last_committed=144	sequence_number=145	rbr_only=yes	original_committed_timestamp=1789442767217494	immediate_commit_timestamp=1789442767217494	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442767217494 (2026-09-15 10:26:07.217494 SE Asia Standard Time)
# immediate_commit_timestamp=1789442767217494 (2026-09-15 10:26:07.217494 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442767217494*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 202308
#260915 10:26:07 server id 1  end_log_pos 202398 CRC32 0x8216f195 	Query	thread_id=158	exec_time=0	error_code=0
SET TIMESTAMP=1789442767/*!*/;
BEGIN
/*!*/;
# at 202398
#260915 10:26:07 server id 1  end_log_pos 202472 CRC32 0xebc34ca2 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 202472
#260915 10:26:07 server id 1  end_log_pos 203656 CRC32 0x3d39946d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
z7qoahMBAAAASgAAAOgWAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KJMw+s=
z7qoah8BAAAAoAQAAIgbAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3OuqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09z7qoam2UOT0=
'/*!*/;
# at 203656
#260915 10:26:07 server id 1  end_log_pos 203687 CRC32 0xade6ece5 	Xid = 3077
COMMIT/*!*/;
# at 203687
#260915 10:26:12 server id 1  end_log_pos 203766 CRC32 0x88c36092 	Anonymous_GTID	last_committed=145	sequence_number=146	rbr_only=yes	original_committed_timestamp=1789442772621227	immediate_commit_timestamp=1789442772621227	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442772621227 (2026-09-15 10:26:12.621227 SE Asia Standard Time)
# immediate_commit_timestamp=1789442772621227 (2026-09-15 10:26:12.621227 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442772621227*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 203766
#260915 10:26:12 server id 1  end_log_pos 203856 CRC32 0x6d03a6fa 	Query	thread_id=159	exec_time=0	error_code=0
SET TIMESTAMP=1789442772/*!*/;
BEGIN
/*!*/;
# at 203856
#260915 10:26:12 server id 1  end_log_pos 203930 CRC32 0xb84da36b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 203930
#260915 10:26:12 server id 1  end_log_pos 205110 CRC32 0x35d3f283 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
1LqoahMBAAAASgAAAJocAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GujTbg=
1Lqoah8BAAAAnAQAADYhAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3PuqhqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXpaWFIwYVc1bmN5STdjem8xT2lKeWIzVjBaU0k3Y3pveE5Eb2lZV1J0YVc0dWMyVjBkR2x1WjNN
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD3Uuqhqg/LTNQ==
'/*!*/;
# at 205110
#260915 10:26:12 server id 1  end_log_pos 205141 CRC32 0x094e99ac 	Xid = 3095
COMMIT/*!*/;
# at 205141
#260915 10:26:20 server id 1  end_log_pos 205220 CRC32 0xa64c0a44 	Anonymous_GTID	last_committed=146	sequence_number=147	rbr_only=yes	original_committed_timestamp=1789442780708099	immediate_commit_timestamp=1789442780708099	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442780708099 (2026-09-15 10:26:20.708099 SE Asia Standard Time)
# immediate_commit_timestamp=1789442780708099 (2026-09-15 10:26:20.708099 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442780708099*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 205220
#260915 10:26:20 server id 1  end_log_pos 205310 CRC32 0x079adf0e 	Query	thread_id=160	exec_time=0	error_code=0
SET TIMESTAMP=1789442780/*!*/;
BEGIN
/*!*/;
# at 205310
#260915 10:26:20 server id 1  end_log_pos 205384 CRC32 0xa6a3d9ae 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 205384
#260915 10:26:20 server id 1  end_log_pos 206560 CRC32 0x3651ab47 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3LqoahMBAAAASgAAAEgiAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K7Zo6Y=
3Lqoah8BAAAAmAQAAOAmAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5elpY
UjBhVzVuY3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaVlXUnRhVzR1YzJWMGRHbHVaM01pTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPdS6qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5elpY
UjBhVzVuY3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaVlXUnRhVzR1YzJWMGRHbHVaM01pTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPdy6qGpHq1E2
'/*!*/;
# at 206560
#260915 10:26:20 server id 1  end_log_pos 206591 CRC32 0xbad84590 	Xid = 3113
COMMIT/*!*/;
# at 206591
#260915 10:26:36 server id 1  end_log_pos 206670 CRC32 0x88e9a986 	Anonymous_GTID	last_committed=147	sequence_number=148	rbr_only=yes	original_committed_timestamp=1789442796060695	immediate_commit_timestamp=1789442796060695	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442796060695 (2026-09-15 10:26:36.060695 SE Asia Standard Time)
# immediate_commit_timestamp=1789442796060695 (2026-09-15 10:26:36.060695 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442796060695*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 206670
#260915 10:26:36 server id 1  end_log_pos 206760 CRC32 0xf5972af3 	Query	thread_id=161	exec_time=0	error_code=0
SET TIMESTAMP=1789442796/*!*/;
BEGIN
/*!*/;
# at 206760
#260915 10:26:36 server id 1  end_log_pos 206834 CRC32 0x495b61dd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 206834
#260915 10:26:36 server id 1  end_log_pos 208010 CRC32 0xd0ddd22f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7LqoahMBAAAASgAAAPInAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N1hW0k=
7Lqoah8BAAAAmAQAAIosAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5elpY
UjBhVzVuY3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaVlXUnRhVzR1YzJWMGRHbHVaM01pTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPdy6qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPey6qGov0t3Q
'/*!*/;
# at 208010
#260915 10:26:36 server id 1  end_log_pos 208041 CRC32 0xf63deb08 	Xid = 3140
COMMIT/*!*/;
# at 208041
#260915 10:26:38 server id 1  end_log_pos 208120 CRC32 0x8fbab1cc 	Anonymous_GTID	last_committed=148	sequence_number=149	rbr_only=yes	original_committed_timestamp=1789442798720534	immediate_commit_timestamp=1789442798720534	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442798720534 (2026-09-15 10:26:38.720534 SE Asia Standard Time)
# immediate_commit_timestamp=1789442798720534 (2026-09-15 10:26:38.720534 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442798720534*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 208120
#260915 10:26:38 server id 1  end_log_pos 208210 CRC32 0xbfda6b3c 	Query	thread_id=162	exec_time=0	error_code=0
SET TIMESTAMP=1789442798/*!*/;
BEGIN
/*!*/;
# at 208210
#260915 10:26:38 server id 1  end_log_pos 208284 CRC32 0x85041022 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 208284
#260915 10:26:38 server id 1  end_log_pos 209460 CRC32 0x1197201c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7rqoahMBAAAASgAAAJwtAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CIQBIU=
7rqoah8BAAAAmAQAADQyAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPey6qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPe66qGocIJcR
'/*!*/;
# at 209460
#260915 10:26:38 server id 1  end_log_pos 209491 CRC32 0xff3edca1 	Xid = 3167
COMMIT/*!*/;
# at 209491
#260915 10:26:45 server id 1  end_log_pos 209570 CRC32 0x84ed9a20 	Anonymous_GTID	last_committed=149	sequence_number=150	rbr_only=yes	original_committed_timestamp=1789442805696093	immediate_commit_timestamp=1789442805696093	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442805696093 (2026-09-15 10:26:45.696093 SE Asia Standard Time)
# immediate_commit_timestamp=1789442805696093 (2026-09-15 10:26:45.696093 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442805696093*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 209570
#260915 10:26:45 server id 1  end_log_pos 209660 CRC32 0x189a082d 	Query	thread_id=163	exec_time=0	error_code=0
SET TIMESTAMP=1789442805/*!*/;
BEGIN
/*!*/;
# at 209660
#260915 10:26:45 server id 1  end_log_pos 209734 CRC32 0x2762526f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 209734
#260915 10:26:45 server id 1  end_log_pos 210910 CRC32 0xc5c89754 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
9bqoahMBAAAASgAAAEYzAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4G9SYic=
9bqoah8BAAAAmAQAAN43AwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPe66qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5elpY
UjBhVzVuY3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaVlXUnRhVzR1YzJWMGRHbHVaM01pTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfW6qGpUl8jF
'/*!*/;
# at 210910
#260915 10:26:45 server id 1  end_log_pos 210941 CRC32 0xa4038d70 	Xid = 3185
COMMIT/*!*/;
# at 210941
#260915 10:27:20 server id 1  end_log_pos 211020 CRC32 0x7670c25e 	Anonymous_GTID	last_committed=150	sequence_number=151	rbr_only=yes	original_committed_timestamp=1789442840030679	immediate_commit_timestamp=1789442840030679	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442840030679 (2026-09-15 10:27:20.030679 SE Asia Standard Time)
# immediate_commit_timestamp=1789442840030679 (2026-09-15 10:27:20.030679 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442840030679*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 211020
#260915 10:27:20 server id 1  end_log_pos 211110 CRC32 0x758d1b92 	Query	thread_id=164	exec_time=0	error_code=0
SET TIMESTAMP=1789442840/*!*/;
BEGIN
/*!*/;
# at 211110
#260915 10:27:20 server id 1  end_log_pos 211184 CRC32 0x936ed8d1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 211184
#260915 10:27:20 server id 1  end_log_pos 212364 CRC32 0xf7f565d8 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
GLuoahMBAAAASgAAAPA4AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NHYbpM=
GLuoah8BAAAAnAQAAIw9AwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5elpY
UjBhVzVuY3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaVlXUnRhVzR1YzJWMGRHbHVaM01pTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfW6qGoAKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0Yu6hq2GX19w==
'/*!*/;
# at 212364
#260915 10:27:20 server id 1  end_log_pos 212395 CRC32 0xe6e4e432 	Xid = 3218
COMMIT/*!*/;
# at 212395
#260915 10:27:43 server id 1  end_log_pos 212474 CRC32 0xc64d66c1 	Anonymous_GTID	last_committed=151	sequence_number=152	rbr_only=yes	original_committed_timestamp=1789442863550154	immediate_commit_timestamp=1789442863550154	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789442863550154 (2026-09-15 10:27:43.550154 SE Asia Standard Time)
# immediate_commit_timestamp=1789442863550154 (2026-09-15 10:27:43.550154 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789442863550154*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 212474
#260915 10:27:43 server id 1  end_log_pos 212564 CRC32 0x32c141d9 	Query	thread_id=165	exec_time=0	error_code=0
SET TIMESTAMP=1789442863/*!*/;
BEGIN
/*!*/;
# at 212564
#260915 10:27:43 server id 1  end_log_pos 212638 CRC32 0x436e1e94 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 212638
#260915 10:27:43 server id 1  end_log_pos 213814 CRC32 0x29ff9321 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
L7uoahMBAAAASgAAAJ4+AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JQebkM=
L7uoah8BAAAAmAQAADZDAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0Yu6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2gAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXVaWGR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTV1WlhkekxtbHVaR1Y0SWp0
OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJq
TjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OS+7qGohk/8p
'/*!*/;
# at 213814
#260915 10:27:43 server id 1  end_log_pos 213845 CRC32 0x62116e90 	Xid = 3242
COMMIT/*!*/;
# at 213845
#260915 10:38:07 server id 1  end_log_pos 213924 CRC32 0xb6e6cbe2 	Anonymous_GTID	last_committed=152	sequence_number=153	rbr_only=yes	original_committed_timestamp=1789443487809472	immediate_commit_timestamp=1789443487809472	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443487809472 (2026-09-15 10:38:07.809472 SE Asia Standard Time)
# immediate_commit_timestamp=1789443487809472 (2026-09-15 10:38:07.809472 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443487809472*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 213924
#260915 10:38:07 server id 1  end_log_pos 214014 CRC32 0x0646169a 	Query	thread_id=166	exec_time=0	error_code=0
SET TIMESTAMP=1789443487/*!*/;
BEGIN
/*!*/;
# at 214014
#260915 10:38:07 server id 1  end_log_pos 214088 CRC32 0x7f7f43ef 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 214088
#260915 10:38:07 server id 1  end_log_pos 215256 CRC32 0xfb1f8edc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
n72oahMBAAAASgAAAEhEAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O9Df38=
n72oah8BAAAAkAQAANhIAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5L7uoagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNoABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTl1Wlhkeklq
dHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1dVpYZHpMbWx1WkdWNElqdDljem8xTURv
aWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1Zo
TkdVek1EazRPV1FpTzJrNk5EdDmfvahq3I4f+w==
'/*!*/;
# at 215256
#260915 10:38:07 server id 1  end_log_pos 215287 CRC32 0x6ada498f 	Xid = 3266
COMMIT/*!*/;
# at 215287
#260915 10:38:18 server id 1  end_log_pos 215366 CRC32 0x29194fe7 	Anonymous_GTID	last_committed=153	sequence_number=154	rbr_only=yes	original_committed_timestamp=1789443498414292	immediate_commit_timestamp=1789443498414292	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443498414292 (2026-09-15 10:38:18.414292 SE Asia Standard Time)
# immediate_commit_timestamp=1789443498414292 (2026-09-15 10:38:18.414292 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443498414292*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 215366
#260915 10:38:18 server id 1  end_log_pos 215456 CRC32 0x1fa920e6 	Query	thread_id=167	exec_time=0	error_code=0
SET TIMESTAMP=1789443498/*!*/;
BEGIN
/*!*/;
# at 215456
#260915 10:38:18 server id 1  end_log_pos 215530 CRC32 0x0f2a0983 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 215530
#260915 10:38:18 server id 1  end_log_pos 216706 CRC32 0xde7fd5ba 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
qr2oahMBAAAASgAAAOpJAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IMJKg8=
qr2oah8BAAAAmAQAAIJOAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5n72oagAoAEx3bGszVEJ5RU01d2huUndvTktKT3lHVHBq
QWJBOXZ3dno3bkptZjQEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaVJreDNkV2huU0ZsU1ZrUkpVbGhSWjIweU56bDRjVGhpT1RsNU0wWm1URkJ3U0Ra
SE5rbHRhQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFj
bXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1lt
OWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9Paq9qGq61X/e
'/*!*/;
# at 216706
#260915 10:38:18 server id 1  end_log_pos 216737 CRC32 0xcd7af94a 	Xid = 3299
COMMIT/*!*/;
# at 216737
#260915 10:38:32 server id 1  end_log_pos 216816 CRC32 0x794c8a23 	Anonymous_GTID	last_committed=154	sequence_number=155	rbr_only=yes	original_committed_timestamp=1789443512971187	immediate_commit_timestamp=1789443512971187	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443512971187 (2026-09-15 10:38:32.971187 SE Asia Standard Time)
# immediate_commit_timestamp=1789443512971187 (2026-09-15 10:38:32.971187 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443512971187*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 216816
#260915 10:38:32 server id 1  end_log_pos 216906 CRC32 0x78d9ff3d 	Query	thread_id=168	exec_time=0	error_code=0
SET TIMESTAMP=1789443512/*!*/;
BEGIN
/*!*/;
# at 216906
#260915 10:38:32 server id 1  end_log_pos 216980 CRC32 0x9e611cee 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 216980
#260915 10:38:32 server id 1  end_log_pos 218164 CRC32 0xd1ba767f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
uL2oahMBAAAASgAAAJRPAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O4cYZ4=
uL2oah8BAAAAoAQAADRUAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2qvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09uL2oan92utE=
'/*!*/;
# at 218164
#260915 10:38:32 server id 1  end_log_pos 218195 CRC32 0xe76216f5 	Xid = 3323
COMMIT/*!*/;
# at 218195
#260915 10:38:33 server id 1  end_log_pos 218274 CRC32 0xf7c69dea 	Anonymous_GTID	last_committed=155	sequence_number=156	rbr_only=yes	original_committed_timestamp=1789443513802308	immediate_commit_timestamp=1789443513802308	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443513802308 (2026-09-15 10:38:33.802308 SE Asia Standard Time)
# immediate_commit_timestamp=1789443513802308 (2026-09-15 10:38:33.802308 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443513802308*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 218274
#260915 10:38:33 server id 1  end_log_pos 218364 CRC32 0x582c3c8d 	Query	thread_id=169	exec_time=0	error_code=0
SET TIMESTAMP=1789443513/*!*/;
BEGIN
/*!*/;
# at 218364
#260915 10:38:33 server id 1  end_log_pos 218438 CRC32 0x0d5faee5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 218438
#260915 10:38:33 server id 1  end_log_pos 219622 CRC32 0xc20cee44 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ub2oahMBAAAASgAAAEZVAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OWuXw0=
ub2oah8BAAAAoAQAAOZZAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT24vahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09ub2oakTuDMI=
'/*!*/;
# at 219622
#260915 10:38:33 server id 1  end_log_pos 219653 CRC32 0xd40cb3ac 	Xid = 3344
COMMIT/*!*/;
# at 219653
#260915 10:38:37 server id 1  end_log_pos 219732 CRC32 0xb649ac7a 	Anonymous_GTID	last_committed=156	sequence_number=157	rbr_only=yes	original_committed_timestamp=1789443517846863	immediate_commit_timestamp=1789443517846863	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443517846863 (2026-09-15 10:38:37.846863 SE Asia Standard Time)
# immediate_commit_timestamp=1789443517846863 (2026-09-15 10:38:37.846863 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443517846863*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 219732
#260915 10:38:37 server id 1  end_log_pos 219822 CRC32 0x525f21c3 	Query	thread_id=170	exec_time=0	error_code=0
SET TIMESTAMP=1789443517/*!*/;
BEGIN
/*!*/;
# at 219822
#260915 10:38:37 server id 1  end_log_pos 219896 CRC32 0x884bb825 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 219896
#260915 10:38:37 server id 1  end_log_pos 221080 CRC32 0x5232e7bd 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
vb2oahMBAAAASgAAAPhaAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CW4S4g=
vb2oah8BAAAAoAQAAJhfAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT25vahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09vb2oar3nMlI=
'/*!*/;
# at 221080
#260915 10:38:37 server id 1  end_log_pos 221111 CRC32 0xb90e4b2a 	Xid = 3371
COMMIT/*!*/;
# at 221111
#260915 10:38:39 server id 1  end_log_pos 221190 CRC32 0xb2553019 	Anonymous_GTID	last_committed=157	sequence_number=158	rbr_only=yes	original_committed_timestamp=1789443519119520	immediate_commit_timestamp=1789443519119520	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443519119520 (2026-09-15 10:38:39.119520 SE Asia Standard Time)
# immediate_commit_timestamp=1789443519119520 (2026-09-15 10:38:39.119520 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443519119520*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 221190
#260915 10:38:39 server id 1  end_log_pos 221280 CRC32 0xcf2aeaaf 	Query	thread_id=171	exec_time=0	error_code=0
SET TIMESTAMP=1789443519/*!*/;
BEGIN
/*!*/;
# at 221280
#260915 10:38:39 server id 1  end_log_pos 221354 CRC32 0x17ed3e3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 221354
#260915 10:38:39 server id 1  end_log_pos 222538 CRC32 0xa770cf2a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
v72oahMBAAAASgAAAKpgAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Do+7Rc=
v72oah8BAAAAoAQAAEplAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT29vahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09v72oairPcKc=
'/*!*/;
# at 222538
#260915 10:38:39 server id 1  end_log_pos 222569 CRC32 0x7d3d3234 	Xid = 3398
COMMIT/*!*/;
# at 222569
#260915 10:38:40 server id 1  end_log_pos 222648 CRC32 0xfa1d7360 	Anonymous_GTID	last_committed=158	sequence_number=159	rbr_only=yes	original_committed_timestamp=1789443520792149	immediate_commit_timestamp=1789443520792149	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443520792149 (2026-09-15 10:38:40.792149 SE Asia Standard Time)
# immediate_commit_timestamp=1789443520792149 (2026-09-15 10:38:40.792149 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443520792149*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 222648
#260915 10:38:40 server id 1  end_log_pos 222738 CRC32 0x3cbefc1a 	Query	thread_id=172	exec_time=0	error_code=0
SET TIMESTAMP=1789443520/*!*/;
BEGIN
/*!*/;
# at 222738
#260915 10:38:40 server id 1  end_log_pos 222812 CRC32 0x23f6d711 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 222812
#260915 10:38:40 server id 1  end_log_pos 223996 CRC32 0x5e7a1195 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
wL2oahMBAAAASgAAAFxmAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BHX9iM=
wL2oah8BAAAAoAQAAPxqAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2/vahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09wL2oapURel4=
'/*!*/;
# at 223996
#260915 10:38:40 server id 1  end_log_pos 224027 CRC32 0xe96fed42 	Xid = 3431
COMMIT/*!*/;
# at 224027
#260915 10:38:42 server id 1  end_log_pos 224106 CRC32 0x6532aa83 	Anonymous_GTID	last_committed=159	sequence_number=160	rbr_only=yes	original_committed_timestamp=1789443522676349	immediate_commit_timestamp=1789443522676349	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443522676349 (2026-09-15 10:38:42.676349 SE Asia Standard Time)
# immediate_commit_timestamp=1789443522676349 (2026-09-15 10:38:42.676349 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443522676349*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 224106
#260915 10:38:42 server id 1  end_log_pos 224196 CRC32 0x09dfa9d6 	Query	thread_id=173	exec_time=0	error_code=0
SET TIMESTAMP=1789443522/*!*/;
BEGIN
/*!*/;
# at 224196
#260915 10:38:42 server id 1  end_log_pos 224270 CRC32 0xba301c5d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 224270
#260915 10:38:42 server id 1  end_log_pos 225454 CRC32 0x63e2fde9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
wr2oahMBAAAASgAAAA5sAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4F0cMLo=
wr2oah8BAAAAoAQAAK5wAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3AvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09wr2oaun94mM=
'/*!*/;
# at 225454
#260915 10:38:42 server id 1  end_log_pos 225485 CRC32 0x945d87ee 	Xid = 3455
COMMIT/*!*/;
# at 225485
#260915 10:38:44 server id 1  end_log_pos 225564 CRC32 0x722a8436 	Anonymous_GTID	last_committed=160	sequence_number=161	rbr_only=yes	original_committed_timestamp=1789443524435411	immediate_commit_timestamp=1789443524435411	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443524435411 (2026-09-15 10:38:44.435411 SE Asia Standard Time)
# immediate_commit_timestamp=1789443524435411 (2026-09-15 10:38:44.435411 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443524435411*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 225564
#260915 10:38:44 server id 1  end_log_pos 225654 CRC32 0x5cee182d 	Query	thread_id=174	exec_time=0	error_code=0
SET TIMESTAMP=1789443524/*!*/;
BEGIN
/*!*/;
# at 225654
#260915 10:38:44 server id 1  end_log_pos 225728 CRC32 0xda878092 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 225728
#260915 10:38:44 server id 1  end_log_pos 226912 CRC32 0xd6358a18 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
xL2oahMBAAAASgAAAMBxAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JKAh9o=
xL2oah8BAAAAoAQAAGB2AwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3CvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09xL2oahiKNdY=
'/*!*/;
# at 226912
#260915 10:38:44 server id 1  end_log_pos 226943 CRC32 0x9f905338 	Xid = 3476
COMMIT/*!*/;
# at 226943
#260915 10:38:47 server id 1  end_log_pos 227022 CRC32 0x2bae0b51 	Anonymous_GTID	last_committed=161	sequence_number=162	rbr_only=yes	original_committed_timestamp=1789443527316701	immediate_commit_timestamp=1789443527316701	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443527316701 (2026-09-15 10:38:47.316701 SE Asia Standard Time)
# immediate_commit_timestamp=1789443527316701 (2026-09-15 10:38:47.316701 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443527316701*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 227022
#260915 10:38:47 server id 1  end_log_pos 227112 CRC32 0x2ef952af 	Query	thread_id=175	exec_time=0	error_code=0
SET TIMESTAMP=1789443527/*!*/;
BEGIN
/*!*/;
# at 227112
#260915 10:38:47 server id 1  end_log_pos 227186 CRC32 0x5c106edd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 227186
#260915 10:38:47 server id 1  end_log_pos 228370 CRC32 0x8af4e2e3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
x72oahMBAAAASgAAAHJ3AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N1uEFw=
x72oah8BAAAAoAQAABJ8AwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3EvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09x72oauPi9Io=
'/*!*/;
# at 228370
#260915 10:38:47 server id 1  end_log_pos 228401 CRC32 0x82b1fc00 	Xid = 3497
COMMIT/*!*/;
# at 228401
#260915 10:38:49 server id 1  end_log_pos 228480 CRC32 0x6adbe563 	Anonymous_GTID	last_committed=162	sequence_number=163	rbr_only=yes	original_committed_timestamp=1789443529769458	immediate_commit_timestamp=1789443529769458	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443529769458 (2026-09-15 10:38:49.769458 SE Asia Standard Time)
# immediate_commit_timestamp=1789443529769458 (2026-09-15 10:38:49.769458 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443529769458*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 228480
#260915 10:38:49 server id 1  end_log_pos 228570 CRC32 0xcd02dc4d 	Query	thread_id=177	exec_time=0	error_code=0
SET TIMESTAMP=1789443529/*!*/;
BEGIN
/*!*/;
# at 228570
#260915 10:38:49 server id 1  end_log_pos 228644 CRC32 0xbf36c277 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 228644
#260915 10:38:49 server id 1  end_log_pos 229828 CRC32 0xf7079e09 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
yb2oahMBAAAASgAAACR9AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HfCNr8=
yb2oah8BAAAAoAQAAMSBAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3HvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09yb2oagmeB/c=
'/*!*/;
# at 229828
#260915 10:38:49 server id 1  end_log_pos 229859 CRC32 0x489e3fe2 	Xid = 3545
COMMIT/*!*/;
# at 229859
#260915 10:38:50 server id 1  end_log_pos 229938 CRC32 0x728c12cd 	Anonymous_GTID	last_committed=163	sequence_number=164	rbr_only=yes	original_committed_timestamp=1789443530508062	immediate_commit_timestamp=1789443530508062	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443530508062 (2026-09-15 10:38:50.508062 SE Asia Standard Time)
# immediate_commit_timestamp=1789443530508062 (2026-09-15 10:38:50.508062 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443530508062*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 229938
#260915 10:38:50 server id 1  end_log_pos 230028 CRC32 0x7d8293f0 	Query	thread_id=178	exec_time=0	error_code=0
SET TIMESTAMP=1789443530/*!*/;
BEGIN
/*!*/;
# at 230028
#260915 10:38:50 server id 1  end_log_pos 230102 CRC32 0x4b7c5f0d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 230102
#260915 10:38:50 server id 1  end_log_pos 231286 CRC32 0xec1e8bb3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
yr2oahMBAAAASgAAANaCAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4A1ffEs=
yr2oah8BAAAAoAQAAHaHAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3JvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09yr2oarOLHuw=
'/*!*/;
# at 231286
#260915 10:38:50 server id 1  end_log_pos 231317 CRC32 0x2b314288 	Xid = 3572
COMMIT/*!*/;
# at 231317
#260915 10:39:05 server id 1  end_log_pos 231396 CRC32 0xb915afa0 	Anonymous_GTID	last_committed=164	sequence_number=165	rbr_only=yes	original_committed_timestamp=1789443545945876	immediate_commit_timestamp=1789443545945876	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443545945876 (2026-09-15 10:39:05.945876 SE Asia Standard Time)
# immediate_commit_timestamp=1789443545945876 (2026-09-15 10:39:05.945876 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443545945876*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 231396
#260915 10:39:05 server id 1  end_log_pos 231486 CRC32 0x89a20e99 	Query	thread_id=179	exec_time=0	error_code=0
SET TIMESTAMP=1789443545/*!*/;
BEGIN
/*!*/;
# at 231486
#260915 10:39:05 server id 1  end_log_pos 231560 CRC32 0xba15e3ed 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 231560
#260915 10:39:05 server id 1  end_log_pos 232744 CRC32 0xfe32219a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
2b2oahMBAAAASgAAAIiIAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O3jFbo=
2b2oah8BAAAAoAQAACiNAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3KvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT092b2oapohMv4=
'/*!*/;
# at 232744
#260915 10:39:05 server id 1  end_log_pos 232775 CRC32 0xc70a7d88 	Xid = 3605
COMMIT/*!*/;
# at 232775
#260915 10:39:07 server id 1  end_log_pos 232854 CRC32 0x899062aa 	Anonymous_GTID	last_committed=165	sequence_number=166	rbr_only=yes	original_committed_timestamp=1789443547129505	immediate_commit_timestamp=1789443547129505	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443547129505 (2026-09-15 10:39:07.129505 SE Asia Standard Time)
# immediate_commit_timestamp=1789443547129505 (2026-09-15 10:39:07.129505 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443547129505*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 232854
#260915 10:39:07 server id 1  end_log_pos 232944 CRC32 0xfa328cbd 	Query	thread_id=180	exec_time=0	error_code=0
SET TIMESTAMP=1789443547/*!*/;
BEGIN
/*!*/;
# at 232944
#260915 10:39:07 server id 1  end_log_pos 233018 CRC32 0x65e435c9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 233018
#260915 10:39:07 server id 1  end_log_pos 234202 CRC32 0x8bcf95c9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
272oahMBAAAASgAAADqOAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Mk15GU=
272oah8BAAAAoAQAANqSAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3ZvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09272oasmVz4s=
'/*!*/;
# at 234202
#260915 10:39:07 server id 1  end_log_pos 234233 CRC32 0x3c738efb 	Xid = 3629
COMMIT/*!*/;
# at 234233
#260915 10:39:08 server id 1  end_log_pos 234312 CRC32 0x20298f13 	Anonymous_GTID	last_committed=166	sequence_number=167	rbr_only=yes	original_committed_timestamp=1789443548054479	immediate_commit_timestamp=1789443548054479	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443548054479 (2026-09-15 10:39:08.054479 SE Asia Standard Time)
# immediate_commit_timestamp=1789443548054479 (2026-09-15 10:39:08.054479 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443548054479*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 234312
#260915 10:39:08 server id 1  end_log_pos 234402 CRC32 0xa5051133 	Query	thread_id=181	exec_time=0	error_code=0
SET TIMESTAMP=1789443548/*!*/;
BEGIN
/*!*/;
# at 234402
#260915 10:39:08 server id 1  end_log_pos 234476 CRC32 0xc8bf224c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 234476
#260915 10:39:08 server id 1  end_log_pos 235660 CRC32 0x1b7962b2 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3L2oahMBAAAASgAAAOyTAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ewiv8g=
3L2oah8BAAAAoAQAAIyYAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3bvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT093L2oarJieRs=
'/*!*/;
# at 235660
#260915 10:39:08 server id 1  end_log_pos 235691 CRC32 0x1b57137c 	Xid = 3650
COMMIT/*!*/;
# at 235691
#260915 10:39:10 server id 1  end_log_pos 235770 CRC32 0x8be0e7e2 	Anonymous_GTID	last_committed=167	sequence_number=168	rbr_only=yes	original_committed_timestamp=1789443550101686	immediate_commit_timestamp=1789443550101686	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443550101686 (2026-09-15 10:39:10.101686 SE Asia Standard Time)
# immediate_commit_timestamp=1789443550101686 (2026-09-15 10:39:10.101686 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443550101686*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 235770
#260915 10:39:10 server id 1  end_log_pos 235860 CRC32 0x553dd532 	Query	thread_id=182	exec_time=0	error_code=0
SET TIMESTAMP=1789443550/*!*/;
BEGIN
/*!*/;
# at 235860
#260915 10:39:10 server id 1  end_log_pos 235934 CRC32 0xf2c1a902 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 235934
#260915 10:39:10 server id 1  end_log_pos 237118 CRC32 0xe6753b68 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3r2oahMBAAAASgAAAJ6ZAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AKpwfI=
3r2oah8BAAAAoAQAAD6eAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3cvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT093r2oamg7deY=
'/*!*/;
# at 237118
#260915 10:39:10 server id 1  end_log_pos 237149 CRC32 0xc2a88ffa 	Xid = 3683
COMMIT/*!*/;
# at 237149
#260915 10:39:18 server id 1  end_log_pos 237228 CRC32 0x21481b89 	Anonymous_GTID	last_committed=168	sequence_number=169	rbr_only=yes	original_committed_timestamp=1789443558909733	immediate_commit_timestamp=1789443558909733	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443558909733 (2026-09-15 10:39:18.909733 SE Asia Standard Time)
# immediate_commit_timestamp=1789443558909733 (2026-09-15 10:39:18.909733 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443558909733*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 237228
#260915 10:39:18 server id 1  end_log_pos 237318 CRC32 0xc064daa3 	Query	thread_id=183	exec_time=0	error_code=0
SET TIMESTAMP=1789443558/*!*/;
BEGIN
/*!*/;
# at 237318
#260915 10:39:18 server id 1  end_log_pos 237392 CRC32 0x91ea4345 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 237392
#260915 10:39:18 server id 1  end_log_pos 238576 CRC32 0x36ccc662 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
5r2oahMBAAAASgAAAFCfAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EVD6pE=
5r2oah8BAAAAoAQAAPCjAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3evahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT095r2oamLGzDY=
'/*!*/;
# at 238576
#260915 10:39:18 server id 1  end_log_pos 238607 CRC32 0x38250dcb 	Xid = 3704
COMMIT/*!*/;
# at 238607
#260915 10:39:19 server id 1  end_log_pos 238686 CRC32 0xfcd7e7dc 	Anonymous_GTID	last_committed=169	sequence_number=170	rbr_only=yes	original_committed_timestamp=1789443559870082	immediate_commit_timestamp=1789443559870082	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443559870082 (2026-09-15 10:39:19.870082 SE Asia Standard Time)
# immediate_commit_timestamp=1789443559870082 (2026-09-15 10:39:19.870082 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443559870082*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 238686
#260915 10:39:19 server id 1  end_log_pos 238776 CRC32 0x003fb9ae 	Query	thread_id=184	exec_time=0	error_code=0
SET TIMESTAMP=1789443559/*!*/;
BEGIN
/*!*/;
# at 238776
#260915 10:39:19 server id 1  end_log_pos 238850 CRC32 0xe5e68de7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 238850
#260915 10:39:19 server id 1  end_log_pos 240034 CRC32 0x30b1851d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
572oahMBAAAASgAAAAKlAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OeN5uU=
572oah8BAAAAoAQAAKKpAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3mvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09572oah2FsTA=
'/*!*/;
# at 240034
#260915 10:39:19 server id 1  end_log_pos 240065 CRC32 0x48e105b3 	Xid = 3728
COMMIT/*!*/;
# at 240065
#260915 10:46:32 server id 1  end_log_pos 240144 CRC32 0x458694d7 	Anonymous_GTID	last_committed=170	sequence_number=171	rbr_only=yes	original_committed_timestamp=1789443992672116	immediate_commit_timestamp=1789443992672116	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443992672116 (2026-09-15 10:46:32.672116 SE Asia Standard Time)
# immediate_commit_timestamp=1789443992672116 (2026-09-15 10:46:32.672116 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443992672116*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 240144
#260915 10:46:32 server id 1  end_log_pos 240234 CRC32 0xa2bf8cb4 	Query	thread_id=185	exec_time=0	error_code=0
SET TIMESTAMP=1789443992/*!*/;
BEGIN
/*!*/;
# at 240234
#260915 10:46:32 server id 1  end_log_pos 240308 CRC32 0xcdba915f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 240308
#260915 10:46:32 server id 1  end_log_pos 241492 CRC32 0x159a3da6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
mL+oahMBAAAASgAAALSqAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4F+Rus0=
mL+oah8BAAAAoAQAAFSvAwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3nvahqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09mL+oaqY9mhU=
'/*!*/;
# at 241492
#260915 10:46:32 server id 1  end_log_pos 241523 CRC32 0xa9c16505 	Xid = 3749
COMMIT/*!*/;
# at 241523
#260915 10:46:33 server id 1  end_log_pos 241602 CRC32 0x4fc3cb38 	Anonymous_GTID	last_committed=171	sequence_number=172	rbr_only=yes	original_committed_timestamp=1789443993598248	immediate_commit_timestamp=1789443993598248	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443993598248 (2026-09-15 10:46:33.598248 SE Asia Standard Time)
# immediate_commit_timestamp=1789443993598248 (2026-09-15 10:46:33.598248 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443993598248*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 241602
#260915 10:46:33 server id 1  end_log_pos 241692 CRC32 0x9134af4e 	Query	thread_id=186	exec_time=0	error_code=0
SET TIMESTAMP=1789443993/*!*/;
BEGIN
/*!*/;
# at 241692
#260915 10:46:33 server id 1  end_log_pos 241766 CRC32 0x5e842354 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 241766
#260915 10:46:33 server id 1  end_log_pos 242950 CRC32 0x496a0db9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
mb+oahMBAAAASgAAAGawAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FQjhF4=
mb+oah8BAAAAoAQAAAa1AwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2Yv6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09mb+oarkNakk=
'/*!*/;
# at 242950
#260915 10:46:33 server id 1  end_log_pos 242981 CRC32 0x33471d14 	Xid = 3770
COMMIT/*!*/;
# at 242981
#260915 10:46:34 server id 1  end_log_pos 243060 CRC32 0x672156c3 	Anonymous_GTID	last_committed=172	sequence_number=173	rbr_only=yes	original_committed_timestamp=1789443994473357	immediate_commit_timestamp=1789443994473357	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789443994473357 (2026-09-15 10:46:34.473357 SE Asia Standard Time)
# immediate_commit_timestamp=1789443994473357 (2026-09-15 10:46:34.473357 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789443994473357*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 243060
#260915 10:46:34 server id 1  end_log_pos 243150 CRC32 0x273f3b35 	Query	thread_id=187	exec_time=0	error_code=0
SET TIMESTAMP=1789443994/*!*/;
BEGIN
/*!*/;
# at 243150
#260915 10:46:34 server id 1  end_log_pos 243224 CRC32 0x009d9b25 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 243224
#260915 10:46:34 server id 1  end_log_pos 244408 CRC32 0x151a030d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
mr+oahMBAAAASgAAABi2AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CWbnQA=
mr+oah8BAAAAoAQAALi6AwAAAFMAAAAAAAEAAgAG//8AKABMd2xrM1RCeUVNNXdoblJ3b05LSk95
R1RwakFiQTl2d3Z6N25KbWY0BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSa3gzZFdoblNGbFNWa1JKVWxoUloyMHlOemw0Y1RoaU9UbDVNMFptVEZC
d1NEWkhOa2x0YUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2Zv6hqACgATHdsazNUQnlFTTV3aG5Sd29O
S0pPeUdUcGpBYkE5dnd2ejduSm1mNAQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUmt4M2RXaG5TRmxTVmtSSlVsaFJaMjB5TnpsNGNUaGlPVGw1TTBa
bVRGQndTRFpITmtsdGFDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09mr+oag0DGhU=
'/*!*/;
# at 244408
#260915 10:46:34 server id 1  end_log_pos 244439 CRC32 0x261acfff 	Xid = 3797
COMMIT/*!*/;
# at 244439
#260915 13:06:57 server id 1  end_log_pos 244518 CRC32 0x12bf6bd7 	Anonymous_GTID	last_committed=173	sequence_number=174	rbr_only=yes	original_committed_timestamp=1789452417526152	immediate_commit_timestamp=1789452417526152	transaction_length=770
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452417526152 (2026-09-15 13:06:57.526152 SE Asia Standard Time)
# immediate_commit_timestamp=1789452417526152 (2026-09-15 13:06:57.526152 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452417526152*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 244518
#260915 13:06:57 server id 1  end_log_pos 244599 CRC32 0x2be65d1e 	Query	thread_id=188	exec_time=0	error_code=0
SET TIMESTAMP=1789452417/*!*/;
BEGIN
/*!*/;
# at 244599
#260915 13:06:57 server id 1  end_log_pos 244673 CRC32 0x3e463ffc 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 244673
#260915 13:06:57 server id 1  end_log_pos 245178 CRC32 0x4e7dd5c2 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
geCoahMBAAAASgAAAMG7AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Pw/Rj4=
geCoah4BAAAA+QEAALq9AwAAAFMAAAAAAAEAAgAG/wIoADEwbkNBSjJYbU9raXVTOEQ0eUlpZ0VP
Y3p4Unk0aHNrRzFDa2U5eHEJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzYoAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lRVmQzUW1kSlJtdFBVRVowWkU1TVkxYzVhVUpOTTBoVFJtWkJWa3RQZFRaNVRVZGtTbVZD
VUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpnNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFYUmhJanR6T2pVNklu
SnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYMD2B4KhqwtV9Tg==
'/*!*/;
# at 245178
#260915 13:06:57 server id 1  end_log_pos 245209 CRC32 0x9b1af2fa 	Xid = 3815
COMMIT/*!*/;
# at 245209
#260915 13:07:00 server id 1  end_log_pos 245288 CRC32 0xb29beb48 	Anonymous_GTID	last_committed=174	sequence_number=175	rbr_only=yes	original_committed_timestamp=1789452420781635	immediate_commit_timestamp=1789452420781635	transaction_length=1386
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452420781635 (2026-09-15 13:07:00.781635 SE Asia Standard Time)
# immediate_commit_timestamp=1789452420781635 (2026-09-15 13:07:00.781635 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452420781635*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 245288
#260915 13:07:00 server id 1  end_log_pos 245378 CRC32 0xd76f794e 	Query	thread_id=189	exec_time=0	error_code=0
SET TIMESTAMP=1789452420/*!*/;
BEGIN
/*!*/;
# at 245378
#260915 13:07:00 server id 1  end_log_pos 245452 CRC32 0x0d5fb425 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 245452
#260915 13:07:00 server id 1  end_log_pos 246564 CRC32 0xc0f6ee06 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
hOCoahMBAAAASgAAAMy+AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CW0Xw0=
hOCoah8BAAAAWAQAACTDAwAAAFMAAAAAAAEAAgAG//8CKAAxMG5DQUoyWG1Pa2l1UzhENHlJaWdF
T2N6eFJ5NGhza0cxQ2tlOXhxCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2KAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZkM1FtZEpSbXRQVUVaMFpFNU1ZMWM1YVVKTk0waFRSbVpCVmt0UGRUWjVUVWRrU21W
Q1VDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16ZzZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5cGJtWnZjbTFoYzJrdlltVnlhWFJoSWp0ek9qVTZJ
bkp2ZFhSbElqdHpPalk2SW1KbGNtbDBZU0k3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9geCoagIoADEwbkNBSjJY
bU9raXVTOEQ0eUlpZ0VPY3p4Unk0aHNrRzFDa2U5eHEJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAo
V2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBs
aWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzawAQAAWVRvME9udHpPalk2
SWw5MGIydGxiaUk3Y3pvME1Eb2lRVmQzUW1kSlJtdFBVRVowWkU1TVkxYzVhVUpOTTBoVFJtWkJW
a3RQZFRaNVRVZGtTbVZDVUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNt
d2lPM002TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhibTV2ZFc1
alpXMWxiblJ6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoYm01dmRXNWpaVzFs
Ym5SekxtbHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZN
RHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvek9pSjFjbXdpTzJFNk1UcDdjem80T2lKcGJu
UmxibVJsWkNJN2N6bzBNVG9pYUhSMGNEb3ZMekV5Tnk0d0xqQXVNVG80TURBd0wyRmtiV2x1TDJG
dWJtOTFibU5sYldWdWRITWlPMzE5hOCoagbu9sA=
'/*!*/;
# at 246564
#260915 13:07:00 server id 1  end_log_pos 246595 CRC32 0x954dc3ed 	Xid = 3824
COMMIT/*!*/;
# at 246595
#260915 13:07:01 server id 1  end_log_pos 246674 CRC32 0x044f241a 	Anonymous_GTID	last_committed=175	sequence_number=176	rbr_only=yes	original_committed_timestamp=1789452421093726	immediate_commit_timestamp=1789452421093726	transaction_length=1486
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452421093726 (2026-09-15 13:07:01.093726 SE Asia Standard Time)
# immediate_commit_timestamp=1789452421093726 (2026-09-15 13:07:01.093726 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452421093726*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 246674
#260915 13:07:01 server id 1  end_log_pos 246764 CRC32 0x9a65ad60 	Query	thread_id=190	exec_time=0	error_code=0
SET TIMESTAMP=1789452421/*!*/;
BEGIN
/*!*/;
# at 246764
#260915 13:07:01 server id 1  end_log_pos 246838 CRC32 0xf44f4faa 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 246838
#260915 13:07:01 server id 1  end_log_pos 248050 CRC32 0x62a62256 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
heCoahMBAAAASgAAADbEAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KpPT/Q=
heCoah8BAAAAvAQAAPLIAwAAAFMAAAAAAAEAAgAG//8CKAAxMG5DQUoyWG1Pa2l1UzhENHlJaWdF
T2N6eFJ5NGhza0cxQ2tlOXhxCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2sAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZkM1FtZEpSbXRQVUVaMFpFNU1ZMWM1YVVKTk0waFRSbVpCVmt0UGRUWjVUVWRrU21W
Q1VDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpaVzFsYm5SeklqdHpP
alU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJuUnpMbWx1WkdWNElq
dDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWN6b3pPaUoxY213aU8yRTZNVHA3Y3pvNE9pSnBiblJsYm1SbFpDSTdjem8w
TVRvaWFIUjBjRG92THpFeU55NHdMakF1TVRvNE1EQXdMMkZrYldsdUwyRnVibTkxYm1ObGJXVnVk
SE1pTzMxOYTgqGoCKAAxMG5DQUoyWG1Pa2l1UzhENHlJaWdFT2N6eFJ5NGhza0cxQ2tlOXhxCTEy
Ny4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVX
ZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkv
NTM3LjM2jAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pUVZkM1FtZEpSbXRQVUVa
MFpFNU1ZMWM1YVVKTk0waFRSbVpCVmt0UGRUWjVUVWRrU21WQ1VDSTdjem81T2lKZmNISmxkbWx2
ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZP
REF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZY
TTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJ
N1lUb3dPbnQ5ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0RvaWFXNTBaVzVrWldRaU8zTTZOREU2
SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aGJtNXZkVzVqWlcxbGJuUnpJ
anQ5ZlE9PYXgqGpWIqZi
'/*!*/;
# at 248050
#260915 13:07:01 server id 1  end_log_pos 248081 CRC32 0x18b4aa91 	Xid = 3833
COMMIT/*!*/;
# at 248081
#260915 13:07:20 server id 1  end_log_pos 248160 CRC32 0x48f1f587 	Anonymous_GTID	last_committed=176	sequence_number=177	rbr_only=yes	original_committed_timestamp=1789452440875604	immediate_commit_timestamp=1789452440875604	transaction_length=870
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452440875604 (2026-09-15 13:07:20.875604 SE Asia Standard Time)
# immediate_commit_timestamp=1789452440875604 (2026-09-15 13:07:20.875604 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452440875604*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 248160
#260915 13:07:20 server id 1  end_log_pos 248241 CRC32 0x1d0a5dc7 	Query	thread_id=191	exec_time=0	error_code=0
SET TIMESTAMP=1789452440/*!*/;
BEGIN
/*!*/;
# at 248241
#260915 13:07:20 server id 1  end_log_pos 248315 CRC32 0x641b8aa9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 248315
#260915 13:07:20 server id 1  end_log_pos 248920 CRC32 0x2c6cb7f9 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
mOCoahMBAAAASgAAAPvJAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KmKG2Q=
mOCoaiABAAAAXQIAAFjMAwAAAFMAAAAAAAEAAgAG/wIoADEwbkNBSjJYbU9raXVTOEQ0eUlpZ0VP
Y3p4Unk0aHNrRzFDa2U5eHEJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaMAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lRVmQzUW1kSlJtdFBVRVowWkU1TVkxYzVhVUpOTTBoVFJtWkJWa3RQZFRaNVRVZGtTbVZD
VUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9p
YVc1MFpXNWtaV1FpTzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBi
aTloYm01dmRXNWpaVzFsYm5SeklqdDlmUT09heCoavm3bCw=
'/*!*/;
# at 248920
#260915 13:07:20 server id 1  end_log_pos 248951 CRC32 0xec0cda77 	Xid = 3845
COMMIT/*!*/;
# at 248951
#260915 13:07:20 server id 1  end_log_pos 249030 CRC32 0x8634518a 	Anonymous_GTID	last_committed=177	sequence_number=178	rbr_only=yes	original_committed_timestamp=1789452440916160	immediate_commit_timestamp=1789452440916160	transaction_length=586
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452440916160 (2026-09-15 13:07:20.916160 SE Asia Standard Time)
# immediate_commit_timestamp=1789452440916160 (2026-09-15 13:07:20.916160 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452440916160*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 249030
#260915 13:07:20 server id 1  end_log_pos 249119 CRC32 0xfa689643 	Query	thread_id=191	exec_time=0	error_code=0
SET TIMESTAMP=1789452440/*!*/;
BEGIN
/*!*/;
# at 249119
#260915 13:07:20 server id 1  end_log_pos 249217 CRC32 0x0bb6a5c4 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 88
# at 249217
#260915 13:07:20 server id 1  end_log_pos 249506 CRC32 0xf8ce89dc 	Write_rows: table id 88 flags: STMT_END_F

BINLOG '
mOCoahMBAAAAYgAAAIHNAwAAAFgAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4MSltgs=
mOCoah4BAAAAIQEAAKLOAwAAAFgAAAAAAAEAAgAN//8AAAUAAAAAAAAABAAAAAAAAAAPAEJ1ZGkg
U2FudG9zbyBKcggAS2FyeWF3YW4LAGF1dGVudGlrYXNpBQBsb2dpbh4AbWVsYWt1a2FuIGxvZ2lu
IGtlIHBhbmVsIGFkbWluDwBBcHBcTW9kZWxzXFVzZXIEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemls
bGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAo
S0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNmqofihqqH4o
3InO+A==
'/*!*/;
# at 249506
#260915 13:07:20 server id 1  end_log_pos 249537 CRC32 0xc7329a0d 	Xid = 3848
COMMIT/*!*/;
# at 249537
#260915 13:07:20 server id 1  end_log_pos 249616 CRC32 0xb47897b4 	Anonymous_GTID	last_committed=178	sequence_number=179	rbr_only=yes	original_committed_timestamp=1789452440958248	immediate_commit_timestamp=1789452440958248	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452440958248 (2026-09-15 13:07:20.958248 SE Asia Standard Time)
# immediate_commit_timestamp=1789452440958248 (2026-09-15 13:07:20.958248 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452440958248*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 249616
#260915 13:07:20 server id 1  end_log_pos 249697 CRC32 0x87cabe8a 	Query	thread_id=191	exec_time=0	error_code=0
SET TIMESTAMP=1789452440/*!*/;
BEGIN
/*!*/;
# at 249697
#260915 13:07:20 server id 1  end_log_pos 249771 CRC32 0xe4b8441f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 249771
#260915 13:07:20 server id 1  end_log_pos 250380 CRC32 0x27a87e2b 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
mOCoahMBAAAASgAAAKvPAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4B9EuOQ=
mOCoah4BAAAAYQIAAAzSAwAAAFMAAAAAAAEAAgAG/wAoAG1TNTR4VHlPYlhYNFMxWkpaRHRtcThG
THI1eXo5WURZRUVEMlVMRm8EAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVRERnpTakpNYlVKRE4zSldkRTVJVDBsQlMzTkpja3RYYTFRemJtaDBRV3hI
ZWpGNWJrRnhWaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPZjgqGorfqgn
'/*!*/;
# at 250380
#260915 13:07:20 server id 1  end_log_pos 250411 CRC32 0xf27936fb 	Xid = 3854
COMMIT/*!*/;
# at 250411
#260915 13:07:29 server id 1  end_log_pos 250490 CRC32 0xb9948aac 	Anonymous_GTID	last_committed=179	sequence_number=180	rbr_only=yes	original_committed_timestamp=1789452449371738	immediate_commit_timestamp=1789452449371738	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789452449371738 (2026-09-15 13:07:29.371738 SE Asia Standard Time)
# immediate_commit_timestamp=1789452449371738 (2026-09-15 13:07:29.371738 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789452449371738*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 250490
#260915 13:07:29 server id 1  end_log_pos 250580 CRC32 0x0f8ea873 	Query	thread_id=192	exec_time=0	error_code=0
SET TIMESTAMP=1789452449/*!*/;
BEGIN
/*!*/;
# at 250580
#260915 13:07:29 server id 1  end_log_pos 250654 CRC32 0x899b17de 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 250654
#260915 13:07:29 server id 1  end_log_pos 251878 CRC32 0xeaf226dc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
oeCoahMBAAAASgAAAB7TAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N4Xm4k=
oeCoah8BAAAAyAQAAObXAwAAAFMAAAAAAAEAAgAG//8AKABtUzU0eFR5T2JYWDRTMVpKWkR0bXE4
RkxyNXl6OVlEWUVFRDJVTEZvBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUREZ6U2pKTWJVSkROM0pXZEU1SVQwbEJTM05KY2t0WGExUXpibWgwUVd4
SGVqRjVia0Z4VmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2Y4KhqACgAbVM1NHhUeU9iWFg0UzFaSlpE
dG1xOEZMcjV5ejlZRFlFRUQyVUxGbwQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2sAEAAFlUbzFPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pVERGelNqSk1iVUpETjNKV2RFNUlUMGxCUzNOSmNrdFhhMVF6Ym1o
MFFXeEhlakY1YmtGeFZpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloYm01dmRXNWpa
VzFsYm5SeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aGJtNXZkVzVqWlcxbGJu
UnpMbWx1WkdWNElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURw
N2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6b3pPaUoxY213aU8yRTZNRHA3ZlhNNk5UQTZJbXh2
WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxN
ekE1T0Rsa0lqdHBPalE3ZlE9PaHgqGrcJvLq
'/*!*/;
# at 251878
#260915 13:07:29 server id 1  end_log_pos 251909 CRC32 0xfcf17c9a 	Xid = 3870
COMMIT/*!*/;
# at 251909
#260915 13:07:57 server id 1  end_log_pos 251932 CRC32 0x22bd2be0 	Stop
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
