# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#260921  8:05:16 server id 1  end_log_pos 126 CRC32 0x0be2e2f2 	Start: binlog v 4, server v 8.0.30 created 260921  8:05:16 at startup
ROLLBACK/*!*/;
BINLOG '
zIKwag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAADMgrBqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAAfLi4gs=
'/*!*/;
# at 126
#260921  8:05:16 server id 1  end_log_pos 157 CRC32 0x5b4638d4 	Previous-GTIDs
# [empty]
# at 157
#260921  8:06:12 server id 1  end_log_pos 236 CRC32 0x336974fe 	Anonymous_GTID	last_committed=0	sequence_number=1	rbr_only=yes	original_committed_timestamp=1789952772265365	immediate_commit_timestamp=1789952772265365	transaction_length=746
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789952772265365 (2026-09-21 08:06:12.265365 SE Asia Standard Time)
# immediate_commit_timestamp=1789952772265365 (2026-09-21 08:06:12.265365 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789952772265365*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236
#260921  8:06:12 server id 1  end_log_pos 317 CRC32 0x87971b07 	Query	thread_id=8	exec_time=0	error_code=0
SET TIMESTAMP=1789952772/*!*/;
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
#260921  8:06:12 server id 1  end_log_pos 391 CRC32 0x8ac3082a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 391
#260921  8:06:12 server id 1  end_log_pos 872 CRC32 0x81d38614 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
BIOwahMBAAAASgAAAIcBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CoIw4o=
BIOwah4BAAAA4QEAAGgDAAAAAFMAAAAAAAEAAgAG/wIoADkyWXNUWFNEekk0Q2FDV2liR1lmVmVt
UkdKSzl1U3hmT2RQdmhHQWcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lUREpOYzB4b1pEQm9OSFYyVVVvMVdqRnBSRTlNT0RCdlIzWnhlazlQWW05UWNWWllRMkUz
ZVNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElq
dDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWZRPT0Eg7BqFIbTgQ==
'/*!*/;
# at 872
#260921  8:06:12 server id 1  end_log_pos 903 CRC32 0x00d3cc4d 	Xid = 59
COMMIT/*!*/;
# at 903
#260921  8:06:13 server id 1  end_log_pos 982 CRC32 0x0a0d1318 	Anonymous_GTID	last_committed=1	sequence_number=2	rbr_only=yes	original_committed_timestamp=1789952773239491	immediate_commit_timestamp=1789952773239491	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789952773239491 (2026-09-21 08:06:13.239491 SE Asia Standard Time)
# immediate_commit_timestamp=1789952773239491 (2026-09-21 08:06:13.239491 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789952773239491*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 982
#260921  8:06:13 server id 1  end_log_pos 1072 CRC32 0x301816cf 	Query	thread_id=9	exec_time=0	error_code=0
SET TIMESTAMP=1789952773/*!*/;
BEGIN
/*!*/;
# at 1072
#260921  8:06:13 server id 1  end_log_pos 1146 CRC32 0x8a248893 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 1146
#260921  8:06:13 server id 1  end_log_pos 2074 CRC32 0x118c1398 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BYOwahMBAAAASgAAAHoEAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JOIJIo=
BYOwah8BAAAAoAMAABoIAAAAAFMAAAAAAAEAAgAG//8CKAA5MllzVFhTRHpJNENhQ1dpYkdZZlZl
bVJHSks5dVN4Zk9kUHZoR0FnCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVERKTmMweG9aREJvTkhWMlVVbzFXakZwUkU5TU9EQnZSM1p4ZWs5UFltOVFjVlpZUTJF
M2VTSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT09BIOwagIoADkyWXNUWFNEekk0Q2FDV2liR1lmVmVtUkdKSzl1U3hm
T2RQdmhHQWcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lUREpO
YzB4b1pEQm9OSFYyVVVvMVdqRnBSRTlNT0RCdlIzWnhlazlQWW05UWNWWllRMkUzZVNJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lK
ZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2
ZTMxOWZRPT0Fg7BqmBOMEQ==
'/*!*/;
# at 2074
#260921  8:06:13 server id 1  end_log_pos 2105 CRC32 0x9a154638 	Xid = 116
COMMIT/*!*/;
# at 2105
#260921  8:14:55 server id 1  end_log_pos 2184 CRC32 0xb22b02a5 	Anonymous_GTID	last_committed=2	sequence_number=3	rbr_only=yes	original_committed_timestamp=1789953295398224	immediate_commit_timestamp=1789953295398224	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953295398224 (2026-09-21 08:14:55.398224 SE Asia Standard Time)
# immediate_commit_timestamp=1789953295398224 (2026-09-21 08:14:55.398224 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953295398224*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2184
#260921  8:14:55 server id 1  end_log_pos 2274 CRC32 0x34d0ef0c 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789953295/*!*/;
BEGIN
/*!*/;
# at 2274
#260921  8:14:55 server id 1  end_log_pos 2348 CRC32 0x148cbb3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 2348
#260921  8:14:55 server id 1  end_log_pos 3276 CRC32 0xef4f3590 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
D4WwahMBAAAASgAAACwJAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Dq7jBQ=
D4Wwah8BAAAAoAMAAMwMAAAAAFMAAAAAAAEAAgAG//8CKAA5MllzVFhTRHpJNENhQ1dpYkdZZlZl
bVJHSks5dVN4Zk9kUHZoR0FnCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVERKTmMweG9aREJvTkhWMlVVbzFXakZwUkU5TU9EQnZSM1p4ZWs5UFltOVFjVlpZUTJF
M2VTSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT09BYOwagIoADkyWXNUWFNEekk0Q2FDV2liR1lmVmVtUkdKSzl1U3hm
T2RQdmhHQWcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lUREpO
YzB4b1pEQm9OSFYyVVVvMVdqRnBSRTlNT0RCdlIzWnhlazlQWW05UWNWWllRMkUzZVNJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lK
ZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2
ZTMxOWZRPT0PhbBqkDVP7w==
'/*!*/;
# at 3276
#260921  8:14:55 server id 1  end_log_pos 3307 CRC32 0x26ac9cf2 	Xid = 173
COMMIT/*!*/;
# at 3307
#260921  8:14:58 server id 1  end_log_pos 3386 CRC32 0x9e08295c 	Anonymous_GTID	last_committed=3	sequence_number=4	rbr_only=yes	original_committed_timestamp=1789953298758826	immediate_commit_timestamp=1789953298758826	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953298758826 (2026-09-21 08:14:58.758826 SE Asia Standard Time)
# immediate_commit_timestamp=1789953298758826 (2026-09-21 08:14:58.758826 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953298758826*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3386
#260921  8:14:58 server id 1  end_log_pos 3476 CRC32 0xbea66dd1 	Query	thread_id=11	exec_time=0	error_code=0
SET TIMESTAMP=1789953298/*!*/;
BEGIN
/*!*/;
# at 3476
#260921  8:14:58 server id 1  end_log_pos 3550 CRC32 0x09833f49 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 3550
#260921  8:14:58 server id 1  end_log_pos 4494 CRC32 0x3adbbf50 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
EoWwahMBAAAASgAAAN4NAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ek/gwk=
EoWwah8BAAAAsAMAAI4RAAAAAFMAAAAAAAEAAgAG//8CKAA5MllzVFhTRHpJNENhQ1dpYkdZZlZl
bVJHSks5dVN4Zk9kUHZoR0FnCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVERKTmMweG9aREJvTkhWMlVVbzFXakZwUkU5TU9EQnZSM1p4ZWs5UFltOVFjVlpZUTJF
M2VTSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT09D4WwagIoADkyWXNUWFNEekk0Q2FDV2liR1lmVmVtUkdKSzl1U3hm
T2RQdmhHQWcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lUREpO
YzB4b1pEQm9OSFYyVVVvMVdqRnBSRTlNT0RCdlIzWnhlazlQWW05UWNWWllRMkUzZVNJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lK
c2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6
T2pNNkltNWxkeUk3WVRvd09udDlmWDA9EoWwalC/2zo=
'/*!*/;
# at 4494
#260921  8:14:58 server id 1  end_log_pos 4525 CRC32 0x8b303571 	Xid = 230
COMMIT/*!*/;
# at 4525
#260921  8:15:32 server id 1  end_log_pos 4604 CRC32 0x1b1d1470 	Anonymous_GTID	last_committed=4	sequence_number=5	rbr_only=yes	original_committed_timestamp=1789953332245963	immediate_commit_timestamp=1789953332245963	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953332245963 (2026-09-21 08:15:32.245963 SE Asia Standard Time)
# immediate_commit_timestamp=1789953332245963 (2026-09-21 08:15:32.245963 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953332245963*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4604
#260921  8:15:32 server id 1  end_log_pos 4685 CRC32 0x518c1542 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1789953332/*!*/;
BEGIN
/*!*/;
# at 4685
#260921  8:15:32 server id 1  end_log_pos 4759 CRC32 0x0d209d70 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 4759
#260921  8:15:32 server id 1  end_log_pos 5256 CRC32 0x37dc9f97 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
NIWwahMBAAAASgAAAJcSAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HCdIA0=
NIWwaiABAAAA8QEAAIgUAAAAAFMAAAAAAAEAAgAG/wIoADkyWXNUWFNEekk0Q2FDV2liR1lmVmVt
UkdKSzl1U3hmT2RQdmhHQWcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lUREpOYzB4b1pEQm9OSFYyVVVvMVdqRnBSRTlNT0RCdlIzWnhlazlQWW05UWNWWllRMkUz
ZVNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9EoWwapef3Dc=
'/*!*/;
# at 5256
#260921  8:15:32 server id 1  end_log_pos 5287 CRC32 0xbc696845 	Xid = 242
COMMIT/*!*/;
# at 5287
#260921  8:15:32 server id 1  end_log_pos 5366 CRC32 0xd0f7574a 	Anonymous_GTID	last_committed=5	sequence_number=6	rbr_only=yes	original_committed_timestamp=1789953332381029	immediate_commit_timestamp=1789953332381029	transaction_length=581
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953332381029 (2026-09-21 08:15:32.381029 SE Asia Standard Time)
# immediate_commit_timestamp=1789953332381029 (2026-09-21 08:15:32.381029 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953332381029*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5366
#260921  8:15:32 server id 1  end_log_pos 5455 CRC32 0xa56e1e4a 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1789953332/*!*/;
SET @@session.time_zone='SYSTEM'/*!*/;
BEGIN
/*!*/;
# at 5455
#260921  8:15:32 server id 1  end_log_pos 5553 CRC32 0x8f1e0ae0 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 92
# at 5553
#260921  8:15:32 server id 1  end_log_pos 5837 CRC32 0xba427ab6 	Write_rows: table id 92 flags: STMT_END_F

BINLOG '
NIWwahMBAAAAYgAAALEVAAAAAFwAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4OAKHo8=
NIWwah4BAAAAHAEAAM0WAAAAAFwAAAAAAAEAAgAN//8AAE4AAAAAAAAABAAAAAAAAAAFAEFkbWlu
DQBBZG1pbmlzdHJhdG9yCwBhdXRlbnRpa2FzaQUAbG9naW4eAG1lbGFrdWthbiBsb2dpbiBrZSBw
YW5lbCBhZG1pbg8AQXBwXE1vZGVsc1xVc2VyBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUu
MCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1M
LCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZqsCLEarAixLZ6Qro=
'/*!*/;
# at 5837
#260921  8:15:32 server id 1  end_log_pos 5868 CRC32 0xd871180b 	Xid = 245
COMMIT/*!*/;
# at 5868
#260921  8:15:32 server id 1  end_log_pos 5947 CRC32 0x6d332d6d 	Anonymous_GTID	last_committed=6	sequence_number=7	rbr_only=yes	original_committed_timestamp=1789953332595784	immediate_commit_timestamp=1789953332595784	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953332595784 (2026-09-21 08:15:32.595784 SE Asia Standard Time)
# immediate_commit_timestamp=1789953332595784 (2026-09-21 08:15:32.595784 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953332595784*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5947
#260921  8:15:32 server id 1  end_log_pos 6028 CRC32 0x2bc390e3 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1789953332/*!*/;
BEGIN
/*!*/;
# at 6028
#260921  8:15:32 server id 1  end_log_pos 6102 CRC32 0xe24a95da 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 6102
#260921  8:15:32 server id 1  end_log_pos 6691 CRC32 0x74741b62 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
NIWwahMBAAAASgAAANYXAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NqVSuI=
NIWwah4BAAAATQIAACMaAAAAAFMAAAAAAAEAAgAG/wAoAEkyR0VrbUZaY2F1ZEJwdTZzbjhFb21K
dlJDMlNFRUlqZE5iZGZQNHoEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaU1FaHBla3BUT1cwM01IUndOVEppVVc1Sk1HdEdRbEZKUW1KNFRHSnlZMUZV
V0ZaVlRVOHdiaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT00hbBqYht0dA==
'/*!*/;
# at 6691
#260921  8:15:32 server id 1  end_log_pos 6722 CRC32 0xd2cd7178 	Xid = 251
COMMIT/*!*/;
# at 6722
#260921  8:15:36 server id 1  end_log_pos 6801 CRC32 0x07da5f44 	Anonymous_GTID	last_committed=7	sequence_number=8	rbr_only=yes	original_committed_timestamp=1789953336737662	immediate_commit_timestamp=1789953336737662	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953336737662 (2026-09-21 08:15:36.737662 SE Asia Standard Time)
# immediate_commit_timestamp=1789953336737662 (2026-09-21 08:15:36.737662 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953336737662*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 6801
#260921  8:15:36 server id 1  end_log_pos 6891 CRC32 0x371ec1bb 	Query	thread_id=13	exec_time=0	error_code=0
SET TIMESTAMP=1789953336/*!*/;
BEGIN
/*!*/;
# at 6891
#260921  8:15:36 server id 1  end_log_pos 6965 CRC32 0x95c9d068 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 6965
#260921  8:15:36 server id 1  end_log_pos 8129 CRC32 0x617dcf23 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
OIWwahMBAAAASgAAADUbAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GjQyZU=
OIWwah8BAAAAjAQAAMEfAAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09NIWwagAoAEkyR0VrbUZaY2F1ZEJwdTZzbjhFb21KdlJDMlNFRUlqZE5iZGZQ
NHoEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaU1F
aHBla3BUT1cwM01IUndOVEppVVc1Sk1HdEdRbEZKUW1KNFRHSnlZMUZVV0ZaVlRVOHdiaUk3Y3pv
NU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlP
M002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUz
TTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PTiFsGojz31h
'/*!*/;
# at 8129
#260921  8:15:36 server id 1  end_log_pos 8160 CRC32 0xc23de289 	Xid = 440
COMMIT/*!*/;
# at 8160
#260921  8:17:37 server id 1  end_log_pos 8239 CRC32 0xdc076d1b 	Anonymous_GTID	last_committed=8	sequence_number=9	rbr_only=yes	original_committed_timestamp=1789953457578708	immediate_commit_timestamp=1789953457578708	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953457578708 (2026-09-21 08:17:37.578708 SE Asia Standard Time)
# immediate_commit_timestamp=1789953457578708 (2026-09-21 08:17:37.578708 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953457578708*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 8239
#260921  8:17:37 server id 1  end_log_pos 8329 CRC32 0xecc2ba39 	Query	thread_id=14	exec_time=0	error_code=0
SET TIMESTAMP=1789953457/*!*/;
BEGIN
/*!*/;
# at 8329
#260921  8:17:37 server id 1  end_log_pos 8403 CRC32 0x43cd59e0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 8403
#260921  8:17:37 server id 1  end_log_pos 9547 CRC32 0x1abb65f0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
sYWwahMBAAAASgAAANMgAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OBZzUM=
sYWwah8BAAAAeAQAAEslAAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT04hbBqACgASTJHRWttRlpjYXVkQnB1NnNu
OEVvbUp2UkMyU0VFSWpkTmJkZlA0egQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTUVocGVrcFRPVzAzTUhSd05USmlVVzVKTUd0R1FsRkpRbUo0VEdK
eVkxRlVXRlpWVFU4d2JpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdj
em8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1E
cDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDmxhbBq
8GW7Gg==
'/*!*/;
# at 9547
#260921  8:17:37 server id 1  end_log_pos 9578 CRC32 0xe25516fb 	Xid = 500
COMMIT/*!*/;
# at 9578
#260921  8:17:45 server id 1  end_log_pos 9657 CRC32 0xe47d275f 	Anonymous_GTID	last_committed=9	sequence_number=10	rbr_only=yes	original_committed_timestamp=1789953465368893	immediate_commit_timestamp=1789953465368893	transaction_length=1414
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953465368893 (2026-09-21 08:17:45.368893 SE Asia Standard Time)
# immediate_commit_timestamp=1789953465368893 (2026-09-21 08:17:45.368893 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953465368893*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 9657
#260921  8:17:45 server id 1  end_log_pos 9747 CRC32 0xf1ab2707 	Query	thread_id=15	exec_time=0	error_code=0
SET TIMESTAMP=1789953465/*!*/;
BEGIN
/*!*/;
# at 9747
#260921  8:17:45 server id 1  end_log_pos 9821 CRC32 0xddcb8c3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 9821
#260921  8:17:45 server id 1  end_log_pos 10961 CRC32 0x9f1fba80 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
uYWwahMBAAAASgAAAF0mAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DqMy90=
uYWwah8BAAAAdAQAANEqAAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0ObGFsGoAKABJ
MkdFa21GWmNhdWRCcHU2c244RW9tSnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaE
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVX
NUpNR3RHUWxGSlFtSjRUR0p5WTFGVVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlz
WVhsaGJtRnVMMlJoWm5SaGNpSTdjem8xT2lKeWIzVjBaU0k3Y3pveE5Eb2liR0Y1WVc1aGJpNWtZ
V1owWVhJaU8zMXpPalk2SWw5bWJHRnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6
b3pPaUp1WlhjaU8yRTZNRHA3Zlgxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpK
aU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPbmFsGqAuh+f
'/*!*/;
# at 10961
#260921  8:17:45 server id 1  end_log_pos 10992 CRC32 0xff554f01 	Xid = 560
COMMIT/*!*/;
# at 10992
#260921  8:17:51 server id 1  end_log_pos 11071 CRC32 0x1d694c04 	Anonymous_GTID	last_committed=10	sequence_number=11	rbr_only=yes	original_committed_timestamp=1789953471778595	immediate_commit_timestamp=1789953471778595	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953471778595 (2026-09-21 08:17:51.778595 SE Asia Standard Time)
# immediate_commit_timestamp=1789953471778595 (2026-09-21 08:17:51.778595 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953471778595*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 11071
#260921  8:17:51 server id 1  end_log_pos 11161 CRC32 0xbf2e1efb 	Query	thread_id=16	exec_time=0	error_code=0
SET TIMESTAMP=1789953471/*!*/;
BEGIN
/*!*/;
# at 11161
#260921  8:17:51 server id 1  end_log_pos 11235 CRC32 0xd139cd82 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 11235
#260921  8:17:51 server id 1  end_log_pos 12415 CRC32 0xc2cf1e37 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
v4WwahMBAAAASgAAAOMrAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ILNOdE=
v4Wwah8BAAAAnAQAAH8wAAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlzWVhsaGJtRnVMMlJoWm5SaGNpSTdj
em8xT2lKeWIzVjBaU0k3Y3pveE5Eb2liR0Y1WVc1aGJpNWtZV1owWVhJaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPbmFsGoAKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFTMXJZ
VzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2/hbBqNx7Pwg==
'/*!*/;
# at 12415
#260921  8:17:51 server id 1  end_log_pos 12446 CRC32 0x889bee1a 	Xid = 620
COMMIT/*!*/;
# at 12446
#260921  8:18:34 server id 1  end_log_pos 12525 CRC32 0x10fcda31 	Anonymous_GTID	last_committed=11	sequence_number=12	rbr_only=yes	original_committed_timestamp=1789953514036226	immediate_commit_timestamp=1789953514036226	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953514036226 (2026-09-21 08:18:34.036226 SE Asia Standard Time)
# immediate_commit_timestamp=1789953514036226 (2026-09-21 08:18:34.036226 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953514036226*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12525
#260921  8:18:34 server id 1  end_log_pos 12615 CRC32 0x5ffdb26b 	Query	thread_id=17	exec_time=0	error_code=0
SET TIMESTAMP=1789953514/*!*/;
BEGIN
/*!*/;
# at 12615
#260921  8:18:34 server id 1  end_log_pos 12689 CRC32 0x1f5118c5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 12689
#260921  8:18:34 server id 1  end_log_pos 13873 CRC32 0xc5db2854 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6oWwahMBAAAASgAAAJExAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MUYUR8=
6oWwah8BAAAAoAQAADE2AAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFTMXJZ
VzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2/hbBqACgASTJHRWttRlpjYXVkQnB1NnNu
OEVvbUp2UkMyU0VFSWpkTmJkZlA0egQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTUVocGVrcFRPVzAzTUhSd05USmlVVzVKTUd0R1FsRkpRbUo0VEdK
eVkxRlVXRlpWVFU4d2JpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5cmIyNTBZV3N2YUhWaWRXNW5h
UzFyWVcxcElqdHpPalU2SW5KdmRYUmxJanR6T2pFeU9pSm9kV0oxYm1kcExXdGhiV2tpTzMxek9q
WTZJbDltYkdGemFDSTdZVG95T250ek9qTTZJbTlzWkNJN1lUb3dPbnQ5Y3pvek9pSnVaWGNpTzJF
Nk1EcDdmWDF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3
WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA96oWwalQo28U=
'/*!*/;
# at 13873
#260921  8:18:34 server id 1  end_log_pos 13904 CRC32 0x4761804d 	Xid = 746
COMMIT/*!*/;
# at 13904
#260921  8:18:40 server id 1  end_log_pos 13983 CRC32 0x372d8da5 	Anonymous_GTID	last_committed=12	sequence_number=13	rbr_only=yes	original_committed_timestamp=1789953520201471	immediate_commit_timestamp=1789953520201471	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953520201471 (2026-09-21 08:18:40.201471 SE Asia Standard Time)
# immediate_commit_timestamp=1789953520201471 (2026-09-21 08:18:40.201471 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953520201471*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13983
#260921  8:18:40 server id 1  end_log_pos 14073 CRC32 0x4fd148e1 	Query	thread_id=18	exec_time=0	error_code=0
SET TIMESTAMP=1789953520/*!*/;
BEGIN
/*!*/;
# at 14073
#260921  8:18:40 server id 1  end_log_pos 14147 CRC32 0xcf8f544a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 14147
#260921  8:18:40 server id 1  end_log_pos 15331 CRC32 0xbf7d195b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
8IWwahMBAAAASgAAAEM3AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EpUj88=
8IWwah8BAAAAoAQAAOM7AAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFTMXJZ
VzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD3qhbBqACgASTJHRWttRlpjYXVkQnB1NnNu
OEVvbUp2UkMyU0VFSWpkTmJkZlA0egQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTUVocGVrcFRPVzAzTUhSd05USmlVVzVKTUd0R1FsRkpRbUo0VEdK
eVkxRlVXRlpWVFU4d2JpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5cmIyNTBZV3N2YUhWaWRXNW5h
UzFyWVcxcElqdHpPalU2SW5KdmRYUmxJanR6T2pFeU9pSm9kV0oxYm1kcExXdGhiV2tpTzMxek9q
WTZJbDltYkdGemFDSTdZVG95T250ek9qTTZJbTlzWkNJN1lUb3dPbnQ5Y3pvek9pSnVaWGNpTzJF
Nk1EcDdmWDF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3
WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA98IWwalsZfb8=
'/*!*/;
# at 15331
#260921  8:18:40 server id 1  end_log_pos 15362 CRC32 0x83394105 	Xid = 1115
COMMIT/*!*/;
# at 15362
#260921  8:23:18 server id 1  end_log_pos 15441 CRC32 0xdb612e96 	Anonymous_GTID	last_committed=13	sequence_number=14	rbr_only=yes	original_committed_timestamp=1789953798120686	immediate_commit_timestamp=1789953798120686	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789953798120686 (2026-09-21 08:23:18.120686 SE Asia Standard Time)
# immediate_commit_timestamp=1789953798120686 (2026-09-21 08:23:18.120686 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789953798120686*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 15441
#260921  8:23:18 server id 1  end_log_pos 15531 CRC32 0x13a1497e 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1789953798/*!*/;
BEGIN
/*!*/;
# at 15531
#260921  8:23:18 server id 1  end_log_pos 15605 CRC32 0x04c14860 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 15605
#260921  8:23:18 server id 1  end_log_pos 16749 CRC32 0xd416dc8e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BoewahMBAAAASgAAAPU8AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GBIwQQ=
Boewah8BAAAAeAQAAG1BAAAAAFMAAAAAAAEAAgAG//8AKABJMkdFa21GWmNhdWRCcHU2c244RW9t
SnZSQzJTRUVJamROYmRmUDR6BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lNRWhwZWtwVE9XMDNNSFJ3TlRKaVVXNUpNR3RHUWxGSlFtSjRUR0p5WTFG
VVdGWlZUVTh3YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFTMXJZ
VzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD3whbBqACgASTJHRWttRlpjYXVkQnB1NnNu
OEVvbUp2UkMyU0VFSWpkTmJkZlA0egQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTUVocGVrcFRPVzAzTUhSd05USmlVVzVKTUd0R1FsRkpRbUo0VEdK
eVkxRlVXRlpWVFU4d2JpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdj
em8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1E
cDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkGh7Bq
jtwW1A==
'/*!*/;
# at 16749
#260921  8:23:18 server id 1  end_log_pos 16780 CRC32 0x6c1ba5cc 	Xid = 1175
COMMIT/*!*/;
# at 16780
#260921  8:44:48 server id 1  end_log_pos 16859 CRC32 0x34b05dfe 	Anonymous_GTID	last_committed=14	sequence_number=15	rbr_only=yes	original_committed_timestamp=1789955088904632	immediate_commit_timestamp=1789955088904632	transaction_length=585
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955088904632 (2026-09-21 08:44:48.904632 SE Asia Standard Time)
# immediate_commit_timestamp=1789955088904632 (2026-09-21 08:44:48.904632 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955088904632*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 16859
#260921  8:44:48 server id 1  end_log_pos 16948 CRC32 0x1c8b51de 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1789955088/*!*/;
BEGIN
/*!*/;
# at 16948
#260921  8:44:48 server id 1  end_log_pos 17046 CRC32 0x6146f99c 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 92
# at 17046
#260921  8:44:48 server id 1  end_log_pos 17334 CRC32 0x98e0efcf 	Write_rows: table id 92 flags: STMT_END_F

BINLOG '
EIywahMBAAAAYgAAAJZCAAAAAFwAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4Jz5RmE=
EIywah4BAAAAIAEAALZDAAAAAFwAAAAAAAEAAgAN//8AAE8AAAAAAAAABAAAAAAAAAAFAEFkbWlu
DQBBZG1pbmlzdHJhdG9yCwBhdXRlbnRpa2FzaQYAbG9nb3V0IQBtZWxha3VrYW4gbG9nb3V0IGRh
cmkgcGFuZWwgYWRtaW4PAEFwcFxNb2RlbHNcVXNlcgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxs
YS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChL
SFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2arApoGqwKaDP
7+CY
'/*!*/;
# at 17334
#260921  8:44:48 server id 1  end_log_pos 17365 CRC32 0xc1ce4f0b 	Xid = 1187
COMMIT/*!*/;
# at 17365
#260921  8:44:49 server id 1  end_log_pos 17444 CRC32 0x62680c9b 	Anonymous_GTID	last_committed=15	sequence_number=16	rbr_only=yes	original_committed_timestamp=1789955089100704	immediate_commit_timestamp=1789955089100704	transaction_length=714
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955089100704 (2026-09-21 08:44:49.100704 SE Asia Standard Time)
# immediate_commit_timestamp=1789955089100704 (2026-09-21 08:44:49.100704 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955089100704*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 17444
#260921  8:44:49 server id 1  end_log_pos 17536 CRC32 0x8c361c37 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1789955089/*!*/;
BEGIN
/*!*/;
# at 17536
#260921  8:44:49 server id 1  end_log_pos 17624 CRC32 0x421698c5 	Table_map: `pln_up_imy`.`users` mapped to number 91
# at 17624
#260921  8:44:49 server id 1  end_log_pos 18048 CRC32 0xc6ae54f0 	Update_rows: table id 91 flags: STMT_END_F

BINLOG '
EYywahMBAAAAWAAAANhEAAAAAFsAAAAAAAMACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHgxZgWQg==
EYywah8BAAAAqAEAAIBGAAAAAFsAAAAAAAEAAgAM/////8AABAAAAAAAAAAFAEFkbWluDwBhZG1p
bkBnbWFpbC5jb20NAEFkbWluaXN0cmF0b3Jqpu8iPAAkMnkkMTIkT2N3UVlua0NzVEpvQVZ5SENH
VUFITzgvTm9kaWNDZGJObk1NU1Z1Z1JvMEhUdVlWaC9JRGk8AGNRSWswdnFtM1o0NjFXczM0akc5
dmJVQlhXMDBVUDhwYWM4NEk4NHl4MnJrZUZQNkJrZzZzZ2phcjB1cmqm7yJqqJFFAQAAAAAAAADA
AAQAAAAAAAAABQBBZG1pbg8AYWRtaW5AZ21haWwuY29tDQBBZG1pbmlzdHJhdG9yaqbvIjwAJDJ5
JDEyJE9jd1FZbmtDc1RKb0FWeUhDR1VBSE84L05vZGljQ2RiTm5NTVNWdWdSbzBIVHVZVmgvSURp
PABHNjdybm1welBhaTJCa3ZsY1ZUOHNObk5zZ1VobW9Db096SUdQR0RxZUdkNk94VHlSNklXZFpB
NE15SG9qpu8iaqiRRQEAAAAAAAAA8FSuxg==
'/*!*/;
# at 18048
#260921  8:44:49 server id 1  end_log_pos 18079 CRC32 0x6903c457 	Xid = 1190
COMMIT/*!*/;
# at 18079
#260921  8:44:49 server id 1  end_log_pos 18158 CRC32 0x0a0c1559 	Anonymous_GTID	last_committed=16	sequence_number=17	rbr_only=yes	original_committed_timestamp=1789955089132310	immediate_commit_timestamp=1789955089132310	transaction_length=834
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955089132310 (2026-09-21 08:44:49.132310 SE Asia Standard Time)
# immediate_commit_timestamp=1789955089132310 (2026-09-21 08:44:49.132310 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955089132310*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 18158
#260921  8:44:49 server id 1  end_log_pos 18239 CRC32 0x870205cc 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1789955089/*!*/;
BEGIN
/*!*/;
# at 18239
#260921  8:44:49 server id 1  end_log_pos 18313 CRC32 0x70393b87 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 18313
#260921  8:44:49 server id 1  end_log_pos 18882 CRC32 0xc1b2ae70 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
EYywahMBAAAASgAAAIlHAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ic7OXA=
EYywaiABAAAAOQIAAMJJAAAAAFMAAAAAAAEAAgAG/wAoAEkyR0VrbUZaY2F1ZEJwdTZzbjhFb21K
dlJDMlNFRUlqZE5iZGZQNHoEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNmABAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaU1FaHBla3BUT1cwM01IUndOVEppVVc1Sk1HdEdRbEZKUW1KNFRHSnlZMUZV
V0ZaVlRVOHdiaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
akU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9p
Sm9iMjFsSWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5BoewanCussE=
'/*!*/;
# at 18882
#260921  8:44:49 server id 1  end_log_pos 18913 CRC32 0xb6a7e50b 	Xid = 1193
COMMIT/*!*/;
# at 18913
#260921  8:44:49 server id 1  end_log_pos 18992 CRC32 0x0d776470 	Anonymous_GTID	last_committed=17	sequence_number=18	rbr_only=yes	original_committed_timestamp=1789955089397473	immediate_commit_timestamp=1789955089397473	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955089397473 (2026-09-21 08:44:49.397473 SE Asia Standard Time)
# immediate_commit_timestamp=1789955089397473 (2026-09-21 08:44:49.397473 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955089397473*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 18992
#260921  8:44:49 server id 1  end_log_pos 19073 CRC32 0xc14ea9d8 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1789955089/*!*/;
BEGIN
/*!*/;
# at 19073
#260921  8:44:49 server id 1  end_log_pos 19147 CRC32 0x5a04db39 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 19147
#260921  8:44:49 server id 1  end_log_pos 19516 CRC32 0x9ac141e5 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
EYywahMBAAAASgAAAMtKAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DnbBFo=
EYywah4BAAAAcQEAADxMAAAAAFMAAAAAAAEAAgAG/wIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNv
REdFQWxSczJjdkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lSWE5vVjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZT
TUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PRGMsGrlQcGa
'/*!*/;
# at 19516
#260921  8:44:49 server id 1  end_log_pos 19547 CRC32 0x97752e52 	Xid = 1199
COMMIT/*!*/;
# at 19547
#260921  8:44:50 server id 1  end_log_pos 19626 CRC32 0x9500631f 	Anonymous_GTID	last_committed=18	sequence_number=19	rbr_only=yes	original_committed_timestamp=1789955090696373	immediate_commit_timestamp=1789955090696373	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955090696373 (2026-09-21 08:44:50.696373 SE Asia Standard Time)
# immediate_commit_timestamp=1789955090696373 (2026-09-21 08:44:50.696373 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955090696373*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 19626
#260921  8:44:50 server id 1  end_log_pos 19716 CRC32 0x65f27558 	Query	thread_id=21	exec_time=0	error_code=0
SET TIMESTAMP=1789955090/*!*/;
BEGIN
/*!*/;
# at 19716
#260921  8:44:50 server id 1  end_log_pos 19790 CRC32 0x7836799e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 19790
#260921  8:44:50 server id 1  end_log_pos 20606 CRC32 0x9cd29c8a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
EoywahMBAAAASgAAAE5NAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4J55Nng=
Eoywah8BAAAAMAMAAH5QAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT0RjLBqAigAeWtnTWd5S1RpQWRPV3hqSDJ5UXA5M29ER0VBbFJz
MmN2SmtXRmpsawkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJY
Tm9WMWxZWjI0NVprNXJSMEpGY0hoc1oybDFhMUpQYWs1d1ptOTJiMDlQVjNwNFpXVlNNQ0k3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PRKMsGqKnNKc
'/*!*/;
# at 20606
#260921  8:44:50 server id 1  end_log_pos 20637 CRC32 0x130c84e1 	Xid = 1256
COMMIT/*!*/;
# at 20637
#260921  8:45:15 server id 1  end_log_pos 20716 CRC32 0x867cc9ea 	Anonymous_GTID	last_committed=19	sequence_number=20	rbr_only=yes	original_committed_timestamp=1789955115456987	immediate_commit_timestamp=1789955115456987	transaction_length=1262
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955115456987 (2026-09-21 08:45:15.456987 SE Asia Standard Time)
# immediate_commit_timestamp=1789955115456987 (2026-09-21 08:45:15.456987 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955115456987*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 20716
#260921  8:45:15 server id 1  end_log_pos 20806 CRC32 0xc0a0423b 	Query	thread_id=22	exec_time=0	error_code=0
SET TIMESTAMP=1789955115/*!*/;
BEGIN
/*!*/;
# at 20806
#260921  8:45:15 server id 1  end_log_pos 20880 CRC32 0xc6050994 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 20880
#260921  8:45:15 server id 1  end_log_pos 21868 CRC32 0x23cbed03 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
K4ywahMBAAAASgAAAJBRAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JQJBcY=
K4ywah8BAAAA3AMAAGxVAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09EoywagIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxSczJj
dkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzZMAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5v
VjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOVEk2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxXdGhiV2t2Y0hKdlptbHNMWEJs
Y25WellXaGhZVzRpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGM2SW5CeWIyWnBiQzF3WlhKMWMyRm9Z
V0Z1SWp0OWZRPT0rjLBqA+3LIw==
'/*!*/;
# at 21868
#260921  8:45:15 server id 1  end_log_pos 21899 CRC32 0x1d5e27b4 	Xid = 1313
COMMIT/*!*/;
# at 21899
#260921  8:45:37 server id 1  end_log_pos 21978 CRC32 0x53aa91b1 	Anonymous_GTID	last_committed=20	sequence_number=21	rbr_only=yes	original_committed_timestamp=1789955137291598	immediate_commit_timestamp=1789955137291598	transaction_length=1262
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955137291598 (2026-09-21 08:45:37.291598 SE Asia Standard Time)
# immediate_commit_timestamp=1789955137291598 (2026-09-21 08:45:37.291598 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955137291598*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 21978
#260921  8:45:37 server id 1  end_log_pos 22068 CRC32 0x84a1aee5 	Query	thread_id=23	exec_time=0	error_code=0
SET TIMESTAMP=1789955137/*!*/;
BEGIN
/*!*/;
# at 22068
#260921  8:45:37 server id 1  end_log_pos 22142 CRC32 0x0aba0ab8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 22142
#260921  8:45:37 server id 1  end_log_pos 23130 CRC32 0x738a030c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QYywahMBAAAASgAAAH5WAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LgKugo=
QYywah8BAAAA3AMAAFpaAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2TAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TlRJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmNI
SnZabWxzTFhCbGNuVnpZV2hoWVc0aU8zTTZOVG9pY205MWRHVWlPM002TVRjNkluQnliMlpwYkMx
d1pYSjFjMkZvWVdGdUlqdDlmUT09K4ywagIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxS
czJjdkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42
NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUz
LjAuMC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lS
WE5vVjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6
bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0
aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2
SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9i
MjFsSWp0OWZRPT1BjLBqDAOKcw==
'/*!*/;
# at 23130
#260921  8:45:37 server id 1  end_log_pos 23161 CRC32 0x42b6fafa 	Xid = 1370
COMMIT/*!*/;
# at 23161
#260921  8:49:12 server id 1  end_log_pos 23240 CRC32 0x522cba2b 	Anonymous_GTID	last_committed=21	sequence_number=22	rbr_only=yes	original_committed_timestamp=1789955352353721	immediate_commit_timestamp=1789955352353721	transaction_length=1266
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955352353721 (2026-09-21 08:49:12.353721 SE Asia Standard Time)
# immediate_commit_timestamp=1789955352353721 (2026-09-21 08:49:12.353721 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955352353721*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23240
#260921  8:49:12 server id 1  end_log_pos 23330 CRC32 0xfd90d5a6 	Query	thread_id=24	exec_time=0	error_code=0
SET TIMESTAMP=1789955352/*!*/;
BEGIN
/*!*/;
# at 23330
#260921  8:49:12 server id 1  end_log_pos 23404 CRC32 0x64ee0ba6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 23404
#260921  8:49:12 server id 1  end_log_pos 24396 CRC32 0x523496f9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
GI2wahMBAAAASgAAAGxbAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KYL7mQ=
GI2wah8BAAAA4AMAAExfAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09QYywagIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxSczJj
dkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzZQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5v
VjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOVFE2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxXdGhiV2t2YzNSeWRXdDBkWEl0
YjNKbllXNXBjMkZ6YVNJN2N6bzFPaUp5YjNWMFpTSTdjem94T1RvaWMzUnlkV3QwZFhJdGIzSm5Z
VzVwYzJGemFTSTdmWDA9GI2wavmWNFI=
'/*!*/;
# at 24396
#260921  8:49:12 server id 1  end_log_pos 24427 CRC32 0x0a688628 	Xid = 1427
COMMIT/*!*/;
# at 24427
#260921  8:49:23 server id 1  end_log_pos 24506 CRC32 0x5b570a48 	Anonymous_GTID	last_committed=22	sequence_number=23	rbr_only=yes	original_committed_timestamp=1789955363158820	immediate_commit_timestamp=1789955363158820	transaction_length=1290
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955363158820 (2026-09-21 08:49:23.158820 SE Asia Standard Time)
# immediate_commit_timestamp=1789955363158820 (2026-09-21 08:49:23.158820 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955363158820*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24506
#260921  8:49:23 server id 1  end_log_pos 24596 CRC32 0x56a876b6 	Query	thread_id=25	exec_time=0	error_code=0
SET TIMESTAMP=1789955363/*!*/;
BEGIN
/*!*/;
# at 24596
#260921  8:49:23 server id 1  end_log_pos 24670 CRC32 0x478c1001 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 24670
#260921  8:49:23 server id 1  end_log_pos 25686 CRC32 0xfac192ed 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
I42wahMBAAAASgAAAF5gAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AEQjEc=
I42wah8BAAAA+AMAAFZkAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2UAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TlRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmMz
UnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdjem8xT2lKeWIzVjBaU0k3Y3pveE9Ub2ljM1J5ZFd0
MGRYSXRiM0puWVc1cGMyRnphU0k3ZlgwPRiNsGoCKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkzb0RH
RUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsg
V2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21l
LzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2KAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBN
RG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldWU01D
STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFYUmhJ
anR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWDA9I42wau2Swfo=
'/*!*/;
# at 25686
#260921  8:49:23 server id 1  end_log_pos 25717 CRC32 0x314d798d 	Xid = 1490
COMMIT/*!*/;
# at 25717
#260921  8:49:32 server id 1  end_log_pos 25796 CRC32 0x3b886985 	Anonymous_GTID	last_committed=23	sequence_number=24	rbr_only=yes	original_committed_timestamp=1789955372257047	immediate_commit_timestamp=1789955372257047	transaction_length=1322
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955372257047 (2026-09-21 08:49:32.257047 SE Asia Standard Time)
# immediate_commit_timestamp=1789955372257047 (2026-09-21 08:49:32.257047 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955372257047*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25796
#260921  8:49:32 server id 1  end_log_pos 25886 CRC32 0xfb881973 	Query	thread_id=26	exec_time=0	error_code=0
SET TIMESTAMP=1789955372/*!*/;
BEGIN
/*!*/;
# at 25886
#260921  8:49:32 server id 1  end_log_pos 25960 CRC32 0x7e36a71a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 25960
#260921  8:49:32 server id 1  end_log_pos 27008 CRC32 0xc066d5b3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
LI2wahMBAAAASgAAAGhlAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BqnNn4=
LI2wah8BAAAAGAQAAIBpAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2KAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFY
UmhJanR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWDA9I42wagIoAHlrZ01neUtU
aUFkT1d4akgyeVFwOTNvREdFQWxSczJjdkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAo
V2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBs
aWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZwAQAAWVRvek9udHpPalk2
SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5vVjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXda
bTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8y
RTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpw
N2N6b3pPaUoxY213aU8zTTZPRFU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXBibVp2
Y20xaGMya3ZZbVZ5YVhSaEwzQmxiR0YwYVdoaGJpMXJNeTExYm5SMWF5MXJZWEo1WVhkaGJpMWlZ
WEoxTFdGdVoydGhkR0Z1TFRJd01qWWlPM002TlRvaWNtOTFkR1VpTzNNNk1UTTZJbUpsY21sMFlT
NWtaWFJoYVd3aU8zMTksjbBqs9VmwA==
'/*!*/;
# at 27008
#260921  8:49:32 server id 1  end_log_pos 27039 CRC32 0x7e6e69e6 	Xid = 1553
COMMIT/*!*/;
# at 27039
#260921  8:49:39 server id 1  end_log_pos 27118 CRC32 0x1ede9827 	Anonymous_GTID	last_committed=24	sequence_number=25	rbr_only=yes	original_committed_timestamp=1789955379628941	immediate_commit_timestamp=1789955379628941	transaction_length=1334
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955379628941 (2026-09-21 08:49:39.628941 SE Asia Standard Time)
# immediate_commit_timestamp=1789955379628941 (2026-09-21 08:49:39.628941 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955379628941*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27118
#260921  8:49:39 server id 1  end_log_pos 27208 CRC32 0x90f43e67 	Query	thread_id=27	exec_time=0	error_code=0
SET TIMESTAMP=1789955379/*!*/;
BEGIN
/*!*/;
# at 27208
#260921  8:49:39 server id 1  end_log_pos 27282 CRC32 0xdeb46a5e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 27282
#260921  8:49:39 server id 1  end_log_pos 28342 CRC32 0xc61be41b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
M42wahMBAAAASgAAAJJqAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4F5qtN4=
M42wah8BAAAAJAQAALZuAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2cAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002T0RVNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFY
UmhMM0JsYkdGMGFXaGhiaTFyTXkxMWJuUjFheTFyWVhKNVlYZGhiaTFpWVhKMUxXRnVaMnRoZEdG
dUxUSXdNallpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVE02SW1KbGNtbDBZUzVrWlhSaGFXd2lPMzE5
LI2wagIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxSczJjdkprV0ZqbGsJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzY0
AQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5vVjFsWVoyNDVaazVyUjBKRmNI
aHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpw
N2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOREk2SW1oMGRIQTZMeTh4TWpjdU1DNHdM
akU2T0RBd01DOXBibVp2Y20xaGMya3ZjR1Z1WjNWdGRXMWhiaUk3Y3pvMU9pSnliM1YwWlNJN2N6
b3hNRG9pY0dWdVozVnRkVzFoYmlJN2ZYMD0zjbBqG+Qbxg==
'/*!*/;
# at 28342
#260921  8:49:39 server id 1  end_log_pos 28373 CRC32 0x3b87bbfe 	Xid = 1616
COMMIT/*!*/;
# at 28373
#260921  8:49:52 server id 1  end_log_pos 28452 CRC32 0xe96e8fff 	Anonymous_GTID	last_committed=25	sequence_number=26	rbr_only=yes	original_committed_timestamp=1789955392440442	immediate_commit_timestamp=1789955392440442	transaction_length=838
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955392440442 (2026-09-21 08:49:52.440442 SE Asia Standard Time)
# immediate_commit_timestamp=1789955392440442 (2026-09-21 08:49:52.440442 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955392440442*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 28452
#260921  8:49:52 server id 1  end_log_pos 28533 CRC32 0x18b1a568 	Query	thread_id=28	exec_time=0	error_code=0
SET TIMESTAMP=1789955392/*!*/;
BEGIN
/*!*/;
# at 28533
#260921  8:49:52 server id 1  end_log_pos 28607 CRC32 0x165dd079 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 28607
#260921  8:49:52 server id 1  end_log_pos 29180 CRC32 0x0b3af035 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
QI2wahMBAAAASgAAAL9vAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HnQXRY=
QI2waiABAAAAPQIAAPxxAAAAAFMAAAAAAAEAAgAG/wAoADQ3NURySmltNUJaaVZWTVRKUDZQTlJz
T0VGblVjSXBoWkZOUE1JTzYKAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNmQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVpXeFZVbEUwWkdGUFNsQm1SbGhVY21kd1dubGtaR3BPWWt4RlEyNVJXVkZI
Y2xoNE1qRmlPQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
akU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9p
Sm9iMjFsSWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZNVEE3ZlE9PTqwrGo1
8DoL
'/*!*/;
# at 29180
#260921  8:49:52 server id 1  end_log_pos 29211 CRC32 0xf08e894e 	Xid = 1625
COMMIT/*!*/;
# at 29211
#260921  8:49:52 server id 1  end_log_pos 29290 CRC32 0x0b5aa9d0 	Anonymous_GTID	last_committed=26	sequence_number=27	rbr_only=yes	original_committed_timestamp=1789955392853765	immediate_commit_timestamp=1789955392853765	transaction_length=1278
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955392853765 (2026-09-21 08:49:52.853765 SE Asia Standard Time)
# immediate_commit_timestamp=1789955392853765 (2026-09-21 08:49:52.853765 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955392853765*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 29290
#260921  8:49:52 server id 1  end_log_pos 29380 CRC32 0xde35427b 	Query	thread_id=28	exec_time=0	error_code=0
SET TIMESTAMP=1789955392/*!*/;
BEGIN
/*!*/;
# at 29380
#260921  8:49:52 server id 1  end_log_pos 29454 CRC32 0x873d8200 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 29454
#260921  8:49:52 server id 1  end_log_pos 30458 CRC32 0xf79fedf8 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QI2wahMBAAAASgAAAA5zAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ACCPYc=
QI2wah8BAAAA7AMAAPp2AAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2NAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TkRJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2Y0dWdVoz
VnRkVzFoYmlJN2N6bzFPaUp5YjNWMFpTSTdjem94TURvaWNHVnVaM1Z0ZFcxaGJpSTdmWDA9M42w
agIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxSczJjdkprV0ZqbGsJMTI3LjAuMC4xbwBN
b3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81Mzcu
MzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzY4AQAA
WVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5vVjFsWVoyNDVaazVyUjBKRmNIaHNa
MmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6
b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1s
dmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNems2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2
T0RBd01DOXBibVp2Y20xaGMya3ZiR0Y1WVc1aGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pveE56b2lh
VzVtYjNKdFlYTnBMbXhoZVdGdVlXNGlPMzE5QI2wavjtn/c=
'/*!*/;
# at 30458
#260921  8:49:52 server id 1  end_log_pos 30489 CRC32 0x42328688 	Xid = 1676
COMMIT/*!*/;
# at 30489
#260921  8:53:34 server id 1  end_log_pos 30568 CRC32 0x49a5b83c 	Anonymous_GTID	last_committed=27	sequence_number=28	rbr_only=yes	original_committed_timestamp=1789955614222459	immediate_commit_timestamp=1789955614222459	transaction_length=1242
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955614222459 (2026-09-21 08:53:34.222459 SE Asia Standard Time)
# immediate_commit_timestamp=1789955614222459 (2026-09-21 08:53:34.222459 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955614222459*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30568
#260921  8:53:34 server id 1  end_log_pos 30658 CRC32 0xe7970a74 	Query	thread_id=29	exec_time=0	error_code=0
SET TIMESTAMP=1789955614/*!*/;
BEGIN
/*!*/;
# at 30658
#260921  8:53:34 server id 1  end_log_pos 30732 CRC32 0xd1f39a04 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 30732
#260921  8:53:34 server id 1  end_log_pos 31700 CRC32 0x2fd4626e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Ho6wahMBAAAASgAAAAx4AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ASa89E=
Ho6wah8BAAAAyAMAANR7AAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2OAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXprNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2YkdGNVlX
NWhiaUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pYVc1bWIzSnRZWE5wTG14aGVXRnVZVzRpTzMx
OUCNsGoCKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkzb0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAu
MW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQv
NTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2
EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZj
SGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldWU01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1q
cDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hK
bGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3
TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDlmUT09Ho6wam5i1C8=
'/*!*/;
# at 31700
#260921  8:53:34 server id 1  end_log_pos 31731 CRC32 0x43983a10 	Xid = 1733
COMMIT/*!*/;
# at 31731
#260921  8:59:51 server id 1  end_log_pos 31810 CRC32 0x27b93a9e 	Anonymous_GTID	last_committed=28	sequence_number=29	rbr_only=yes	original_committed_timestamp=1789955991098400	immediate_commit_timestamp=1789955991098400	transaction_length=1238
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789955991098400 (2026-09-21 08:59:51.098400 SE Asia Standard Time)
# immediate_commit_timestamp=1789955991098400 (2026-09-21 08:59:51.098400 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789955991098400*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 31810
#260921  8:59:51 server id 1  end_log_pos 31900 CRC32 0x5cad43c5 	Query	thread_id=30	exec_time=0	error_code=0
SET TIMESTAMP=1789955991/*!*/;
BEGIN
/*!*/;
# at 31900
#260921  8:59:51 server id 1  end_log_pos 31974 CRC32 0xcf2c1d8e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 31974
#260921  8:59:51 server id 1  end_log_pos 32938 CRC32 0x15960843 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
l4+wahMBAAAASgAAAOZ8AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4I4dLM8=
l4+wah8BAAAAxAMAAKqAAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09Ho6wagIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxSczJj
dkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzY0AQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5v
VjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOREU2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXJiMjUwWVdzdmFIVmlkVzVuYVMxcllXMXBJanR6
T2pVNkluSnZkWFJsSWp0ek9qRXlPaUpvZFdKMWJtZHBMV3RoYldraU8zMTmXj7BqQwiWFQ==
'/*!*/;
# at 32938
#260921  8:59:51 server id 1  end_log_pos 32969 CRC32 0xcaac3613 	Xid = 1790
COMMIT/*!*/;
# at 32969
#260921  9:02:55 server id 1  end_log_pos 33048 CRC32 0x6df7ccf1 	Anonymous_GTID	last_committed=29	sequence_number=30	rbr_only=yes	original_committed_timestamp=1789956175075086	immediate_commit_timestamp=1789956175075086	transaction_length=1254
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956175075086 (2026-09-21 09:02:55.075086 SE Asia Standard Time)
# immediate_commit_timestamp=1789956175075086 (2026-09-21 09:02:55.075086 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956175075086*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 33048
#260921  9:02:55 server id 1  end_log_pos 33138 CRC32 0x29a2c6fb 	Query	thread_id=31	exec_time=0	error_code=0
SET TIMESTAMP=1789956175/*!*/;
BEGIN
/*!*/;
# at 33138
#260921  9:02:55 server id 1  end_log_pos 33212 CRC32 0x6405f19b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 33212
#260921  9:02:55 server id 1  end_log_pos 34192 CRC32 0x202bd7a9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
T5CwahMBAAAASgAAALyBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JvxBWQ=
T5Cwah8BAAAA1AMAAJCFAAAAAFMAAAAAAAEAAgAG//8CKAB5a2dNZ3lLVGlBZE9XeGpIMnlRcDkz
b0RHRUFsUnMyY3ZKa1dGamxrCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2NAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUlhOb1YxbFlaMjQ1Wms1clIwSkZjSGhzWjJsMWExSlBhazV3Wm05MmIwOVBWM3A0WldW
U01DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFT
MXJZVzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzE5l4+w
agIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNvREdFQWxSczJjdkprV0ZqbGsJMTI3LjAuMC4xbwBN
b3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81Mzcu
MzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAA
WVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lSWE5vVjFsWVoyNDVaazVyUjBKRmNIaHNa
MmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZTTUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6
b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1s
dmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2
T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdm
WDA9T5CwaqnXKyA=
'/*!*/;
# at 34192
#260921  9:02:55 server id 1  end_log_pos 34223 CRC32 0xe7d99d74 	Xid = 1847
COMMIT/*!*/;
# at 34223
#260921  9:03:11 server id 1  end_log_pos 34302 CRC32 0x45064e63 	Anonymous_GTID	last_committed=30	sequence_number=31	rbr_only=yes	original_committed_timestamp=1789956191618471	immediate_commit_timestamp=1789956191618471	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956191618471 (2026-09-21 09:03:11.618471 SE Asia Standard Time)
# immediate_commit_timestamp=1789956191618471 (2026-09-21 09:03:11.618471 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956191618471*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 34302
#260921  9:03:11 server id 1  end_log_pos 34383 CRC32 0x4feac6b7 	Query	thread_id=32	exec_time=0	error_code=0
SET TIMESTAMP=1789956191/*!*/;
BEGIN
/*!*/;
# at 34383
#260921  9:03:11 server id 1  end_log_pos 34457 CRC32 0x7b63c43f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 34457
#260921  9:03:11 server id 1  end_log_pos 34954 CRC32 0x2a7aee25 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
X5CwahMBAAAASgAAAJmGAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4D/EY3s=
X5CwaiABAAAA8QEAAIqIAAAAAFMAAAAAAAEAAgAG/wIoAHlrZ01neUtUaUFkT1d4akgyeVFwOTNv
REdFQWxSczJjdkprV0ZqbGsJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lSWE5vVjFsWVoyNDVaazVyUjBKRmNIaHNaMmwxYTFKUGFrNXdabTkyYjA5UFYzcDRaV1ZT
TUNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8z
TTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pv
MU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9T5CwaiXueio=
'/*!*/;
# at 34954
#260921  9:03:11 server id 1  end_log_pos 34985 CRC32 0x2e598283 	Xid = 1859
COMMIT/*!*/;
# at 34985
#260921  9:03:11 server id 1  end_log_pos 35064 CRC32 0xe28275ab 	Anonymous_GTID	last_committed=31	sequence_number=32	rbr_only=yes	original_committed_timestamp=1789956191646477	immediate_commit_timestamp=1789956191646477	transaction_length=581
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956191646477 (2026-09-21 09:03:11.646477 SE Asia Standard Time)
# immediate_commit_timestamp=1789956191646477 (2026-09-21 09:03:11.646477 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956191646477*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 35064
#260921  9:03:11 server id 1  end_log_pos 35153 CRC32 0xab60e527 	Query	thread_id=32	exec_time=0	error_code=0
SET TIMESTAMP=1789956191/*!*/;
BEGIN
/*!*/;
# at 35153
#260921  9:03:11 server id 1  end_log_pos 35251 CRC32 0xadc5e0a9 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 92
# at 35251
#260921  9:03:11 server id 1  end_log_pos 35535 CRC32 0x902ae2d3 	Write_rows: table id 92 flags: STMT_END_F

BINLOG '
X5CwahMBAAAAYgAAALOJAAAAAFwAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4Kngxa0=
X5Cwah4BAAAAHAEAAM+KAAAAAFwAAAAAAAEAAgAN//8AAFAAAAAAAAAABAAAAAAAAAAFAEFkbWlu
DQBBZG1pbmlzdHJhdG9yCwBhdXRlbnRpa2FzaQUAbG9naW4eAG1lbGFrdWthbiBsb2dpbiBrZSBw
YW5lbCBhZG1pbg8AQXBwXE1vZGVsc1xVc2VyBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUu
MCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1M
LCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZqsC3varAt79PiKpA=
'/*!*/;
# at 35535
#260921  9:03:11 server id 1  end_log_pos 35566 CRC32 0x2291649d 	Xid = 1862
COMMIT/*!*/;
# at 35566
#260921  9:03:11 server id 1  end_log_pos 35645 CRC32 0x70a32c14 	Anonymous_GTID	last_committed=32	sequence_number=33	rbr_only=yes	original_committed_timestamp=1789956191670074	immediate_commit_timestamp=1789956191670074	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956191670074 (2026-09-21 09:03:11.670074 SE Asia Standard Time)
# immediate_commit_timestamp=1789956191670074 (2026-09-21 09:03:11.670074 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956191670074*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 35645
#260921  9:03:11 server id 1  end_log_pos 35726 CRC32 0xddad1f35 	Query	thread_id=32	exec_time=0	error_code=0
SET TIMESTAMP=1789956191/*!*/;
BEGIN
/*!*/;
# at 35726
#260921  9:03:11 server id 1  end_log_pos 35800 CRC32 0x78a1522d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 35800
#260921  9:03:11 server id 1  end_log_pos 36389 CRC32 0x0fa0c1fb 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
X5CwahMBAAAASgAAANiLAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4C1SoXg=
X5Cwah4BAAAATQIAACWOAAAAAFMAAAAAAAEAAgAG/wAoAGRVeDI4T1U3OWVZdmNpVjBCQ1RRQ0pv
SDFhYlZzc1JHYlNibWVmeW4EAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVJYRTFVazVpZEhwRmNuWXlRM1pwV1ROQllXSnJNR3hsWW1ab2MwNUZhR1p5
ZWpoR1JWbFhjU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT1fkLBq+8GgDw==
'/*!*/;
# at 36389
#260921  9:03:11 server id 1  end_log_pos 36420 CRC32 0xefc85f62 	Xid = 1868
COMMIT/*!*/;
# at 36420
#260921  9:03:13 server id 1  end_log_pos 36499 CRC32 0x57cbbbd9 	Anonymous_GTID	last_committed=33	sequence_number=34	rbr_only=yes	original_committed_timestamp=1789956193946877	immediate_commit_timestamp=1789956193946877	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956193946877 (2026-09-21 09:03:13.946877 SE Asia Standard Time)
# immediate_commit_timestamp=1789956193946877 (2026-09-21 09:03:13.946877 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956193946877*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 36499
#260921  9:03:13 server id 1  end_log_pos 36589 CRC32 0x128c247e 	Query	thread_id=33	exec_time=0	error_code=0
SET TIMESTAMP=1789956193/*!*/;
BEGIN
/*!*/;
# at 36589
#260921  9:03:13 server id 1  end_log_pos 36663 CRC32 0x97979a99 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 36663
#260921  9:03:13 server id 1  end_log_pos 37827 CRC32 0xf216c9b1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
YZCwahMBAAAASgAAADePAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Jmal5c=
YZCwah8BAAAAjAQAAMOTAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09X5CwagAoAGRVeDI4T1U3OWVZdmNpVjBCQ1RRQ0pvSDFhYlZzc1JHYlNibWVm
eW4EAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJY
RTFVazVpZEhwRmNuWXlRM1pwV1ROQllXSnJNR3hsWW1ab2MwNUZhR1p5ZWpoR1JWbFhjU0k3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5U
b2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PWGQsGqxyRby
'/*!*/;
# at 37827
#260921  9:03:13 server id 1  end_log_pos 37858 CRC32 0xa1458f98 	Xid = 2057
COMMIT/*!*/;
# at 37858
#260921  9:05:20 server id 1  end_log_pos 37937 CRC32 0x99361a03 	Anonymous_GTID	last_committed=34	sequence_number=35	rbr_only=yes	original_committed_timestamp=1789956320631760	immediate_commit_timestamp=1789956320631760	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956320631760 (2026-09-21 09:05:20.631760 SE Asia Standard Time)
# immediate_commit_timestamp=1789956320631760 (2026-09-21 09:05:20.631760 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956320631760*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 37937
#260921  9:05:20 server id 1  end_log_pos 38027 CRC32 0xb5439e4d 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789956320/*!*/;
BEGIN
/*!*/;
# at 38027
#260921  9:05:20 server id 1  end_log_pos 38101 CRC32 0x81dae578 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 38101
#260921  9:05:20 server id 1  end_log_pos 39281 CRC32 0x7963b583 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4JCwahMBAAAASgAAANWUAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Hjl2oE=
4JCwah8BAAAAnAQAAHGZAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1hkLBqACgAZFV4MjhPVTc5ZVl2Y2lWMEJD
VFFDSm9IMWFiVnNzUkdiU2JtZWZ5bgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUlhFMVVrNWlkSHBGY25ZeVEzWnBXVE5CWVdKck1HeGxZbVpvYzA1
RmFHWnllamhHUlZsWGNTSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OTFjMlZ5Y3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhn
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD3gkLBqg7VjeQ==
'/*!*/;
# at 39281
#260921  9:05:20 server id 1  end_log_pos 39312 CRC32 0xa89f4577 	Xid = 2180
COMMIT/*!*/;
# at 39312
#260921  9:05:59 server id 1  end_log_pos 39391 CRC32 0x11506411 	Anonymous_GTID	last_committed=35	sequence_number=36	rbr_only=yes	original_committed_timestamp=1789956359087010	immediate_commit_timestamp=1789956359087010	transaction_length=1482
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956359087010 (2026-09-21 09:05:59.087010 SE Asia Standard Time)
# immediate_commit_timestamp=1789956359087010 (2026-09-21 09:05:59.087010 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956359087010*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 39391
#260921  9:05:59 server id 1  end_log_pos 39481 CRC32 0x234a1579 	Query	thread_id=35	exec_time=0	error_code=0
SET TIMESTAMP=1789956359/*!*/;
BEGIN
/*!*/;
# at 39481
#260921  9:05:59 server id 1  end_log_pos 39555 CRC32 0x96b2468c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 39555
#260921  9:05:59 server id 1  end_log_pos 40763 CRC32 0x34df28ed 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
B5GwahMBAAAASgAAAIOaAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IxGspY=
B5Gwah8BAAAAuAQAADufAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPeCQsGoAKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzakAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOVFE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2YzNSeWRXdDBkWEl0YjNKbllXNXBjMkZ6YVNJN2N6bzFPaUp5YjNWMFpTSTdjem94T1Rv
aWMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0po
TXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdm
UT09B5Gwau0o3zQ=
'/*!*/;
# at 40763
#260921  9:05:59 server id 1  end_log_pos 40794 CRC32 0x8e6bde13 	Xid = 2243
COMMIT/*!*/;
# at 40794
#260921  9:08:53 server id 1  end_log_pos 40873 CRC32 0xac49e5b1 	Anonymous_GTID	last_committed=36	sequence_number=37	rbr_only=yes	original_committed_timestamp=1789956533672495	immediate_commit_timestamp=1789956533672495	transaction_length=1486
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956533672495 (2026-09-21 09:08:53.672495 SE Asia Standard Time)
# immediate_commit_timestamp=1789956533672495 (2026-09-21 09:08:53.672495 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956533672495*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 40873
#260921  9:08:53 server id 1  end_log_pos 40963 CRC32 0x7921ecbd 	Query	thread_id=36	exec_time=0	error_code=0
SET TIMESTAMP=1789956533/*!*/;
BEGIN
/*!*/;
# at 40963
#260921  9:08:53 server id 1  end_log_pos 41037 CRC32 0x17e9370f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 41037
#260921  9:08:53 server id 1  end_log_pos 42249 CRC32 0xc7a0ecab 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
tZGwahMBAAAASgAAAE2gAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4A836Rc=
tZGwah8BAAAAvAQAAAmlAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzakAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOVFE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2YzNSeWRXdDBkWEl0YjNKbllXNXBjMkZ6YVNJN2N6bzFPaUp5YjNWMFpTSTdjem94T1Rv
aWMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0po
TXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdm
UT09B5GwagAoAGRVeDI4T1U3OWVZdmNpVjBCQ1RRQ0pvSDFhYlZzc1JHYlNibWVmeW4EAAAAAAAA
AAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFw
cGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2Fm
YXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVJYRTFVazVpZEhw
RmNuWXlRM1pwV1ROQllXSnJNR3hsWW1ab2MwNUZhR1p5ZWpoR1JWbFhjU0k3Y3pvMk9pSmZabXho
YzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTlj
em81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5ERTZJbWgwZEhBNkx5
OHhNamN1TUM0d0xqRTZPREF3TUM5cmIyNTBZV3N2YUhWaWRXNW5hUzFyWVcxcElqdHpPalU2SW5K
dmRYUmxJanR6T2pFeU9pSm9kV0oxYm1kcExXdGhiV2tpTzMxek9qVXdPaUpzYjJkcGJsOTNaV0pm
TlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdh
VG8wTzMwPbWRsGqr7KDH
'/*!*/;
# at 42249
#260921  9:08:53 server id 1  end_log_pos 42280 CRC32 0xcb9dffd6 	Xid = 2303
COMMIT/*!*/;
# at 42280
#260921  9:11:45 server id 1  end_log_pos 42359 CRC32 0x584ff402 	Anonymous_GTID	last_committed=37	sequence_number=38	rbr_only=yes	original_committed_timestamp=1789956705493464	immediate_commit_timestamp=1789956705493464	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789956705493464 (2026-09-21 09:11:45.493464 SE Asia Standard Time)
# immediate_commit_timestamp=1789956705493464 (2026-09-21 09:11:45.493464 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789956705493464*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 42359
#260921  9:11:45 server id 1  end_log_pos 42449 CRC32 0x210dd8ad 	Query	thread_id=37	exec_time=0	error_code=0
SET TIMESTAMP=1789956705/*!*/;
BEGIN
/*!*/;
# at 42449
#260921  9:11:45 server id 1  end_log_pos 42523 CRC32 0x17d4059f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 42523
#260921  9:11:45 server id 1  end_log_pos 43703 CRC32 0x70669a97 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
YZKwahMBAAAASgAAABumAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4J8F1Bc=
YZKwah8BAAAAnAQAALeqAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXJiMjUwWVdzdmFI
VmlkVzVuYVMxcllXMXBJanR6T2pVNkluSnZkWFJsSWp0ek9qRXlPaUpvZFdKMWJtZHBMV3RoYldr
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD21kbBqACgAZFV4MjhPVTc5ZVl2Y2lWMEJD
VFFDSm9IMWFiVnNzUkdiU2JtZWZ5bgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUlhFMVVrNWlkSHBGY25ZeVEzWnBXVE5CWVdKck1HeGxZbVpvYzA1
RmFHWnllamhHUlZsWGNTSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlzWVhsaGJt
RnVMMlJoWm5SaGNpSTdjem8xT2lKeWIzVjBaU0k3Y3pveE5Eb2liR0Y1WVc1aGJpNWtZV1owWVhJ
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD1hkrBql5pmcA==
'/*!*/;
# at 43703
#260921  9:11:45 server id 1  end_log_pos 43734 CRC32 0xe706b72b 	Xid = 2363
COMMIT/*!*/;
# at 43734
#260921  9:22:56 server id 1  end_log_pos 43813 CRC32 0x92507e50 	Anonymous_GTID	last_committed=38	sequence_number=39	rbr_only=yes	original_committed_timestamp=1789957376947494	immediate_commit_timestamp=1789957376947494	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789957376947494 (2026-09-21 09:22:56.947494 SE Asia Standard Time)
# immediate_commit_timestamp=1789957376947494 (2026-09-21 09:22:56.947494 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789957376947494*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 43813
#260921  9:22:56 server id 1  end_log_pos 43903 CRC32 0x8899eb97 	Query	thread_id=38	exec_time=0	error_code=0
SET TIMESTAMP=1789957376/*!*/;
BEGIN
/*!*/;
# at 43903
#260921  9:22:56 server id 1  end_log_pos 43977 CRC32 0x52f1fb87 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 43977
#260921  9:22:56 server id 1  end_log_pos 45153 CRC32 0x06955956 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
AJWwahMBAAAASgAAAMmrAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4If78VI=
AJWwah8BAAAAmAQAAGGwAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXNZWGxoYm1GdUwy
UmhablJoY2lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaWJHRjVZVzVoYmk1a1lXWjBZWElpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPWGSsGoAKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXNZWGxoYm1GdUwy
UmhablJoY2lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaWJHRjVZVzVoYmk1a1lXWjBZWElpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQCVsGpWWZUG
'/*!*/;
# at 45153
#260921  9:22:56 server id 1  end_log_pos 45184 CRC32 0x0f8ce883 	Xid = 2489
COMMIT/*!*/;
# at 45184
#260921  9:22:57 server id 1  end_log_pos 45263 CRC32 0x1e802e90 	Anonymous_GTID	last_committed=39	sequence_number=40	rbr_only=yes	original_committed_timestamp=1789957377881624	immediate_commit_timestamp=1789957377881624	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789957377881624 (2026-09-21 09:22:57.881624 SE Asia Standard Time)
# immediate_commit_timestamp=1789957377881624 (2026-09-21 09:22:57.881624 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789957377881624*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 45263
#260921  9:22:57 server id 1  end_log_pos 45353 CRC32 0x8299efce 	Query	thread_id=39	exec_time=0	error_code=0
SET TIMESTAMP=1789957377/*!*/;
BEGIN
/*!*/;
# at 45353
#260921  9:22:57 server id 1  end_log_pos 45427 CRC32 0x3b201ceb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 45427
#260921  9:22:57 server id 1  end_log_pos 46607 CRC32 0xec336613 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
AZWwahMBAAAASgAAAHOxAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OscIDs=
AZWwah8BAAAAnAQAAA+2AAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXNZWGxoYm1GdUwy
UmhablJoY2lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaWJHRjVZVzVoYmk1a1lXWjBZWElpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQCVsGoAKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0BlbBqE2Yz7A==
'/*!*/;
# at 46607
#260921  9:22:57 server id 1  end_log_pos 46638 CRC32 0xd607a1a3 	Xid = 2678
COMMIT/*!*/;
# at 46638
#260921  9:35:49 server id 1  end_log_pos 46717 CRC32 0x2dd963e2 	Anonymous_GTID	last_committed=40	sequence_number=41	rbr_only=yes	original_committed_timestamp=1789958149227165	immediate_commit_timestamp=1789958149227165	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789958149227165 (2026-09-21 09:35:49.227165 SE Asia Standard Time)
# immediate_commit_timestamp=1789958149227165 (2026-09-21 09:35:49.227165 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789958149227165*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 46717
#260921  9:35:49 server id 1  end_log_pos 46807 CRC32 0xd3d00d4d 	Query	thread_id=40	exec_time=0	error_code=0
SET TIMESTAMP=1789958149/*!*/;
BEGIN
/*!*/;
# at 46807
#260921  9:35:49 server id 1  end_log_pos 46881 CRC32 0x1d53ecd3 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 46881
#260921  9:35:49 server id 1  end_log_pos 48065 CRC32 0xf1cf3aca 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BZiwahMBAAAASgAAACG3AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NPsUx0=
BZiwah8BAAAAoAQAAMG7AAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0BlbBqACgAZFV4MjhPVTc5ZVl2Y2lWMEJD
VFFDSm9IMWFiVnNzUkdiU2JtZWZ5bgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUlhFMVVrNWlkSHBGY25ZeVEzWnBXVE5CWVdKck1HeGxZbVpvYzA1
RmFHWnllamhHUlZsWGNTSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09BZiwaso6z/E=
'/*!*/;
# at 48065
#260921  9:35:49 server id 1  end_log_pos 48096 CRC32 0x3865763d 	Xid = 2801
COMMIT/*!*/;
# at 48096
#260921  9:36:03 server id 1  end_log_pos 48175 CRC32 0xf63411e2 	Anonymous_GTID	last_committed=41	sequence_number=42	rbr_only=yes	original_committed_timestamp=1789958163870816	immediate_commit_timestamp=1789958163870816	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789958163870816 (2026-09-21 09:36:03.870816 SE Asia Standard Time)
# immediate_commit_timestamp=1789958163870816 (2026-09-21 09:36:03.870816 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789958163870816*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 48175
#260921  9:36:03 server id 1  end_log_pos 48265 CRC32 0x848c7096 	Query	thread_id=41	exec_time=0	error_code=0
SET TIMESTAMP=1789958163/*!*/;
BEGIN
/*!*/;
# at 48265
#260921  9:36:03 server id 1  end_log_pos 48339 CRC32 0xf1170c1b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 48339
#260921  9:36:03 server id 1  end_log_pos 49523 CRC32 0x1f15ac96 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
E5iwahMBAAAASgAAANO8AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BsMF/E=
E5iwah8BAAAAoAQAAHPBAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0FmLBqACgAZFV4MjhPVTc5ZVl2Y2lWMEJD
VFFDSm9IMWFiVnNzUkdiU2JtZWZ5bgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUlhFMVVrNWlkSHBGY25ZeVEzWnBXVE5CWVdKck1HeGxZbVpvYzA1
RmFHWnllamhHUlZsWGNTSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09E5iwapasFR8=
'/*!*/;
# at 49523
#260921  9:36:03 server id 1  end_log_pos 49554 CRC32 0x43104771 	Xid = 2924
COMMIT/*!*/;
# at 49554
#260921 10:10:56 server id 1  end_log_pos 49633 CRC32 0xca0eecbd 	Anonymous_GTID	last_committed=42	sequence_number=43	rbr_only=yes	original_committed_timestamp=1789960256252759	immediate_commit_timestamp=1789960256252759	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789960256252759 (2026-09-21 10:10:56.252759 SE Asia Standard Time)
# immediate_commit_timestamp=1789960256252759 (2026-09-21 10:10:56.252759 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789960256252759*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 49633
#260921 10:10:56 server id 1  end_log_pos 49723 CRC32 0x9257b9fd 	Query	thread_id=42	exec_time=0	error_code=0
SET TIMESTAMP=1789960256/*!*/;
BEGIN
/*!*/;
# at 49723
#260921 10:10:56 server id 1  end_log_pos 49797 CRC32 0xd1056574 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 49797
#260921 10:10:56 server id 1  end_log_pos 50941 CRC32 0x5b3c79fb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QKCwahMBAAAASgAAAIXCAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HRlBdE=
QKCwah8BAAAAeAQAAP3GAAAAAFMAAAAAAAEAAgAG//8AKABkVXgyOE9VNzllWXZjaVYwQkNUUUNK
b0gxYWJWc3NSR2JTYm1lZnluBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lSWEUxVWs1aWRIcEZjbll5UTNacFdUTkJZV0pyTUd4bFltWm9jMDVGYUda
eWVqaEdSVmxYY1NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT0TmLBqACgAZFV4MjhPVTc5ZVl2Y2lWMEJD
VFFDSm9IMWFiVnNzUkdiU2JtZWZ5bgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUlhFMVVrNWlkSHBGY25ZeVEzWnBXVE5CWVdKck1HeGxZbVpvYzA1
RmFHWnllamhHUlZsWGNTSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9p
SnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDlAoLBq
+3k8Ww==
'/*!*/;
# at 50941
#260921 10:10:56 server id 1  end_log_pos 50972 CRC32 0x6a1c80f5 	Xid = 2984
COMMIT/*!*/;
# at 50972
#260921 11:14:47 server id 1  end_log_pos 51051 CRC32 0x5ab3953d 	Anonymous_GTID	last_committed=43	sequence_number=44	rbr_only=no	original_committed_timestamp=1789964087488504	immediate_commit_timestamp=1789964087488504	transaction_length=508
# original_commit_timestamp=1789964087488504 (2026-09-21 11:14:47.488504 SE Asia Standard Time)
# immediate_commit_timestamp=1789964087488504 (2026-09-21 11:14:47.488504 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964087488504*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 51051
#260921 11:14:47 server id 1  end_log_pos 51480 CRC32 0x27452efc 	Query	thread_id=43	exec_time=0	error_code=0	Xid = 2999
use `pln_up_imy_testing`/*!*/;
SET TIMESTAMP=1789964087/*!*/;
SET @@session.pseudo_thread_id=43/*!*/;
SET @@session.foreign_key_checks=0/*!*/;
DROP TABLE `activity_logs`,`announcements`,`cache`,`cache_locks`,`contact_messages`,`failed_jobs`,`galleries`,`job_batches`,`jobs`,`menus`,`migrations`,`news`,`page_role`,`page_sections`,`pages`,`password_reset_tokens`,`permissions`,`role_permission`,`role_user`,`roles`,`sessions`,`users` /* generated by server */
/*!*/;
# at 51480
#260921 11:14:48 server id 1  end_log_pos 51559 CRC32 0xadb71a22 	Anonymous_GTID	last_committed=44	sequence_number=45	rbr_only=no	original_committed_timestamp=1789964088312637	immediate_commit_timestamp=1789964088312637	transaction_length=392
# original_commit_timestamp=1789964088312637 (2026-09-21 11:14:48.312637 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088312637 (2026-09-21 11:14:48.312637 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088312637*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 51559
#260921 11:14:48 server id 1  end_log_pos 51872 CRC32 0x4d5e5741 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3014
SET TIMESTAMP=1789964088/*!*/;
SET @@session.foreign_key_checks=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `migrations` (`id` int unsigned not null auto_increment primary key, `migration` varchar(255) not null, `batch` int not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 51872
#260921 11:14:48 server id 1  end_log_pos 51951 CRC32 0xcf2d4400 	Anonymous_GTID	last_committed=45	sequence_number=46	rbr_only=no	original_committed_timestamp=1789964088493675	immediate_commit_timestamp=1789964088493675	transaction_length=560
# original_commit_timestamp=1789964088493675 (2026-09-21 11:14:48.493675 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088493675 (2026-09-21 11:14:48.493675 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088493675*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 51951
#260921 11:14:48 server id 1  end_log_pos 52432 CRC32 0xa691095a 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3029
SET TIMESTAMP=1789964088/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 52432
#260921 11:14:48 server id 1  end_log_pos 52511 CRC32 0xb45acf0b 	Anonymous_GTID	last_committed=46	sequence_number=47	rbr_only=no	original_committed_timestamp=1789964088522866	immediate_commit_timestamp=1789964088522866	transaction_length=255
# original_commit_timestamp=1789964088522866 (2026-09-21 11:14:48.522866 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088522866 (2026-09-21 11:14:48.522866 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088522866*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 52511
#260921 11:14:48 server id 1  end_log_pos 52687 CRC32 0x418f99d1 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3032
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add unique `users_email_unique`(`email`)
/*!*/;
# at 52687
#260921 11:14:48 server id 1  end_log_pos 52766 CRC32 0xe2d346a3 	Anonymous_GTID	last_committed=47	sequence_number=48	rbr_only=no	original_committed_timestamp=1789964088542164	immediate_commit_timestamp=1789964088542164	transaction_length=407
# original_commit_timestamp=1789964088542164 (2026-09-21 11:14:48.542164 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088542164 (2026-09-21 11:14:48.542164 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088542164*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 52766
#260921 11:14:48 server id 1  end_log_pos 53094 CRC32 0xe1fcfa46 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3035
SET TIMESTAMP=1789964088/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `password_reset_tokens` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null, primary key (`email`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 53094
#260921 11:14:48 server id 1  end_log_pos 53173 CRC32 0x06ede589 	Anonymous_GTID	last_committed=48	sequence_number=49	rbr_only=no	original_committed_timestamp=1789964088583117	immediate_commit_timestamp=1789964088583117	transaction_length=472
# original_commit_timestamp=1789964088583117 (2026-09-21 11:14:48.583117 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088583117 (2026-09-21 11:14:48.583117 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088583117*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 53173
#260921 11:14:48 server id 1  end_log_pos 53566 CRC32 0x14b85e4c 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3038
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `sessions` (`id` varchar(255) not null, `user_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` text null, `payload` longtext not null, `last_activity` int not null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 53566
#260921 11:14:48 server id 1  end_log_pos 53645 CRC32 0x936e5d25 	Anonymous_GTID	last_committed=49	sequence_number=50	rbr_only=no	original_committed_timestamp=1789964088609572	immediate_commit_timestamp=1789964088609572	transaction_length=263
# original_commit_timestamp=1789964088609572 (2026-09-21 11:14:48.609572 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088609572 (2026-09-21 11:14:48.609572 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088609572*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 53645
#260921 11:14:48 server id 1  end_log_pos 53829 CRC32 0x48132c1c 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3041
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `sessions` add index `sessions_user_id_index`(`user_id`)
/*!*/;
# at 53829
#260921 11:14:48 server id 1  end_log_pos 53908 CRC32 0xdbaaf8b9 	Anonymous_GTID	last_committed=50	sequence_number=51	rbr_only=no	original_committed_timestamp=1789964088629830	immediate_commit_timestamp=1789964088629830	transaction_length=275
# original_commit_timestamp=1789964088629830 (2026-09-21 11:14:48.629830 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088629830 (2026-09-21 11:14:48.629830 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088629830*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 53908
#260921 11:14:48 server id 1  end_log_pos 54104 CRC32 0x57d117fc 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3044
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `sessions` add index `sessions_last_activity_index`(`last_activity`)
/*!*/;
# at 54104
#260921 11:14:48 server id 1  end_log_pos 54183 CRC32 0xc0af0cdb 	Anonymous_GTID	last_committed=51	sequence_number=52	rbr_only=yes	original_committed_timestamp=1789964088661165	immediate_commit_timestamp=1789964088661165	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964088661165 (2026-09-21 11:14:48.661165 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088661165 (2026-09-21 11:14:48.661165 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088661165*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54183
#260921 11:14:48 server id 1  end_log_pos 54272 CRC32 0xf4792ea8 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964088/*!*/;
BEGIN
/*!*/;
# at 54272
#260921 11:14:48 server id 1  end_log_pos 54349 CRC32 0x8cef574e 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 54349
#260921 11:14:48 server id 1  end_log_pos 54431 CRC32 0xbeca8551 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
OK+wahMBAAAATQAAAE3UAAAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4E5X74w=
OK+wah4BAAAAUgAAAJ/UAAAAAGUAAAAAAAEAAgAD/wABAAAAJAAwMDAxXzAxXzAxXzAwMDAwMF9j
cmVhdGVfdXNlcnNfdGFibGUBAAAAUYXKvg==
'/*!*/;
# at 54431
#260921 11:14:48 server id 1  end_log_pos 54462 CRC32 0x33431fcd 	Xid = 3047
COMMIT/*!*/;
# at 54462
#260921 11:14:48 server id 1  end_log_pos 54541 CRC32 0x7fff942c 	Anonymous_GTID	last_committed=52	sequence_number=53	rbr_only=no	original_committed_timestamp=1789964088683073	immediate_commit_timestamp=1789964088683073	transaction_length=381
# original_commit_timestamp=1789964088683073 (2026-09-21 11:14:48.683073 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088683073 (2026-09-21 11:14:48.683073 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088683073*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54541
#260921 11:14:48 server id 1  end_log_pos 54843 CRC32 0x86fd01e7 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3050
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `cache` (`key` varchar(255) not null, `value` mediumtext not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 54843
#260921 11:14:48 server id 1  end_log_pos 54922 CRC32 0xdc6abd2b 	Anonymous_GTID	last_committed=53	sequence_number=54	rbr_only=no	original_committed_timestamp=1789964088718289	immediate_commit_timestamp=1789964088718289	transaction_length=263
# original_commit_timestamp=1789964088718289 (2026-09-21 11:14:48.718289 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088718289 (2026-09-21 11:14:48.718289 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088718289*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54922
#260921 11:14:48 server id 1  end_log_pos 55106 CRC32 0xd6d8d5ea 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3053
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `cache` add index `cache_expiration_index`(`expiration`)
/*!*/;
# at 55106
#260921 11:14:48 server id 1  end_log_pos 55185 CRC32 0x758021ff 	Anonymous_GTID	last_committed=54	sequence_number=55	rbr_only=no	original_committed_timestamp=1789964088743154	immediate_commit_timestamp=1789964088743154	transaction_length=389
# original_commit_timestamp=1789964088743154 (2026-09-21 11:14:48.743154 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088743154 (2026-09-21 11:14:48.743154 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088743154*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 55185
#260921 11:14:48 server id 1  end_log_pos 55495 CRC32 0x66a8b5f4 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3056
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `cache_locks` (`key` varchar(255) not null, `owner` varchar(255) not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 55495
#260921 11:14:48 server id 1  end_log_pos 55574 CRC32 0xdee3ca29 	Anonymous_GTID	last_committed=55	sequence_number=56	rbr_only=no	original_committed_timestamp=1789964088801916	immediate_commit_timestamp=1789964088801916	transaction_length=275
# original_commit_timestamp=1789964088801916 (2026-09-21 11:14:48.801916 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088801916 (2026-09-21 11:14:48.801916 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088801916*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 55574
#260921 11:14:48 server id 1  end_log_pos 55770 CRC32 0xa91395ee 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3059
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `cache_locks` add index `cache_locks_expiration_index`(`expiration`)
/*!*/;
# at 55770
#260921 11:14:48 server id 1  end_log_pos 55849 CRC32 0x63dbd1b8 	Anonymous_GTID	last_committed=56	sequence_number=57	rbr_only=yes	original_committed_timestamp=1789964088809964	immediate_commit_timestamp=1789964088809964	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964088809964 (2026-09-21 11:14:48.809964 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088809964 (2026-09-21 11:14:48.809964 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088809964*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 55849
#260921 11:14:48 server id 1  end_log_pos 55938 CRC32 0xc87e4403 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964088/*!*/;
BEGIN
/*!*/;
# at 55938
#260921 11:14:48 server id 1  end_log_pos 56015 CRC32 0x4b7cf4a4 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 56015
#260921 11:14:48 server id 1  end_log_pos 56097 CRC32 0x81ffeecd 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
OK+wahMBAAAATQAAAM/aAAAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4KT0fEs=
OK+wah4BAAAAUgAAACHbAAAAAGUAAAAAAAEAAgAD/wACAAAAJAAwMDAxXzAxXzAxXzAwMDAwMV9j
cmVhdGVfY2FjaGVfdGFibGUBAAAAze7/gQ==
'/*!*/;
# at 56097
#260921 11:14:48 server id 1  end_log_pos 56128 CRC32 0x06a5f26a 	Xid = 3062
COMMIT/*!*/;
# at 56128
#260921 11:14:48 server id 1  end_log_pos 56207 CRC32 0x31fdcb6f 	Anonymous_GTID	last_committed=57	sequence_number=58	rbr_only=no	original_committed_timestamp=1789964088842916	immediate_commit_timestamp=1789964088842916	transaction_length=537
# original_commit_timestamp=1789964088842916 (2026-09-21 11:14:48.842916 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088842916 (2026-09-21 11:14:48.842916 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088842916*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 56207
#260921 11:14:48 server id 1  end_log_pos 56665 CRC32 0x0f1128aa 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3065
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `jobs` (`id` bigint unsigned not null auto_increment primary key, `queue` varchar(255) not null, `payload` longtext not null, `attempts` tinyint unsigned not null, `reserved_at` int unsigned null, `available_at` int unsigned not null, `created_at` int unsigned not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 56665
#260921 11:14:48 server id 1  end_log_pos 56742 CRC32 0xfafd2190 	Anonymous_GTID	last_committed=58	sequence_number=59	rbr_only=no	original_committed_timestamp=1789964088884588	immediate_commit_timestamp=1789964088884588	transaction_length=249
# original_commit_timestamp=1789964088884588 (2026-09-21 11:14:48.884588 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088884588 (2026-09-21 11:14:48.884588 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088884588*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 56742
#260921 11:14:48 server id 1  end_log_pos 56914 CRC32 0x141e28ed 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3068
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `jobs` add index `jobs_queue_index`(`queue`)
/*!*/;
# at 56914
#260921 11:14:48 server id 1  end_log_pos 56993 CRC32 0xd0004942 	Anonymous_GTID	last_committed=59	sequence_number=60	rbr_only=no	original_committed_timestamp=1789964088912706	immediate_commit_timestamp=1789964088912706	transaction_length=582
# original_commit_timestamp=1789964088912706 (2026-09-21 11:14:48.912706 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088912706 (2026-09-21 11:14:48.912706 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088912706*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 56993
#260921 11:14:48 server id 1  end_log_pos 57496 CRC32 0x32f2f909 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3071
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `job_batches` (`id` varchar(255) not null, `name` varchar(255) not null, `total_jobs` int not null, `pending_jobs` int not null, `failed_jobs` int not null, `failed_job_ids` longtext not null, `options` mediumtext null, `cancelled_at` int null, `created_at` int not null, `finished_at` int null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 57496
#260921 11:14:48 server id 1  end_log_pos 57575 CRC32 0xcc79d011 	Anonymous_GTID	last_committed=60	sequence_number=61	rbr_only=no	original_committed_timestamp=1789964088958095	immediate_commit_timestamp=1789964088958095	transaction_length=540
# original_commit_timestamp=1789964088958095 (2026-09-21 11:14:48.958095 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088958095 (2026-09-21 11:14:48.958095 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088958095*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 57575
#260921 11:14:48 server id 1  end_log_pos 58036 CRC32 0xdcf1d94c 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3074
SET TIMESTAMP=1789964088/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `failed_jobs` (`id` bigint unsigned not null auto_increment primary key, `uuid` varchar(255) not null, `connection` text not null, `queue` text not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp not null default CURRENT_TIMESTAMP) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 58036
#260921 11:14:48 server id 1  end_log_pos 58115 CRC32 0xdb8c7269 	Anonymous_GTID	last_committed=61	sequence_number=62	rbr_only=no	original_committed_timestamp=1789964088976323	immediate_commit_timestamp=1789964088976323	transaction_length=265
# original_commit_timestamp=1789964088976323 (2026-09-21 11:14:48.976323 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088976323 (2026-09-21 11:14:48.976323 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088976323*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 58115
#260921 11:14:48 server id 1  end_log_pos 58301 CRC32 0x4cd61f94 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3077
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `failed_jobs` add unique `failed_jobs_uuid_unique`(`uuid`)
/*!*/;
# at 58301
#260921 11:14:48 server id 1  end_log_pos 58380 CRC32 0x3cfceed0 	Anonymous_GTID	last_committed=62	sequence_number=63	rbr_only=yes	original_committed_timestamp=1789964088981214	immediate_commit_timestamp=1789964088981214	transaction_length=357
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964088981214 (2026-09-21 11:14:48.981214 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088981214 (2026-09-21 11:14:48.981214 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088981214*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 58380
#260921 11:14:48 server id 1  end_log_pos 58469 CRC32 0x2a6c0397 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964088/*!*/;
BEGIN
/*!*/;
# at 58469
#260921 11:14:48 server id 1  end_log_pos 58546 CRC32 0x8b05ee9b 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 58546
#260921 11:14:48 server id 1  end_log_pos 58627 CRC32 0x940fbbdd 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
OK+wahMBAAAATQAAALLkAAAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4JvuBYs=
OK+wah4BAAAAUQAAAAPlAAAAAGUAAAAAAAEAAgAD/wADAAAAIwAwMDAxXzAxXzAxXzAwMDAwMl9j
cmVhdGVfam9ic190YWJsZQEAAADduw+U
'/*!*/;
# at 58627
#260921 11:14:48 server id 1  end_log_pos 58658 CRC32 0xb9cf6087 	Xid = 3080
COMMIT/*!*/;
# at 58658
#260921 11:14:48 server id 1  end_log_pos 58737 CRC32 0x0f50f17d 	Anonymous_GTID	last_committed=63	sequence_number=64	rbr_only=no	original_committed_timestamp=1789964088992317	immediate_commit_timestamp=1789964088992317	transaction_length=276
# original_commit_timestamp=1789964088992317 (2026-09-21 11:14:48.992317 SE Asia Standard Time)
# immediate_commit_timestamp=1789964088992317 (2026-09-21 11:14:48.992317 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964088992317*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 58737
#260921 11:14:48 server id 1  end_log_pos 58934 CRC32 0x552af7b8 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3083
SET TIMESTAMP=1789964088/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `role` varchar(255) not null default 'user' after `email`
/*!*/;
# at 58934
#260921 11:14:49 server id 1  end_log_pos 59013 CRC32 0xf3a0bcdd 	Anonymous_GTID	last_committed=64	sequence_number=65	rbr_only=no	original_committed_timestamp=1789964089024830	immediate_commit_timestamp=1789964089024830	transaction_length=260
# original_commit_timestamp=1789964089024830 (2026-09-21 11:14:49.024830 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089024830 (2026-09-21 11:14:49.024830 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089024830*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 59013
#260921 11:14:49 server id 1  end_log_pos 59194 CRC32 0xdaced1f1 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3086
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `no_hp` varchar(20) null after `password`
/*!*/;
# at 59194
#260921 11:14:49 server id 1  end_log_pos 59271 CRC32 0xc9a1c604 	Anonymous_GTID	last_committed=65	sequence_number=66	rbr_only=no	original_committed_timestamp=1789964089042338	immediate_commit_timestamp=1789964089042338	transaction_length=249
# original_commit_timestamp=1789964089042338 (2026-09-21 11:14:49.042338 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089042338 (2026-09-21 11:14:49.042338 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089042338*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 59271
#260921 11:14:49 server id 1  end_log_pos 59443 CRC32 0x9ed22456 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3089
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `alamat` text null after `no_hp`
/*!*/;
# at 59443
#260921 11:14:49 server id 1  end_log_pos 59522 CRC32 0x105ad174 	Anonymous_GTID	last_committed=66	sequence_number=67	rbr_only=yes	original_committed_timestamp=1789964089053266	immediate_commit_timestamp=1789964089053266	transaction_length=378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964089053266 (2026-09-21 11:14:49.053266 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089053266 (2026-09-21 11:14:49.053266 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089053266*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 59522
#260921 11:14:49 server id 1  end_log_pos 59611 CRC32 0x2c07e0cb 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964089/*!*/;
BEGIN
/*!*/;
# at 59611
#260921 11:14:49 server id 1  end_log_pos 59688 CRC32 0xfb84a46a 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 59688
#260921 11:14:49 server id 1  end_log_pos 59790 CRC32 0xbfcd3761 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oa+wahMBAAAATQAAACjpAAAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4GqkhPs=
Oa+wah4BAAAAZgAAAI7pAAAAAGUAAAAAAAEAAgAD/wAEAAAAOAAyMDI2XzA5XzA5XzAyMDUxNF9h
ZGRfdXNlcl9wcm9maWxlX2ZpZWxkc190b191c2Vyc190YWJsZQEAAABhN82/
'/*!*/;
# at 59790
#260921 11:14:49 server id 1  end_log_pos 59821 CRC32 0xb30abd4d 	Xid = 3092
COMMIT/*!*/;
# at 59821
#260921 11:14:49 server id 1  end_log_pos 59900 CRC32 0xaeb547ce 	Anonymous_GTID	last_committed=67	sequence_number=68	rbr_only=no	original_committed_timestamp=1789964089073061	immediate_commit_timestamp=1789964089073061	transaction_length=498
# original_commit_timestamp=1789964089073061 (2026-09-21 11:14:49.073061 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089073061 (2026-09-21 11:14:49.073061 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089073061*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 59900
#260921 11:14:49 server id 1  end_log_pos 60319 CRC32 0xd1abad57 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3095
SET TIMESTAMP=1789964089/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `roles` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(100) not null, `description` varchar(255) null, `status` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 60319
#260921 11:14:49 server id 1  end_log_pos 60398 CRC32 0x80723f6d 	Anonymous_GTID	last_committed=68	sequence_number=69	rbr_only=no	original_committed_timestamp=1789964089102910	immediate_commit_timestamp=1789964089102910	transaction_length=253
# original_commit_timestamp=1789964089102910 (2026-09-21 11:14:49.102910 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089102910 (2026-09-21 11:14:49.102910 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089102910*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 60398
#260921 11:14:49 server id 1  end_log_pos 60572 CRC32 0xe1b70584 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3098
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `roles` add unique `roles_name_unique`(`name`)
/*!*/;
# at 60572
#260921 11:14:49 server id 1  end_log_pos 60651 CRC32 0x30c35b7e 	Anonymous_GTID	last_committed=69	sequence_number=70	rbr_only=no	original_committed_timestamp=1789964089179291	immediate_commit_timestamp=1789964089179291	transaction_length=491
# original_commit_timestamp=1789964089179291 (2026-09-21 11:14:49.179291 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089179291 (2026-09-21 11:14:49.179291 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089179291*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 60651
#260921 11:14:49 server id 1  end_log_pos 61063 CRC32 0xae143ed7 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3101
SET TIMESTAMP=1789964089/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `permissions` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(100) not null, `display_name` varchar(255) null, `module` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 61063
#260921 11:14:49 server id 1  end_log_pos 61142 CRC32 0x94789711 	Anonymous_GTID	last_committed=70	sequence_number=71	rbr_only=no	original_committed_timestamp=1789964089200448	immediate_commit_timestamp=1789964089200448	transaction_length=265
# original_commit_timestamp=1789964089200448 (2026-09-21 11:14:49.200448 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089200448 (2026-09-21 11:14:49.200448 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089200448*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 61142
#260921 11:14:49 server id 1  end_log_pos 61328 CRC32 0xf1dc8a45 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3104
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `permissions` add unique `permissions_name_unique`(`name`)
/*!*/;
# at 61328
#260921 11:14:49 server id 1  end_log_pos 61407 CRC32 0x5077e3b7 	Anonymous_GTID	last_committed=71	sequence_number=72	rbr_only=no	original_committed_timestamp=1789964089283422	immediate_commit_timestamp=1789964089283422	transaction_length=481
# original_commit_timestamp=1789964089283422 (2026-09-21 11:14:49.283422 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089283422 (2026-09-21 11:14:49.283422 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089283422*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 61407
#260921 11:14:49 server id 1  end_log_pos 61809 CRC32 0xb385eb6d 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3107
SET TIMESTAMP=1789964089/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `role_permission` (`id` bigint unsigned not null auto_increment primary key, `role_id` bigint unsigned not null, `permission_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 61809
#260921 11:14:49 server id 1  end_log_pos 61888 CRC32 0x361f678a 	Anonymous_GTID	last_committed=72	sequence_number=73	rbr_only=no	original_committed_timestamp=1789964089372917	immediate_commit_timestamp=1789964089372917	transaction_length=341
# original_commit_timestamp=1789964089372917 (2026-09-21 11:14:49.372917 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089372917 (2026-09-21 11:14:49.372917 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089372917*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 61888
#260921 11:14:49 server id 1  end_log_pos 62150 CRC32 0x48885734 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3110
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add constraint `role_permission_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 62150
#260921 11:14:49 server id 1  end_log_pos 62229 CRC32 0x8afcf755 	Anonymous_GTID	last_committed=73	sequence_number=74	rbr_only=no	original_committed_timestamp=1789964089439336	immediate_commit_timestamp=1789964089439336	transaction_length=359
# original_commit_timestamp=1789964089439336 (2026-09-21 11:14:49.439336 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089439336 (2026-09-21 11:14:49.439336 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089439336*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 62229
#260921 11:14:49 server id 1  end_log_pos 62509 CRC32 0x4286026d 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3113
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add constraint `role_permission_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade
/*!*/;
# at 62509
#260921 11:14:49 server id 1  end_log_pos 62588 CRC32 0xf56682fd 	Anonymous_GTID	last_committed=74	sequence_number=75	rbr_only=no	original_committed_timestamp=1789964089469953	immediate_commit_timestamp=1789964089469953	transaction_length=310
# original_commit_timestamp=1789964089469953 (2026-09-21 11:14:49.469953 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089469953 (2026-09-21 11:14:49.469953 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089469953*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 62588
#260921 11:14:49 server id 1  end_log_pos 62819 CRC32 0xc69399f5 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3116
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add unique `role_permission_role_id_permission_id_unique`(`role_id`, `permission_id`)
/*!*/;
# at 62819
#260921 11:14:49 server id 1  end_log_pos 62898 CRC32 0x9d67575a 	Anonymous_GTID	last_committed=75	sequence_number=76	rbr_only=no	original_committed_timestamp=1789964089491788	immediate_commit_timestamp=1789964089491788	transaction_length=469
# original_commit_timestamp=1789964089491788 (2026-09-21 11:14:49.491788 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089491788 (2026-09-21 11:14:49.491788 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089491788*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 62898
#260921 11:14:49 server id 1  end_log_pos 63288 CRC32 0xa2aa27e3 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3119
SET TIMESTAMP=1789964089/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `role_user` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `role_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 63288
#260921 11:14:49 server id 1  end_log_pos 63367 CRC32 0x5de891d4 	Anonymous_GTID	last_committed=76	sequence_number=77	rbr_only=no	original_committed_timestamp=1789964089583821	immediate_commit_timestamp=1789964089583821	transaction_length=329
# original_commit_timestamp=1789964089583821 (2026-09-21 11:14:49.583821 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089583821 (2026-09-21 11:14:49.583821 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089583821*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 63367
#260921 11:14:49 server id 1  end_log_pos 63617 CRC32 0x0d65663d 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3122
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add constraint `role_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade
/*!*/;
# at 63617
#260921 11:14:49 server id 1  end_log_pos 63696 CRC32 0x41841b8f 	Anonymous_GTID	last_committed=77	sequence_number=78	rbr_only=no	original_committed_timestamp=1789964089649565	immediate_commit_timestamp=1789964089649565	transaction_length=329
# original_commit_timestamp=1789964089649565 (2026-09-21 11:14:49.649565 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089649565 (2026-09-21 11:14:49.649565 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089649565*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 63696
#260921 11:14:49 server id 1  end_log_pos 63946 CRC32 0x21d3c1f0 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3125
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add constraint `role_user_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 63946
#260921 11:14:49 server id 1  end_log_pos 64025 CRC32 0x5072b85f 	Anonymous_GTID	last_committed=78	sequence_number=79	rbr_only=no	original_committed_timestamp=1789964089693142	immediate_commit_timestamp=1789964089693142	transaction_length=286
# original_commit_timestamp=1789964089693142 (2026-09-21 11:14:49.693142 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089693142 (2026-09-21 11:14:49.693142 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089693142*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 64025
#260921 11:14:49 server id 1  end_log_pos 64232 CRC32 0x081824c3 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3128
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add unique `role_user_user_id_role_id_unique`(`user_id`, `role_id`)
/*!*/;
# at 64232
#260921 11:14:49 server id 1  end_log_pos 64311 CRC32 0x0aa12987 	Anonymous_GTID	last_committed=79	sequence_number=80	rbr_only=yes	original_committed_timestamp=1789964089701068	immediate_commit_timestamp=1789964089701068	transaction_length=371
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964089701068 (2026-09-21 11:14:49.701068 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089701068 (2026-09-21 11:14:49.701068 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089701068*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 64311
#260921 11:14:49 server id 1  end_log_pos 64400 CRC32 0x38245f98 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964089/*!*/;
BEGIN
/*!*/;
# at 64400
#260921 11:14:49 server id 1  end_log_pos 64477 CRC32 0xc4e3e695 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 64477
#260921 11:14:49 server id 1  end_log_pos 64572 CRC32 0xea02581e 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oa+wahMBAAAATQAAAN37AAAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4JXm48Q=
Oa+wah4BAAAAXwAAADz8AAAAAGUAAAAAAAEAAgAD/wAFAAAAMQAyMDI2XzA5XzEwXzAwMDAwMV9j
cmVhdGVfcm9sZXNfcGVybWlzc2lvbnNfdGFibGVzAQAAAB5YAuo=
'/*!*/;
# at 64572
#260921 11:14:49 server id 1  end_log_pos 64603 CRC32 0xabaacf6f 	Xid = 3131
COMMIT/*!*/;
# at 64603
#260921 11:14:49 server id 1  end_log_pos 64680 CRC32 0xcfb526d1 	Anonymous_GTID	last_committed=80	sequence_number=81	rbr_only=no	original_committed_timestamp=1789964089725711	immediate_commit_timestamp=1789964089725711	transaction_length=247
# original_commit_timestamp=1789964089725711 (2026-09-21 11:14:49.725711 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089725711 (2026-09-21 11:14:49.725711 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089725711*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 64680
#260921 11:14:49 server id 1  end_log_pos 64850 CRC32 0x57af573b 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3134
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `role_id` bigint unsigned null
/*!*/;
# at 64850
#260921 11:14:49 server id 1  end_log_pos 64929 CRC32 0x578e8d08 	Anonymous_GTID	last_committed=81	sequence_number=82	rbr_only=no	original_committed_timestamp=1789964089798878	immediate_commit_timestamp=1789964089798878	transaction_length=322
# original_commit_timestamp=1789964089798878 (2026-09-21 11:14:49.798878 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089798878 (2026-09-21 11:14:49.798878 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089798878*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 64929
#260921 11:14:49 server id 1  end_log_pos 65172 CRC32 0xbb4d6e29 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3137
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add constraint `users_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete set null
/*!*/;
# at 65172
#260921 11:14:49 server id 1  end_log_pos 65251 CRC32 0x51c26736 	Anonymous_GTID	last_committed=82	sequence_number=83	rbr_only=yes	original_committed_timestamp=1789964089811685	immediate_commit_timestamp=1789964089811685	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964089811685 (2026-09-21 11:14:49.811685 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089811685 (2026-09-21 11:14:49.811685 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089811685*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 65251
#260921 11:14:49 server id 1  end_log_pos 65340 CRC32 0x35c937e7 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964089/*!*/;
BEGIN
/*!*/;
# at 65340
#260921 11:14:49 server id 1  end_log_pos 65417 CRC32 0x50a25179 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 65417
#260921 11:14:49 server id 1  end_log_pos 65507 CRC32 0x11986401 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oa+wahMBAAAATQAAAIn/AAAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4HlRolA=
Oa+wah4BAAAAWgAAAOP/AAAAAGUAAAAAAAEAAgAD/wAGAAAALAAyMDI2XzA5XzEwXzAwMDAwMl9h
ZGRfcm9sZV9pZF90b191c2Vyc190YWJsZQEAAAABZJgR
'/*!*/;
# at 65507
#260921 11:14:49 server id 1  end_log_pos 65538 CRC32 0x4c06d489 	Xid = 3140
COMMIT/*!*/;
# at 65538
#260921 11:14:49 server id 1  end_log_pos 65617 CRC32 0x4259fad8 	Anonymous_GTID	last_committed=83	sequence_number=84	rbr_only=no	original_committed_timestamp=1789964089839980	immediate_commit_timestamp=1789964089839980	transaction_length=747
# original_commit_timestamp=1789964089839980 (2026-09-21 11:14:49.839980 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089839980 (2026-09-21 11:14:49.839980 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089839980*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 65617
#260921 11:14:49 server id 1  end_log_pos 66285 CRC32 0xd78d1fa3 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3146
SET TIMESTAMP=1789964089/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `news` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `category` enum('umum', 'teknis', 'kegiatan', 'kepegawaian') not null, `excerpt` text not null, `content` longtext null, `image` varchar(255) null, `author` varchar(255) null, `is_published` tinyint(1) not null default '0', `published_at` timestamp null, `author_user_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 66285
#260921 11:14:49 server id 1  end_log_pos 66364 CRC32 0x650a6a72 	Anonymous_GTID	last_committed=84	sequence_number=85	rbr_only=no	original_committed_timestamp=1789964089925387	immediate_commit_timestamp=1789964089925387	transaction_length=334
# original_commit_timestamp=1789964089925387 (2026-09-21 11:14:49.925387 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089925387 (2026-09-21 11:14:49.925387 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089925387*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 66364
#260921 11:14:49 server id 1  end_log_pos 66619 CRC32 0xdb5a7fdc 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3149
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add constraint `news_author_user_id_foreign` foreign key (`author_user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 66619
#260921 11:14:49 server id 1  end_log_pos 66698 CRC32 0x57491590 	Anonymous_GTID	last_committed=85	sequence_number=86	rbr_only=no	original_committed_timestamp=1789964089969401	immediate_commit_timestamp=1789964089969401	transaction_length=265
# original_commit_timestamp=1789964089969401 (2026-09-21 11:14:49.969401 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089969401 (2026-09-21 11:14:49.969401 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089969401*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 66698
#260921 11:14:49 server id 1  end_log_pos 66884 CRC32 0xea971a57 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3152
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_is_published_index`(`is_published`)
/*!*/;
# at 66884
#260921 11:14:49 server id 1  end_log_pos 66963 CRC32 0xb8d7e02d 	Anonymous_GTID	last_committed=86	sequence_number=87	rbr_only=no	original_committed_timestamp=1789964089993064	immediate_commit_timestamp=1789964089993064	transaction_length=257
# original_commit_timestamp=1789964089993064 (2026-09-21 11:14:49.993064 SE Asia Standard Time)
# immediate_commit_timestamp=1789964089993064 (2026-09-21 11:14:49.993064 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964089993064*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 66963
#260921 11:14:49 server id 1  end_log_pos 67141 CRC32 0xd64916e7 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3155
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_category_index`(`category`)
/*!*/;
# at 67141
#260921 11:14:49 server id 1  end_log_pos 67220 CRC32 0xdd21b75a 	Anonymous_GTID	last_committed=87	sequence_number=88	rbr_only=no	original_committed_timestamp=1789964090017737	immediate_commit_timestamp=1789964090017737	transaction_length=265
# original_commit_timestamp=1789964090017737 (2026-09-21 11:14:50.017737 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090017737 (2026-09-21 11:14:50.017737 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090017737*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 67220
#260921 11:14:49 server id 1  end_log_pos 67406 CRC32 0x6fe0ab40 	Query	thread_id=44	exec_time=1	error_code=0	Xid = 3158
SET TIMESTAMP=1789964089/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_published_at_index`(`published_at`)
/*!*/;
# at 67406
#260921 11:14:50 server id 1  end_log_pos 67483 CRC32 0x549e0c8f 	Anonymous_GTID	last_committed=88	sequence_number=89	rbr_only=no	original_committed_timestamp=1789964090046353	immediate_commit_timestamp=1789964090046353	transaction_length=249
# original_commit_timestamp=1789964090046353 (2026-09-21 11:14:50.046353 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090046353 (2026-09-21 11:14:50.046353 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090046353*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 67483
#260921 11:14:50 server id 1  end_log_pos 67655 CRC32 0xcc044d71 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3161
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add unique `news_slug_unique`(`slug`)
/*!*/;
# at 67655
#260921 11:14:50 server id 1  end_log_pos 67734 CRC32 0x0eb3c280 	Anonymous_GTID	last_committed=89	sequence_number=90	rbr_only=yes	original_committed_timestamp=1789964090053471	immediate_commit_timestamp=1789964090053471	transaction_length=357
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964090053471 (2026-09-21 11:14:50.053471 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090053471 (2026-09-21 11:14:50.053471 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090053471*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 67734
#260921 11:14:50 server id 1  end_log_pos 67823 CRC32 0x4da9a949 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964090/*!*/;
BEGIN
/*!*/;
# at 67823
#260921 11:14:50 server id 1  end_log_pos 67900 CRC32 0xf10d2a38 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 67900
#260921 11:14:50 server id 1  end_log_pos 67981 CRC32 0x2e9adf0f 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oq+wahMBAAAATQAAADwJAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4DgqDfE=
Oq+wah4BAAAAUQAAAI0JAQAAAGUAAAAAAAEAAgAD/wAHAAAAIwAyMDI2XzA5XzExXzAwMDAwMV9j
cmVhdGVfbmV3c190YWJsZQEAAAAP35ou
'/*!*/;
# at 67981
#260921 11:14:50 server id 1  end_log_pos 68012 CRC32 0x52d51b86 	Xid = 3164
COMMIT/*!*/;
# at 68012
#260921 11:14:50 server id 1  end_log_pos 68091 CRC32 0xd8c0418d 	Anonymous_GTID	last_committed=90	sequence_number=91	rbr_only=yes	original_committed_timestamp=1789964090068765	immediate_commit_timestamp=1789964090068765	transaction_length=368
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964090068765 (2026-09-21 11:14:50.068765 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090068765 (2026-09-21 11:14:50.068765 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090068765*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 68091
#260921 11:14:50 server id 1  end_log_pos 68180 CRC32 0xed8aa525 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964090/*!*/;
BEGIN
/*!*/;
# at 68180
#260921 11:14:50 server id 1  end_log_pos 68257 CRC32 0x3fb2a6c4 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 68257
#260921 11:14:50 server id 1  end_log_pos 68349 CRC32 0x602e6603 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oq+wahMBAAAATQAAAKEKAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4MSmsj8=
Oq+wah4BAAAAXAAAAP0KAQAAAGUAAAAAAAEAAgAD/wAIAAAALgAyMDI2XzA5XzExXzAwMDAwMl9h
ZGRfdGltZXN0YW1wc190b19uZXdzX3RhYmxlAQAAAANmLmA=
'/*!*/;
# at 68349
#260921 11:14:50 server id 1  end_log_pos 68380 CRC32 0x80ae4dcd 	Xid = 3173
COMMIT/*!*/;
# at 68380
#260921 11:14:50 server id 1  end_log_pos 68459 CRC32 0x024b461d 	Anonymous_GTID	last_committed=91	sequence_number=92	rbr_only=no	original_committed_timestamp=1789964090090145	immediate_commit_timestamp=1789964090090145	transaction_length=712
# original_commit_timestamp=1789964090090145 (2026-09-21 11:14:50.090145 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090090145 (2026-09-21 11:14:50.090145 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090090145*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 68459
#260921 11:14:50 server id 1  end_log_pos 69092 CRC32 0x30219e7e 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3176
SET TIMESTAMP=1789964090/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `announcements` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `category` enum('umum', 'teknis', 'kepegawaian', 'keuangan', 'layanan') not null, `excerpt` text not null, `content` longtext null, `is_published` tinyint(1) not null default '0', `published_at` timestamp null, `author_user_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 69092
#260921 11:14:50 server id 1  end_log_pos 69171 CRC32 0x4dc6d2b0 	Anonymous_GTID	last_committed=92	sequence_number=93	rbr_only=no	original_committed_timestamp=1789964090157793	immediate_commit_timestamp=1789964090157793	transaction_length=352
# original_commit_timestamp=1789964090157793 (2026-09-21 11:14:50.157793 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090157793 (2026-09-21 11:14:50.157793 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090157793*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 69171
#260921 11:14:50 server id 1  end_log_pos 69444 CRC32 0x4b8b649c 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3179
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add constraint `announcements_author_user_id_foreign` foreign key (`author_user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 69444
#260921 11:14:50 server id 1  end_log_pos 69523 CRC32 0xbb811524 	Anonymous_GTID	last_committed=93	sequence_number=94	rbr_only=no	original_committed_timestamp=1789964090186348	immediate_commit_timestamp=1789964090186348	transaction_length=283
# original_commit_timestamp=1789964090186348 (2026-09-21 11:14:50.186348 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090186348 (2026-09-21 11:14:50.186348 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090186348*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 69523
#260921 11:14:50 server id 1  end_log_pos 69727 CRC32 0xecd66dc9 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3182
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_is_published_index`(`is_published`)
/*!*/;
# at 69727
#260921 11:14:50 server id 1  end_log_pos 69806 CRC32 0x594b8c15 	Anonymous_GTID	last_committed=94	sequence_number=95	rbr_only=no	original_committed_timestamp=1789964090211018	immediate_commit_timestamp=1789964090211018	transaction_length=275
# original_commit_timestamp=1789964090211018 (2026-09-21 11:14:50.211018 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090211018 (2026-09-21 11:14:50.211018 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090211018*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 69806
#260921 11:14:50 server id 1  end_log_pos 70002 CRC32 0x10d09401 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3185
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_category_index`(`category`)
/*!*/;
# at 70002
#260921 11:14:50 server id 1  end_log_pos 70081 CRC32 0x7e19aed1 	Anonymous_GTID	last_committed=95	sequence_number=96	rbr_only=no	original_committed_timestamp=1789964090232750	immediate_commit_timestamp=1789964090232750	transaction_length=283
# original_commit_timestamp=1789964090232750 (2026-09-21 11:14:50.232750 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090232750 (2026-09-21 11:14:50.232750 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090232750*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 70081
#260921 11:14:50 server id 1  end_log_pos 70285 CRC32 0x8b8feeb2 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3188
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_published_at_index`(`published_at`)
/*!*/;
# at 70285
#260921 11:14:50 server id 1  end_log_pos 70364 CRC32 0xe5a4fd1a 	Anonymous_GTID	last_committed=96	sequence_number=97	rbr_only=no	original_committed_timestamp=1789964090254382	immediate_commit_timestamp=1789964090254382	transaction_length=269
# original_commit_timestamp=1789964090254382 (2026-09-21 11:14:50.254382 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090254382 (2026-09-21 11:14:50.254382 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090254382*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 70364
#260921 11:14:50 server id 1  end_log_pos 70554 CRC32 0x45ca646b 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3191
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add unique `announcements_slug_unique`(`slug`)
/*!*/;
# at 70554
#260921 11:14:50 server id 1  end_log_pos 70633 CRC32 0x1f89ed58 	Anonymous_GTID	last_committed=97	sequence_number=98	rbr_only=yes	original_committed_timestamp=1789964090259935	immediate_commit_timestamp=1789964090259935	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964090259935 (2026-09-21 11:14:50.259935 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090259935 (2026-09-21 11:14:50.259935 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090259935*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 70633
#260921 11:14:50 server id 1  end_log_pos 70722 CRC32 0x47c3aaad 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964090/*!*/;
BEGIN
/*!*/;
# at 70722
#260921 11:14:50 server id 1  end_log_pos 70799 CRC32 0x48883956 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 70799
#260921 11:14:50 server id 1  end_log_pos 70889 CRC32 0x4f814f80 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oq+wahMBAAAATQAAAI8UAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4FY5iEg=
Oq+wah4BAAAAWgAAAOkUAQAAAGUAAAAAAAEAAgAD/wAJAAAALAAyMDI2XzA5XzE0XzAwMDAwMV9j
cmVhdGVfYW5ub3VuY2VtZW50c190YWJsZQEAAACAT4FP
'/*!*/;
# at 70889
#260921 11:14:50 server id 1  end_log_pos 70920 CRC32 0x14ca7757 	Xid = 3194
COMMIT/*!*/;
# at 70920
#260921 11:14:50 server id 1  end_log_pos 70999 CRC32 0xd1ba8927 	Anonymous_GTID	last_committed=98	sequence_number=99	rbr_only=no	original_committed_timestamp=1789964090278792	immediate_commit_timestamp=1789964090278792	transaction_length=720
# original_commit_timestamp=1789964090278792 (2026-09-21 11:14:50.278792 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090278792 (2026-09-21 11:14:50.278792 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090278792*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 70999
#260921 11:14:50 server id 1  end_log_pos 71640 CRC32 0xdfb2a8d0 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3197
SET TIMESTAMP=1789964090/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `activity_logs` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned null, `user_name` varchar(255) null, `user_role` varchar(255) null, `module` varchar(255) not null, `action` varchar(255) not null, `description` text not null, `subject_type` varchar(255) null, `subject_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` varchar(500) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 71640
#260921 11:14:50 server id 1  end_log_pos 71719 CRC32 0x4e907cde 	Anonymous_GTID	last_committed=99	sequence_number=100	rbr_only=no	original_committed_timestamp=1789964090348932	immediate_commit_timestamp=1789964090348932	transaction_length=338
# original_commit_timestamp=1789964090348932 (2026-09-21 11:14:50.348932 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090348932 (2026-09-21 11:14:50.348932 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090348932*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 71719
#260921 11:14:50 server id 1  end_log_pos 71978 CRC32 0xec550a63 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3200
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add constraint `activity_logs_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 71978
#260921 11:14:50 server id 1  end_log_pos 72057 CRC32 0x973a35fa 	Anonymous_GTID	last_committed=100	sequence_number=101	rbr_only=no	original_committed_timestamp=1789964090393135	immediate_commit_timestamp=1789964090393135	transaction_length=279
# original_commit_timestamp=1789964090393135 (2026-09-21 11:14:50.393135 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090393135 (2026-09-21 11:14:50.393135 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090393135*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 72057
#260921 11:14:50 server id 1  end_log_pos 72257 CRC32 0xee4b1434 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3203
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_created_at_index`(`created_at`)
/*!*/;
# at 72257
#260921 11:14:50 server id 1  end_log_pos 72336 CRC32 0x45d291a9 	Anonymous_GTID	last_committed=101	sequence_number=102	rbr_only=no	original_committed_timestamp=1789964090415340	immediate_commit_timestamp=1789964090415340	transaction_length=288
# original_commit_timestamp=1789964090415340 (2026-09-21 11:14:50.415340 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090415340 (2026-09-21 11:14:50.415340 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090415340*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 72336
#260921 11:14:50 server id 1  end_log_pos 72545 CRC32 0xaa0c234a 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3206
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_action_index`(`module`, `action`)
/*!*/;
# at 72545
#260921 11:14:50 server id 1  end_log_pos 72624 CRC32 0x3e032df2 	Anonymous_GTID	last_committed=102	sequence_number=103	rbr_only=no	original_committed_timestamp=1789964090445313	immediate_commit_timestamp=1789964090445313	transaction_length=271
# original_commit_timestamp=1789964090445313 (2026-09-21 11:14:50.445313 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090445313 (2026-09-21 11:14:50.445313 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090445313*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 72624
#260921 11:14:50 server id 1  end_log_pos 72816 CRC32 0xd28e8452 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3209
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_index`(`module`)
/*!*/;
# at 72816
#260921 11:14:50 server id 1  end_log_pos 72895 CRC32 0xe600c176 	Anonymous_GTID	last_committed=103	sequence_number=104	rbr_only=no	original_committed_timestamp=1789964090472843	immediate_commit_timestamp=1789964090472843	transaction_length=271
# original_commit_timestamp=1789964090472843 (2026-09-21 11:14:50.472843 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090472843 (2026-09-21 11:14:50.472843 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090472843*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 72895
#260921 11:14:50 server id 1  end_log_pos 73087 CRC32 0x96745a6c 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3212
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_action_index`(`action`)
/*!*/;
# at 73087
#260921 11:14:50 server id 1  end_log_pos 73166 CRC32 0x753b72ae 	Anonymous_GTID	last_committed=104	sequence_number=105	rbr_only=no	original_committed_timestamp=1789964090499262	immediate_commit_timestamp=1789964090499262	transaction_length=283
# original_commit_timestamp=1789964090499262 (2026-09-21 11:14:50.499262 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090499262 (2026-09-21 11:14:50.499262 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090499262*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 73166
#260921 11:14:50 server id 1  end_log_pos 73370 CRC32 0x1ec024fb 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3215
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_subject_type_index`(`subject_type`)
/*!*/;
# at 73370
#260921 11:14:50 server id 1  end_log_pos 73449 CRC32 0x894de41d 	Anonymous_GTID	last_committed=105	sequence_number=106	rbr_only=yes	original_committed_timestamp=1789964090506209	immediate_commit_timestamp=1789964090506209	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964090506209 (2026-09-21 11:14:50.506209 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090506209 (2026-09-21 11:14:50.506209 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090506209*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 73449
#260921 11:14:50 server id 1  end_log_pos 73538 CRC32 0x958327d1 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964090/*!*/;
BEGIN
/*!*/;
# at 73538
#260921 11:14:50 server id 1  end_log_pos 73615 CRC32 0x0fde144f 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 73615
#260921 11:14:50 server id 1  end_log_pos 73705 CRC32 0x79f31ba9 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oq+wahMBAAAATQAAAI8fAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4E8U3g8=
Oq+wah4BAAAAWgAAAOkfAQAAAGUAAAAAAAEAAgAD/wAKAAAALAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfYWN0aXZpdHlfbG9nc190YWJsZQEAAACpG/N5
'/*!*/;
# at 73705
#260921 11:14:50 server id 1  end_log_pos 73736 CRC32 0x5ea917bf 	Xid = 3218
COMMIT/*!*/;
# at 73736
#260921 11:14:50 server id 1  end_log_pos 73815 CRC32 0x89bbaa3f 	Anonymous_GTID	last_committed=106	sequence_number=107	rbr_only=no	original_committed_timestamp=1789964090534727	immediate_commit_timestamp=1789964090534727	transaction_length=668
# original_commit_timestamp=1789964090534727 (2026-09-21 11:14:50.534727 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090534727 (2026-09-21 11:14:50.534727 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090534727*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 73815
#260921 11:14:50 server id 1  end_log_pos 74404 CRC32 0x6aca1006 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3221
SET TIMESTAMP=1789964090/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `galleries` (`id` bigint unsigned not null auto_increment primary key, `judul` varchar(255) not null, `kategori` enum('KEGIATAN', 'FASILITAS', 'DOKUMENTASI', 'SEREMONIAL') not null, `deskripsi` text null, `file_gambar` varchar(255) not null, `tanggal_kegiatan` date not null, `status` enum('publikasi', 'draft') not null default 'publikasi', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 74404
#260921 11:14:50 server id 1  end_log_pos 74483 CRC32 0x1adcb87a 	Anonymous_GTID	last_committed=107	sequence_number=108	rbr_only=no	original_committed_timestamp=1789964090583040	immediate_commit_timestamp=1789964090583040	transaction_length=267
# original_commit_timestamp=1789964090583040 (2026-09-21 11:14:50.583040 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090583040 (2026-09-21 11:14:50.583040 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090583040*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 74483
#260921 11:14:50 server id 1  end_log_pos 74671 CRC32 0x81d724da 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3224
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_kategori_index`(`kategori`)
/*!*/;
# at 74671
#260921 11:14:50 server id 1  end_log_pos 74750 CRC32 0xc2e2f703 	Anonymous_GTID	last_committed=108	sequence_number=109	rbr_only=no	original_committed_timestamp=1789964090602955	immediate_commit_timestamp=1789964090602955	transaction_length=263
# original_commit_timestamp=1789964090602955 (2026-09-21 11:14:50.602955 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090602955 (2026-09-21 11:14:50.602955 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090602955*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 74750
#260921 11:14:50 server id 1  end_log_pos 74934 CRC32 0x194da1d8 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3227
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_status_index`(`status`)
/*!*/;
# at 74934
#260921 11:14:50 server id 1  end_log_pos 75013 CRC32 0x916536b9 	Anonymous_GTID	last_committed=109	sequence_number=110	rbr_only=no	original_committed_timestamp=1789964090620801	immediate_commit_timestamp=1789964090620801	transaction_length=283
# original_commit_timestamp=1789964090620801 (2026-09-21 11:14:50.620801 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090620801 (2026-09-21 11:14:50.620801 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090620801*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 75013
#260921 11:14:50 server id 1  end_log_pos 75217 CRC32 0xbb8cedeb 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3230
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_tanggal_kegiatan_index`(`tanggal_kegiatan`)
/*!*/;
# at 75217
#260921 11:14:50 server id 1  end_log_pos 75296 CRC32 0x80a70ff5 	Anonymous_GTID	last_committed=110	sequence_number=111	rbr_only=yes	original_committed_timestamp=1789964090627115	immediate_commit_timestamp=1789964090627115	transaction_length=362
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964090627115 (2026-09-21 11:14:50.627115 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090627115 (2026-09-21 11:14:50.627115 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090627115*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 75296
#260921 11:14:50 server id 1  end_log_pos 75385 CRC32 0x02953fea 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964090/*!*/;
BEGIN
/*!*/;
# at 75385
#260921 11:14:50 server id 1  end_log_pos 75462 CRC32 0xbafa5715 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 75462
#260921 11:14:50 server id 1  end_log_pos 75548 CRC32 0xbccc3fc5 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oq+wahMBAAAATQAAAMYmAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4BVX+ro=
Oq+wah4BAAAAVgAAABwnAQAAAGUAAAAAAAEAAgAD/wALAAAAKAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfZ2FsbGVyaWVzX3RhYmxlAQAAAMU/zLw=
'/*!*/;
# at 75548
#260921 11:14:50 server id 1  end_log_pos 75579 CRC32 0xff2f2416 	Xid = 3233
COMMIT/*!*/;
# at 75579
#260921 11:14:50 server id 1  end_log_pos 75658 CRC32 0xde5072ae 	Anonymous_GTID	last_committed=111	sequence_number=112	rbr_only=no	original_committed_timestamp=1789964090642264	immediate_commit_timestamp=1789964090642264	transaction_length=665
# original_commit_timestamp=1789964090642264 (2026-09-21 11:14:50.642264 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090642264 (2026-09-21 11:14:50.642264 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090642264*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 75658
#260921 11:14:50 server id 1  end_log_pos 76244 CRC32 0x459dd83d 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3236
SET TIMESTAMP=1789964090/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `contact_messages` (`id` bigint unsigned not null auto_increment primary key, `nama` varchar(150) not null, `email` varchar(255) not null, `telepon` varchar(25) not null, `kategori` varchar(30) not null, `subjek` varchar(255) not null, `pesan` text not null, `status` varchar(20) not null default 'belum_dibaca', `read_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 76244
#260921 11:14:50 server id 1  end_log_pos 76323 CRC32 0xc4fb7dec 	Anonymous_GTID	last_committed=112	sequence_number=113	rbr_only=no	original_committed_timestamp=1789964090672621	immediate_commit_timestamp=1789964090672621	transaction_length=277
# original_commit_timestamp=1789964090672621 (2026-09-21 11:14:50.672621 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090672621 (2026-09-21 11:14:50.672621 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090672621*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 76323
#260921 11:14:50 server id 1  end_log_pos 76521 CRC32 0x8861c262 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3239
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `contact_messages` add index `contact_messages_status_index`(`status`)
/*!*/;
# at 76521
#260921 11:14:50 server id 1  end_log_pos 76600 CRC32 0x06bd89f8 	Anonymous_GTID	last_committed=113	sequence_number=114	rbr_only=yes	original_committed_timestamp=1789964090682167	immediate_commit_timestamp=1789964090682167	transaction_length=369
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964090682167 (2026-09-21 11:14:50.682167 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090682167 (2026-09-21 11:14:50.682167 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090682167*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 76600
#260921 11:14:50 server id 1  end_log_pos 76689 CRC32 0x510a5251 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964090/*!*/;
BEGIN
/*!*/;
# at 76689
#260921 11:14:50 server id 1  end_log_pos 76766 CRC32 0xaa7fdb6d 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 76766
#260921 11:14:50 server id 1  end_log_pos 76859 CRC32 0x4ec23939 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
Oq+wahMBAAAATQAAAN4rAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4G3bf6o=
Oq+wah4BAAAAXQAAADssAQAAAGUAAAAAAAEAAgAD/wAMAAAALwAyMDI2XzA5XzE1XzAwMDAwMV9j
cmVhdGVfY29udGFjdF9tZXNzYWdlc190YWJsZQEAAAA5OcJO
'/*!*/;
# at 76859
#260921 11:14:50 server id 1  end_log_pos 76890 CRC32 0x545ee9bc 	Xid = 3242
COMMIT/*!*/;
# at 76890
#260921 11:14:50 server id 1  end_log_pos 76969 CRC32 0xd5ae8815 	Anonymous_GTID	last_committed=114	sequence_number=115	rbr_only=no	original_committed_timestamp=1789964090722000	immediate_commit_timestamp=1789964090722000	transaction_length=671
# original_commit_timestamp=1789964090722000 (2026-09-21 11:14:50.722000 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090722000 (2026-09-21 11:14:50.722000 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090722000*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 76969
#260921 11:14:50 server id 1  end_log_pos 77561 CRC32 0x43269050 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3245
SET TIMESTAMP=1789964090/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `pages` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `status` varchar(20) not null default 'draft', `visibility` varchar(20) not null default 'public', `show_in_list` tinyint(1) not null default '1', `created_by` bigint unsigned null, `updated_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 77561
#260921 11:14:50 server id 1  end_log_pos 77640 CRC32 0x799e99e8 	Anonymous_GTID	last_committed=115	sequence_number=116	rbr_only=no	original_committed_timestamp=1789964090788610	immediate_commit_timestamp=1789964090788610	transaction_length=328
# original_commit_timestamp=1789964090788610 (2026-09-21 11:14:50.788610 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090788610 (2026-09-21 11:14:50.788610 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090788610*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 77640
#260921 11:14:50 server id 1  end_log_pos 77889 CRC32 0x0f202d01 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3248
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add constraint `pages_created_by_foreign` foreign key (`created_by`) references `users` (`id`) on delete set null
/*!*/;
# at 77889
#260921 11:14:50 server id 1  end_log_pos 77968 CRC32 0x4be2ee32 	Anonymous_GTID	last_committed=116	sequence_number=117	rbr_only=no	original_committed_timestamp=1789964090867426	immediate_commit_timestamp=1789964090867426	transaction_length=328
# original_commit_timestamp=1789964090867426 (2026-09-21 11:14:50.867426 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090867426 (2026-09-21 11:14:50.867426 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090867426*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 77968
#260921 11:14:50 server id 1  end_log_pos 78217 CRC32 0x076680d7 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3251
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add constraint `pages_updated_by_foreign` foreign key (`updated_by`) references `users` (`id`) on delete set null
/*!*/;
# at 78217
#260921 11:14:50 server id 1  end_log_pos 78296 CRC32 0x65a71b2c 	Anonymous_GTID	last_committed=117	sequence_number=118	rbr_only=no	original_committed_timestamp=1789964090910635	immediate_commit_timestamp=1789964090910635	transaction_length=253
# original_commit_timestamp=1789964090910635 (2026-09-21 11:14:50.910635 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090910635 (2026-09-21 11:14:50.910635 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090910635*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 78296
#260921 11:14:50 server id 1  end_log_pos 78470 CRC32 0x4b39307a 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3254
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add unique `pages_slug_unique`(`slug`)
/*!*/;
# at 78470
#260921 11:14:50 server id 1  end_log_pos 78549 CRC32 0xde2f80bc 	Anonymous_GTID	last_committed=118	sequence_number=119	rbr_only=no	original_committed_timestamp=1789964090948335	immediate_commit_timestamp=1789964090948335	transaction_length=255
# original_commit_timestamp=1789964090948335 (2026-09-21 11:14:50.948335 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090948335 (2026-09-21 11:14:50.948335 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090948335*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 78549
#260921 11:14:50 server id 1  end_log_pos 78725 CRC32 0xa3a106e7 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3257
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add index `pages_status_index`(`status`)
/*!*/;
# at 78725
#260921 11:14:50 server id 1  end_log_pos 78804 CRC32 0x76624cf6 	Anonymous_GTID	last_committed=119	sequence_number=120	rbr_only=no	original_committed_timestamp=1789964090987418	immediate_commit_timestamp=1789964090987418	transaction_length=263
# original_commit_timestamp=1789964090987418 (2026-09-21 11:14:50.987418 SE Asia Standard Time)
# immediate_commit_timestamp=1789964090987418 (2026-09-21 11:14:50.987418 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964090987418*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 78804
#260921 11:14:50 server id 1  end_log_pos 78988 CRC32 0x31a16fd9 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3260
SET TIMESTAMP=1789964090/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add index `pages_visibility_index`(`visibility`)
/*!*/;
# at 78988
#260921 11:14:51 server id 1  end_log_pos 79067 CRC32 0x94913302 	Anonymous_GTID	last_committed=120	sequence_number=121	rbr_only=no	original_committed_timestamp=1789964091027796	immediate_commit_timestamp=1789964091027796	transaction_length=409
# original_commit_timestamp=1789964091027796 (2026-09-21 11:14:51.027796 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091027796 (2026-09-21 11:14:51.027796 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091027796*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 79067
#260921 11:14:51 server id 1  end_log_pos 79397 CRC32 0x2f3ce329 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3263
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `page_role` (`id` bigint unsigned not null auto_increment primary key, `page_id` bigint unsigned not null, `role_id` bigint unsigned not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 79397
#260921 11:14:51 server id 1  end_log_pos 79476 CRC32 0x75bbf2f2 	Anonymous_GTID	last_committed=121	sequence_number=122	rbr_only=no	original_committed_timestamp=1789964091114765	immediate_commit_timestamp=1789964091114765	transaction_length=329
# original_commit_timestamp=1789964091114765 (2026-09-21 11:14:51.114765 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091114765 (2026-09-21 11:14:51.114765 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091114765*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 79476
#260921 11:14:51 server id 1  end_log_pos 79726 CRC32 0x532895c8 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3266
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add constraint `page_role_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete cascade
/*!*/;
# at 79726
#260921 11:14:51 server id 1  end_log_pos 79805 CRC32 0xba8414e7 	Anonymous_GTID	last_committed=122	sequence_number=123	rbr_only=no	original_committed_timestamp=1789964091238240	immediate_commit_timestamp=1789964091238240	transaction_length=329
# original_commit_timestamp=1789964091238240 (2026-09-21 11:14:51.238240 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091238240 (2026-09-21 11:14:51.238240 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091238240*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 79805
#260921 11:14:51 server id 1  end_log_pos 80055 CRC32 0xf8607b1f 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3269
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add constraint `page_role_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 80055
#260921 11:14:51 server id 1  end_log_pos 80134 CRC32 0x93ea8e11 	Anonymous_GTID	last_committed=123	sequence_number=124	rbr_only=no	original_committed_timestamp=1789964091273624	immediate_commit_timestamp=1789964091273624	transaction_length=286
# original_commit_timestamp=1789964091273624 (2026-09-21 11:14:51.273624 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091273624 (2026-09-21 11:14:51.273624 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091273624*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 80134
#260921 11:14:51 server id 1  end_log_pos 80341 CRC32 0x36917f85 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3272
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add unique `page_role_page_id_role_id_unique`(`page_id`, `role_id`)
/*!*/;
# at 80341
#260921 11:14:51 server id 1  end_log_pos 80420 CRC32 0x5d9a55fe 	Anonymous_GTID	last_committed=124	sequence_number=125	rbr_only=no	original_committed_timestamp=1789964091288672	immediate_commit_timestamp=1789964091288672	transaction_length=532
# original_commit_timestamp=1789964091288672 (2026-09-21 11:14:51.288672 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091288672 (2026-09-21 11:14:51.288672 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091288672*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 80420
#260921 11:14:51 server id 1  end_log_pos 80873 CRC32 0x3df3b4f8 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3275
SET TIMESTAMP=1789964091/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `page_sections` (`id` bigint unsigned not null auto_increment primary key, `page_id` bigint unsigned not null, `type` varchar(30) not null, `data` json null, `sort_order` int unsigned not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 80873
#260921 11:14:51 server id 1  end_log_pos 80952 CRC32 0x01761d9f 	Anonymous_GTID	last_committed=125	sequence_number=126	rbr_only=no	original_committed_timestamp=1789964091356808	immediate_commit_timestamp=1789964091356808	transaction_length=337
# original_commit_timestamp=1789964091356808 (2026-09-21 11:14:51.356808 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091356808 (2026-09-21 11:14:51.356808 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091356808*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 80952
#260921 11:14:51 server id 1  end_log_pos 81210 CRC32 0x8bb4fc56 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3278
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_sections` add constraint `page_sections_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete cascade
/*!*/;
# at 81210
#260921 11:14:51 server id 1  end_log_pos 81289 CRC32 0xf3882606 	Anonymous_GTID	last_committed=126	sequence_number=127	rbr_only=no	original_committed_timestamp=1789964091384417	immediate_commit_timestamp=1789964091384417	transaction_length=279
# original_commit_timestamp=1789964091384417 (2026-09-21 11:14:51.384417 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091384417 (2026-09-21 11:14:51.384417 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091384417*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 81289
#260921 11:14:51 server id 1  end_log_pos 81489 CRC32 0xe25532b8 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3281
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_sections` add index `page_sections_sort_order_index`(`sort_order`)
/*!*/;
# at 81489
#260921 11:14:51 server id 1  end_log_pos 81568 CRC32 0x024c60a8 	Anonymous_GTID	last_committed=127	sequence_number=128	rbr_only=yes	original_committed_timestamp=1789964091391861	immediate_commit_timestamp=1789964091391861	transaction_length=359
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964091391861 (2026-09-21 11:14:51.391861 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091391861 (2026-09-21 11:14:51.391861 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091391861*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 81568
#260921 11:14:51 server id 1  end_log_pos 81657 CRC32 0xcd843410 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964091/*!*/;
BEGIN
/*!*/;
# at 81657
#260921 11:14:51 server id 1  end_log_pos 81734 CRC32 0x2393ec6d 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 81734
#260921 11:14:51 server id 1  end_log_pos 81817 CRC32 0xfcb3f5fa 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
O6+wahMBAAAATQAAAEY/AQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4G3skyM=
O6+wah4BAAAAUwAAAJk/AQAAAGUAAAAAAAEAAgAD/wANAAAAJQAyMDI2XzA5XzE1XzAwMDAwMV9j
cmVhdGVfcGFnZXNfdGFibGVzAQAAAPr1s/w=
'/*!*/;
# at 81817
#260921 11:14:51 server id 1  end_log_pos 81848 CRC32 0x64051f2d 	Xid = 3284
COMMIT/*!*/;
# at 81848
#260921 11:14:51 server id 1  end_log_pos 81927 CRC32 0x524d0762 	Anonymous_GTID	last_committed=128	sequence_number=129	rbr_only=no	original_committed_timestamp=1789964091408179	immediate_commit_timestamp=1789964091408179	transaction_length=743
# original_commit_timestamp=1789964091408179 (2026-09-21 11:14:51.408179 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091408179 (2026-09-21 11:14:51.408179 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091408179*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 81927
#260921 11:14:51 server id 1  end_log_pos 82591 CRC32 0xcb9f53d8 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3287
SET TIMESTAMP=1789964091/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `menus` (`id` bigint unsigned not null auto_increment primary key, `parent_id` bigint unsigned null, `label` varchar(255) not null, `type` varchar(20) not null default 'url', `route_name` varchar(255) null, `page_id` bigint unsigned null, `url` varchar(500) null, `icon` varchar(60) null, `sort_order` int unsigned not null default '0', `is_active` tinyint(1) not null default '1', `created_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 82591
#260921 11:14:51 server id 1  end_log_pos 82670 CRC32 0xdc7af8a3 	Anonymous_GTID	last_committed=129	sequence_number=130	rbr_only=no	original_committed_timestamp=1789964091513020	immediate_commit_timestamp=1789964091513020	transaction_length=325
# original_commit_timestamp=1789964091513020 (2026-09-21 11:14:51.513020 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091513020 (2026-09-21 11:14:51.513020 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091513020*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 82670
#260921 11:14:51 server id 1  end_log_pos 82916 CRC32 0xab5261c0 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3290
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_parent_id_foreign` foreign key (`parent_id`) references `menus` (`id`) on delete cascade
/*!*/;
# at 82916
#260921 11:14:51 server id 1  end_log_pos 82995 CRC32 0x030aabd1 	Anonymous_GTID	last_committed=130	sequence_number=131	rbr_only=no	original_committed_timestamp=1789964091598942	immediate_commit_timestamp=1789964091598942	transaction_length=322
# original_commit_timestamp=1789964091598942 (2026-09-21 11:14:51.598942 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091598942 (2026-09-21 11:14:51.598942 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091598942*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 82995
#260921 11:14:51 server id 1  end_log_pos 83238 CRC32 0xfa871d1b 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3293
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete set null
/*!*/;
# at 83238
#260921 11:14:51 server id 1  end_log_pos 83317 CRC32 0x1c80d73d 	Anonymous_GTID	last_committed=131	sequence_number=132	rbr_only=no	original_committed_timestamp=1789964091713031	immediate_commit_timestamp=1789964091713031	transaction_length=328
# original_commit_timestamp=1789964091713031 (2026-09-21 11:14:51.713031 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091713031 (2026-09-21 11:14:51.713031 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091713031*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 83317
#260921 11:14:51 server id 1  end_log_pos 83566 CRC32 0x2bb08843 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3296
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_created_by_foreign` foreign key (`created_by`) references `users` (`id`) on delete set null
/*!*/;
# at 83566
#260921 11:14:51 server id 1  end_log_pos 83645 CRC32 0x8e4f71ca 	Anonymous_GTID	last_committed=132	sequence_number=133	rbr_only=no	original_committed_timestamp=1789964091757322	immediate_commit_timestamp=1789964091757322	transaction_length=286
# original_commit_timestamp=1789964091757322 (2026-09-21 11:14:51.757322 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091757322 (2026-09-21 11:14:51.757322 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091757322*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 83645
#260921 11:14:51 server id 1  end_log_pos 83852 CRC32 0xc7da37e7 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3299
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_parent_id_sort_order_index`(`parent_id`, `sort_order`)
/*!*/;
# at 83852
#260921 11:14:51 server id 1  end_log_pos 83931 CRC32 0x3135327f 	Anonymous_GTID	last_committed=133	sequence_number=134	rbr_only=no	original_committed_timestamp=1789964091778664	immediate_commit_timestamp=1789964091778664	transaction_length=263
# original_commit_timestamp=1789964091778664 (2026-09-21 11:14:51.778664 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091778664 (2026-09-21 11:14:51.778664 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091778664*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 83931
#260921 11:14:51 server id 1  end_log_pos 84115 CRC32 0x1bfba6fd 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3302
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_sort_order_index`(`sort_order`)
/*!*/;
# at 84115
#260921 11:14:51 server id 1  end_log_pos 84194 CRC32 0x637bff10 	Anonymous_GTID	last_committed=134	sequence_number=135	rbr_only=no	original_committed_timestamp=1789964091814391	immediate_commit_timestamp=1789964091814391	transaction_length=261
# original_commit_timestamp=1789964091814391 (2026-09-21 11:14:51.814391 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091814391 (2026-09-21 11:14:51.814391 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091814391*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 84194
#260921 11:14:51 server id 1  end_log_pos 84376 CRC32 0xdf824e75 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3305
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_is_active_index`(`is_active`)
/*!*/;
# at 84376
#260921 11:14:51 server id 1  end_log_pos 84455 CRC32 0x57db0663 	Anonymous_GTID	last_committed=135	sequence_number=136	rbr_only=yes	original_committed_timestamp=1789964091823751	immediate_commit_timestamp=1789964091823751	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964091823751 (2026-09-21 11:14:51.823751 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091823751 (2026-09-21 11:14:51.823751 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091823751*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 84455
#260921 11:14:51 server id 1  end_log_pos 84544 CRC32 0x5e936f53 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964091/*!*/;
BEGIN
/*!*/;
# at 84544
#260921 11:14:51 server id 1  end_log_pos 84621 CRC32 0x0a69066b 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 84621
#260921 11:14:51 server id 1  end_log_pos 84703 CRC32 0x11c735ee 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
O6+wahMBAAAATQAAAI1KAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4GsGaQo=
O6+wah4BAAAAUgAAAN9KAQAAAGUAAAAAAAEAAgAD/wAOAAAAJAAyMDI2XzA5XzE1XzAwMDAwMl9j
cmVhdGVfbWVudXNfdGFibGUBAAAA7jXHEQ==
'/*!*/;
# at 84703
#260921 11:14:51 server id 1  end_log_pos 84734 CRC32 0x2c8d2435 	Xid = 3308
COMMIT/*!*/;
# at 84734
#260921 11:14:51 server id 1  end_log_pos 84813 CRC32 0xf53b0332 	Anonymous_GTID	last_committed=136	sequence_number=137	rbr_only=no	original_committed_timestamp=1789964091838789	immediate_commit_timestamp=1789964091838789	transaction_length=276
# original_commit_timestamp=1789964091838789 (2026-09-21 11:14:51.838789 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091838789 (2026-09-21 11:14:51.838789 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091838789*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 84813
#260921 11:14:51 server id 1  end_log_pos 85010 CRC32 0x98595ffd 	Query	thread_id=44	exec_time=0	error_code=0	Xid = 3311
SET TIMESTAMP=1789964091/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add `target` varchar(10) not null default '_self' after `url`
/*!*/;
# at 85010
#260921 11:14:51 server id 1  end_log_pos 85089 CRC32 0x69498eb4 	Anonymous_GTID	last_committed=137	sequence_number=138	rbr_only=yes	original_committed_timestamp=1789964091855375	immediate_commit_timestamp=1789964091855375	transaction_length=365
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964091855375 (2026-09-21 11:14:51.855375 SE Asia Standard Time)
# immediate_commit_timestamp=1789964091855375 (2026-09-21 11:14:51.855375 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964091855375*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 85089
#260921 11:14:51 server id 1  end_log_pos 85178 CRC32 0xb8303033 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1789964091/*!*/;
BEGIN
/*!*/;
# at 85178
#260921 11:14:51 server id 1  end_log_pos 85255 CRC32 0xb81de847 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 101
# at 85255
#260921 11:14:51 server id 1  end_log_pos 85344 CRC32 0x0d1c112e 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
O6+wahMBAAAATQAAAAdNAQAAAGUAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4EfoHbg=
O6+wah4BAAAAWQAAAGBNAQAAAGUAAAAAAAEAAgAD/wAPAAAAKwAyMDI2XzA5XzE1XzAwMDAwM19h
ZGRfdGFyZ2V0X3RvX21lbnVzX3RhYmxlAQAAAC4RHA0=
'/*!*/;
# at 85344
#260921 11:14:51 server id 1  end_log_pos 85375 CRC32 0x26b30fe0 	Xid = 3314
COMMIT/*!*/;
# at 85375
#260921 11:17:41 server id 1  end_log_pos 85454 CRC32 0x4106627c 	Anonymous_GTID	last_committed=138	sequence_number=139	rbr_only=no	original_committed_timestamp=1789964261523317	immediate_commit_timestamp=1789964261523317	transaction_length=508
# original_commit_timestamp=1789964261523317 (2026-09-21 11:17:41.523317 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261523317 (2026-09-21 11:17:41.523317 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261523317*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 85454
#260921 11:17:41 server id 1  end_log_pos 85883 CRC32 0x479bd4b2 	Query	thread_id=65	exec_time=0	error_code=0	Xid = 4620
SET TIMESTAMP=1789964261/*!*/;
SET @@session.pseudo_thread_id=65/*!*/;
SET @@session.foreign_key_checks=0/*!*/;
DROP TABLE `activity_logs`,`announcements`,`cache`,`cache_locks`,`contact_messages`,`failed_jobs`,`galleries`,`job_batches`,`jobs`,`menus`,`migrations`,`news`,`page_role`,`page_sections`,`pages`,`password_reset_tokens`,`permissions`,`role_permission`,`role_user`,`roles`,`sessions`,`users` /* generated by server */
/*!*/;
# at 85883
#260921 11:17:41 server id 1  end_log_pos 85962 CRC32 0x9f4c4c00 	Anonymous_GTID	last_committed=139	sequence_number=140	rbr_only=no	original_committed_timestamp=1789964261652565	immediate_commit_timestamp=1789964261652565	transaction_length=392
# original_commit_timestamp=1789964261652565 (2026-09-21 11:17:41.652565 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261652565 (2026-09-21 11:17:41.652565 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261652565*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 85962
#260921 11:17:41 server id 1  end_log_pos 86275 CRC32 0xa8e15d1f 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4635
SET TIMESTAMP=1789964261/*!*/;
SET @@session.foreign_key_checks=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `migrations` (`id` int unsigned not null auto_increment primary key, `migration` varchar(255) not null, `batch` int not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 86275
#260921 11:17:41 server id 1  end_log_pos 86354 CRC32 0x2f0e2319 	Anonymous_GTID	last_committed=140	sequence_number=141	rbr_only=no	original_committed_timestamp=1789964261729860	immediate_commit_timestamp=1789964261729860	transaction_length=560
# original_commit_timestamp=1789964261729860 (2026-09-21 11:17:41.729860 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261729860 (2026-09-21 11:17:41.729860 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261729860*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 86354
#260921 11:17:41 server id 1  end_log_pos 86835 CRC32 0x8fc2be97 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4650
SET TIMESTAMP=1789964261/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 86835
#260921 11:17:41 server id 1  end_log_pos 86914 CRC32 0x22ae5850 	Anonymous_GTID	last_committed=141	sequence_number=142	rbr_only=no	original_committed_timestamp=1789964261763949	immediate_commit_timestamp=1789964261763949	transaction_length=255
# original_commit_timestamp=1789964261763949 (2026-09-21 11:17:41.763949 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261763949 (2026-09-21 11:17:41.763949 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261763949*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 86914
#260921 11:17:41 server id 1  end_log_pos 87090 CRC32 0x60c2c181 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4653
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add unique `users_email_unique`(`email`)
/*!*/;
# at 87090
#260921 11:17:41 server id 1  end_log_pos 87169 CRC32 0x3ad66b57 	Anonymous_GTID	last_committed=142	sequence_number=143	rbr_only=no	original_committed_timestamp=1789964261787859	immediate_commit_timestamp=1789964261787859	transaction_length=407
# original_commit_timestamp=1789964261787859 (2026-09-21 11:17:41.787859 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261787859 (2026-09-21 11:17:41.787859 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261787859*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 87169
#260921 11:17:41 server id 1  end_log_pos 87497 CRC32 0xcfab5b93 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4656
SET TIMESTAMP=1789964261/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `password_reset_tokens` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null, primary key (`email`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 87497
#260921 11:17:41 server id 1  end_log_pos 87576 CRC32 0x51d0cb5e 	Anonymous_GTID	last_committed=143	sequence_number=144	rbr_only=no	original_committed_timestamp=1789964261808275	immediate_commit_timestamp=1789964261808275	transaction_length=472
# original_commit_timestamp=1789964261808275 (2026-09-21 11:17:41.808275 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261808275 (2026-09-21 11:17:41.808275 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261808275*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 87576
#260921 11:17:41 server id 1  end_log_pos 87969 CRC32 0x0502bdbb 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4659
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `sessions` (`id` varchar(255) not null, `user_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` text null, `payload` longtext not null, `last_activity` int not null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 87969
#260921 11:17:41 server id 1  end_log_pos 88048 CRC32 0x3af4ffd0 	Anonymous_GTID	last_committed=144	sequence_number=145	rbr_only=no	original_committed_timestamp=1789964261840113	immediate_commit_timestamp=1789964261840113	transaction_length=263
# original_commit_timestamp=1789964261840113 (2026-09-21 11:17:41.840113 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261840113 (2026-09-21 11:17:41.840113 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261840113*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 88048
#260921 11:17:41 server id 1  end_log_pos 88232 CRC32 0xd82899e3 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4662
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `sessions` add index `sessions_user_id_index`(`user_id`)
/*!*/;
# at 88232
#260921 11:17:41 server id 1  end_log_pos 88311 CRC32 0x3b708b57 	Anonymous_GTID	last_committed=145	sequence_number=146	rbr_only=no	original_committed_timestamp=1789964261864186	immediate_commit_timestamp=1789964261864186	transaction_length=275
# original_commit_timestamp=1789964261864186 (2026-09-21 11:17:41.864186 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261864186 (2026-09-21 11:17:41.864186 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261864186*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 88311
#260921 11:17:41 server id 1  end_log_pos 88507 CRC32 0x4a6e6168 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4665
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `sessions` add index `sessions_last_activity_index`(`last_activity`)
/*!*/;
# at 88507
#260921 11:17:41 server id 1  end_log_pos 88586 CRC32 0x1802af58 	Anonymous_GTID	last_committed=146	sequence_number=147	rbr_only=yes	original_committed_timestamp=1789964261875511	immediate_commit_timestamp=1789964261875511	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964261875511 (2026-09-21 11:17:41.875511 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261875511 (2026-09-21 11:17:41.875511 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261875511*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 88586
#260921 11:17:41 server id 1  end_log_pos 88675 CRC32 0x3924fdee 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964261/*!*/;
BEGIN
/*!*/;
# at 88675
#260921 11:17:41 server id 1  end_log_pos 88752 CRC32 0x94b86b38 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 88752
#260921 11:17:41 server id 1  end_log_pos 88834 CRC32 0x84595671 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
5a+wahMBAAAATQAAALBaAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4DhruJQ=
5a+wah4BAAAAUgAAAAJbAQAAALoAAAAAAAEAAgAD/wABAAAAJAAwMDAxXzAxXzAxXzAwMDAwMF9j
cmVhdGVfdXNlcnNfdGFibGUBAAAAcVZZhA==
'/*!*/;
# at 88834
#260921 11:17:41 server id 1  end_log_pos 88865 CRC32 0x9a36810a 	Xid = 4668
COMMIT/*!*/;
# at 88865
#260921 11:17:41 server id 1  end_log_pos 88944 CRC32 0xbef6c66c 	Anonymous_GTID	last_committed=147	sequence_number=148	rbr_only=no	original_committed_timestamp=1789964261895920	immediate_commit_timestamp=1789964261895920	transaction_length=381
# original_commit_timestamp=1789964261895920 (2026-09-21 11:17:41.895920 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261895920 (2026-09-21 11:17:41.895920 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261895920*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 88944
#260921 11:17:41 server id 1  end_log_pos 89246 CRC32 0x6f8d197b 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4671
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `cache` (`key` varchar(255) not null, `value` mediumtext not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 89246
#260921 11:17:41 server id 1  end_log_pos 89325 CRC32 0x1b930d45 	Anonymous_GTID	last_committed=148	sequence_number=149	rbr_only=no	original_committed_timestamp=1789964261935562	immediate_commit_timestamp=1789964261935562	transaction_length=263
# original_commit_timestamp=1789964261935562 (2026-09-21 11:17:41.935562 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261935562 (2026-09-21 11:17:41.935562 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261935562*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 89325
#260921 11:17:41 server id 1  end_log_pos 89509 CRC32 0x8c1b1eb9 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4674
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `cache` add index `cache_expiration_index`(`expiration`)
/*!*/;
# at 89509
#260921 11:17:41 server id 1  end_log_pos 89588 CRC32 0x01730ec3 	Anonymous_GTID	last_committed=149	sequence_number=150	rbr_only=no	original_committed_timestamp=1789964261964050	immediate_commit_timestamp=1789964261964050	transaction_length=389
# original_commit_timestamp=1789964261964050 (2026-09-21 11:17:41.964050 SE Asia Standard Time)
# immediate_commit_timestamp=1789964261964050 (2026-09-21 11:17:41.964050 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964261964050*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 89588
#260921 11:17:41 server id 1  end_log_pos 89898 CRC32 0xc24df5f7 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4677
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `cache_locks` (`key` varchar(255) not null, `owner` varchar(255) not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 89898
#260921 11:17:41 server id 1  end_log_pos 89977 CRC32 0x9620bcdb 	Anonymous_GTID	last_committed=150	sequence_number=151	rbr_only=no	original_committed_timestamp=1789964262053328	immediate_commit_timestamp=1789964262053328	transaction_length=275
# original_commit_timestamp=1789964262053328 (2026-09-21 11:17:42.053328 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262053328 (2026-09-21 11:17:42.053328 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262053328*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 89977
#260921 11:17:41 server id 1  end_log_pos 90173 CRC32 0x80b58245 	Query	thread_id=66	exec_time=1	error_code=0	Xid = 4680
SET TIMESTAMP=1789964261/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `cache_locks` add index `cache_locks_expiration_index`(`expiration`)
/*!*/;
# at 90173
#260921 11:17:42 server id 1  end_log_pos 90252 CRC32 0xac624db9 	Anonymous_GTID	last_committed=151	sequence_number=152	rbr_only=yes	original_committed_timestamp=1789964262061725	immediate_commit_timestamp=1789964262061725	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964262061725 (2026-09-21 11:17:42.061725 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262061725 (2026-09-21 11:17:42.061725 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262061725*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 90252
#260921 11:17:42 server id 1  end_log_pos 90341 CRC32 0x9a73b728 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964262/*!*/;
BEGIN
/*!*/;
# at 90341
#260921 11:17:42 server id 1  end_log_pos 90418 CRC32 0xe19cfe0a 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 90418
#260921 11:17:42 server id 1  end_log_pos 90500 CRC32 0xb9970d66 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
5q+wahMBAAAATQAAADJhAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4Ar+nOE=
5q+wah4BAAAAUgAAAIRhAQAAALoAAAAAAAEAAgAD/wACAAAAJAAwMDAxXzAxXzAxXzAwMDAwMV9j
cmVhdGVfY2FjaGVfdGFibGUBAAAAZg2XuQ==
'/*!*/;
# at 90500
#260921 11:17:42 server id 1  end_log_pos 90531 CRC32 0xd00c9406 	Xid = 4683
COMMIT/*!*/;
# at 90531
#260921 11:17:42 server id 1  end_log_pos 90610 CRC32 0x3c3a350a 	Anonymous_GTID	last_committed=152	sequence_number=153	rbr_only=no	original_committed_timestamp=1789964262083975	immediate_commit_timestamp=1789964262083975	transaction_length=537
# original_commit_timestamp=1789964262083975 (2026-09-21 11:17:42.083975 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262083975 (2026-09-21 11:17:42.083975 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262083975*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 90610
#260921 11:17:42 server id 1  end_log_pos 91068 CRC32 0x822c4e65 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4686
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `jobs` (`id` bigint unsigned not null auto_increment primary key, `queue` varchar(255) not null, `payload` longtext not null, `attempts` tinyint unsigned not null, `reserved_at` int unsigned null, `available_at` int unsigned not null, `created_at` int unsigned not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 91068
#260921 11:17:42 server id 1  end_log_pos 91145 CRC32 0x66d554f2 	Anonymous_GTID	last_committed=153	sequence_number=154	rbr_only=no	original_committed_timestamp=1789964262111390	immediate_commit_timestamp=1789964262111390	transaction_length=249
# original_commit_timestamp=1789964262111390 (2026-09-21 11:17:42.111390 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262111390 (2026-09-21 11:17:42.111390 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262111390*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 91145
#260921 11:17:42 server id 1  end_log_pos 91317 CRC32 0x7358bf2e 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4689
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `jobs` add index `jobs_queue_index`(`queue`)
/*!*/;
# at 91317
#260921 11:17:42 server id 1  end_log_pos 91396 CRC32 0xff85bee9 	Anonymous_GTID	last_committed=154	sequence_number=155	rbr_only=no	original_committed_timestamp=1789964262136924	immediate_commit_timestamp=1789964262136924	transaction_length=582
# original_commit_timestamp=1789964262136924 (2026-09-21 11:17:42.136924 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262136924 (2026-09-21 11:17:42.136924 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262136924*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 91396
#260921 11:17:42 server id 1  end_log_pos 91899 CRC32 0x685b1462 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4692
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `job_batches` (`id` varchar(255) not null, `name` varchar(255) not null, `total_jobs` int not null, `pending_jobs` int not null, `failed_jobs` int not null, `failed_job_ids` longtext not null, `options` mediumtext null, `cancelled_at` int null, `created_at` int not null, `finished_at` int null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 91899
#260921 11:17:42 server id 1  end_log_pos 91978 CRC32 0xc3bc7cab 	Anonymous_GTID	last_committed=155	sequence_number=156	rbr_only=no	original_committed_timestamp=1789964262158568	immediate_commit_timestamp=1789964262158568	transaction_length=540
# original_commit_timestamp=1789964262158568 (2026-09-21 11:17:42.158568 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262158568 (2026-09-21 11:17:42.158568 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262158568*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 91978
#260921 11:17:42 server id 1  end_log_pos 92439 CRC32 0x58ae9ce4 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4695
SET TIMESTAMP=1789964262/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `failed_jobs` (`id` bigint unsigned not null auto_increment primary key, `uuid` varchar(255) not null, `connection` text not null, `queue` text not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp not null default CURRENT_TIMESTAMP) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 92439
#260921 11:17:42 server id 1  end_log_pos 92518 CRC32 0x812f57e9 	Anonymous_GTID	last_committed=156	sequence_number=157	rbr_only=no	original_committed_timestamp=1789964262179453	immediate_commit_timestamp=1789964262179453	transaction_length=265
# original_commit_timestamp=1789964262179453 (2026-09-21 11:17:42.179453 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262179453 (2026-09-21 11:17:42.179453 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262179453*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 92518
#260921 11:17:42 server id 1  end_log_pos 92704 CRC32 0x4da0267d 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4698
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `failed_jobs` add unique `failed_jobs_uuid_unique`(`uuid`)
/*!*/;
# at 92704
#260921 11:17:42 server id 1  end_log_pos 92783 CRC32 0xd22c5a53 	Anonymous_GTID	last_committed=157	sequence_number=158	rbr_only=yes	original_committed_timestamp=1789964262186285	immediate_commit_timestamp=1789964262186285	transaction_length=357
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964262186285 (2026-09-21 11:17:42.186285 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262186285 (2026-09-21 11:17:42.186285 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262186285*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 92783
#260921 11:17:42 server id 1  end_log_pos 92872 CRC32 0x82f54701 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964262/*!*/;
BEGIN
/*!*/;
# at 92872
#260921 11:17:42 server id 1  end_log_pos 92949 CRC32 0xe068d5fa 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 92949
#260921 11:17:42 server id 1  end_log_pos 93030 CRC32 0x9c45d49e 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
5q+wahMBAAAATQAAABVrAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4PrVaOA=
5q+wah4BAAAAUQAAAGZrAQAAALoAAAAAAAEAAgAD/wADAAAAIwAwMDAxXzAxXzAxXzAwMDAwMl9j
cmVhdGVfam9ic190YWJsZQEAAACe1EWc
'/*!*/;
# at 93030
#260921 11:17:42 server id 1  end_log_pos 93061 CRC32 0x6521f9e2 	Xid = 4701
COMMIT/*!*/;
# at 93061
#260921 11:17:42 server id 1  end_log_pos 93140 CRC32 0x23c8a911 	Anonymous_GTID	last_committed=158	sequence_number=159	rbr_only=no	original_committed_timestamp=1789964262199908	immediate_commit_timestamp=1789964262199908	transaction_length=276
# original_commit_timestamp=1789964262199908 (2026-09-21 11:17:42.199908 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262199908 (2026-09-21 11:17:42.199908 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262199908*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 93140
#260921 11:17:42 server id 1  end_log_pos 93337 CRC32 0x5653c8b9 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4704
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `role` varchar(255) not null default 'user' after `email`
/*!*/;
# at 93337
#260921 11:17:42 server id 1  end_log_pos 93416 CRC32 0xa46611f5 	Anonymous_GTID	last_committed=159	sequence_number=160	rbr_only=no	original_committed_timestamp=1789964262220532	immediate_commit_timestamp=1789964262220532	transaction_length=260
# original_commit_timestamp=1789964262220532 (2026-09-21 11:17:42.220532 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262220532 (2026-09-21 11:17:42.220532 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262220532*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 93416
#260921 11:17:42 server id 1  end_log_pos 93597 CRC32 0x2a3b5f4f 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4707
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `no_hp` varchar(20) null after `password`
/*!*/;
# at 93597
#260921 11:17:42 server id 1  end_log_pos 93674 CRC32 0x025bd8e1 	Anonymous_GTID	last_committed=160	sequence_number=161	rbr_only=no	original_committed_timestamp=1789964262241740	immediate_commit_timestamp=1789964262241740	transaction_length=249
# original_commit_timestamp=1789964262241740 (2026-09-21 11:17:42.241740 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262241740 (2026-09-21 11:17:42.241740 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262241740*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 93674
#260921 11:17:42 server id 1  end_log_pos 93846 CRC32 0xd9bc7884 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4710
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `alamat` text null after `no_hp`
/*!*/;
# at 93846
#260921 11:17:42 server id 1  end_log_pos 93925 CRC32 0xc34bd22a 	Anonymous_GTID	last_committed=161	sequence_number=162	rbr_only=yes	original_committed_timestamp=1789964262254265	immediate_commit_timestamp=1789964262254265	transaction_length=378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964262254265 (2026-09-21 11:17:42.254265 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262254265 (2026-09-21 11:17:42.254265 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262254265*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 93925
#260921 11:17:42 server id 1  end_log_pos 94014 CRC32 0x74deb6ec 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964262/*!*/;
BEGIN
/*!*/;
# at 94014
#260921 11:17:42 server id 1  end_log_pos 94091 CRC32 0x6f47d340 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 94091
#260921 11:17:42 server id 1  end_log_pos 94193 CRC32 0x60be2de9 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
5q+wahMBAAAATQAAAItvAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4EDTR28=
5q+wah4BAAAAZgAAAPFvAQAAALoAAAAAAAEAAgAD/wAEAAAAOAAyMDI2XzA5XzA5XzAyMDUxNF9h
ZGRfdXNlcl9wcm9maWxlX2ZpZWxkc190b191c2Vyc190YWJsZQEAAADpLb5g
'/*!*/;
# at 94193
#260921 11:17:42 server id 1  end_log_pos 94224 CRC32 0x560a00ff 	Xid = 4713
COMMIT/*!*/;
# at 94224
#260921 11:17:42 server id 1  end_log_pos 94303 CRC32 0xc0b0ee74 	Anonymous_GTID	last_committed=162	sequence_number=163	rbr_only=no	original_committed_timestamp=1789964262278799	immediate_commit_timestamp=1789964262278799	transaction_length=498
# original_commit_timestamp=1789964262278799 (2026-09-21 11:17:42.278799 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262278799 (2026-09-21 11:17:42.278799 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262278799*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 94303
#260921 11:17:42 server id 1  end_log_pos 94722 CRC32 0x1be0622b 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4716
SET TIMESTAMP=1789964262/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `roles` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(100) not null, `description` varchar(255) null, `status` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 94722
#260921 11:17:42 server id 1  end_log_pos 94801 CRC32 0x537c4abe 	Anonymous_GTID	last_committed=163	sequence_number=164	rbr_only=no	original_committed_timestamp=1789964262306473	immediate_commit_timestamp=1789964262306473	transaction_length=253
# original_commit_timestamp=1789964262306473 (2026-09-21 11:17:42.306473 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262306473 (2026-09-21 11:17:42.306473 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262306473*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 94801
#260921 11:17:42 server id 1  end_log_pos 94975 CRC32 0x3e3a4356 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4719
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `roles` add unique `roles_name_unique`(`name`)
/*!*/;
# at 94975
#260921 11:17:42 server id 1  end_log_pos 95054 CRC32 0x5e162871 	Anonymous_GTID	last_committed=164	sequence_number=165	rbr_only=no	original_committed_timestamp=1789964262334636	immediate_commit_timestamp=1789964262334636	transaction_length=491
# original_commit_timestamp=1789964262334636 (2026-09-21 11:17:42.334636 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262334636 (2026-09-21 11:17:42.334636 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262334636*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 95054
#260921 11:17:42 server id 1  end_log_pos 95466 CRC32 0x5c5e6f7d 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4722
SET TIMESTAMP=1789964262/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `permissions` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(100) not null, `display_name` varchar(255) null, `module` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 95466
#260921 11:17:42 server id 1  end_log_pos 95545 CRC32 0x45e2c4b0 	Anonymous_GTID	last_committed=165	sequence_number=166	rbr_only=no	original_committed_timestamp=1789964262385100	immediate_commit_timestamp=1789964262385100	transaction_length=265
# original_commit_timestamp=1789964262385100 (2026-09-21 11:17:42.385100 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262385100 (2026-09-21 11:17:42.385100 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262385100*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 95545
#260921 11:17:42 server id 1  end_log_pos 95731 CRC32 0xe7aef2a2 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4725
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `permissions` add unique `permissions_name_unique`(`name`)
/*!*/;
# at 95731
#260921 11:17:42 server id 1  end_log_pos 95810 CRC32 0x1c4df2f2 	Anonymous_GTID	last_committed=166	sequence_number=167	rbr_only=no	original_committed_timestamp=1789964262411172	immediate_commit_timestamp=1789964262411172	transaction_length=481
# original_commit_timestamp=1789964262411172 (2026-09-21 11:17:42.411172 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262411172 (2026-09-21 11:17:42.411172 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262411172*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 95810
#260921 11:17:42 server id 1  end_log_pos 96212 CRC32 0xbf7d1614 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4728
SET TIMESTAMP=1789964262/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `role_permission` (`id` bigint unsigned not null auto_increment primary key, `role_id` bigint unsigned not null, `permission_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 96212
#260921 11:17:42 server id 1  end_log_pos 96291 CRC32 0x5339ba29 	Anonymous_GTID	last_committed=167	sequence_number=168	rbr_only=no	original_committed_timestamp=1789964262484086	immediate_commit_timestamp=1789964262484086	transaction_length=341
# original_commit_timestamp=1789964262484086 (2026-09-21 11:17:42.484086 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262484086 (2026-09-21 11:17:42.484086 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262484086*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 96291
#260921 11:17:42 server id 1  end_log_pos 96553 CRC32 0x9c8f573c 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4731
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add constraint `role_permission_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 96553
#260921 11:17:42 server id 1  end_log_pos 96632 CRC32 0xa12da0ac 	Anonymous_GTID	last_committed=168	sequence_number=169	rbr_only=no	original_committed_timestamp=1789964262619456	immediate_commit_timestamp=1789964262619456	transaction_length=359
# original_commit_timestamp=1789964262619456 (2026-09-21 11:17:42.619456 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262619456 (2026-09-21 11:17:42.619456 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262619456*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 96632
#260921 11:17:42 server id 1  end_log_pos 96912 CRC32 0xfde8d840 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4734
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add constraint `role_permission_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade
/*!*/;
# at 96912
#260921 11:17:42 server id 1  end_log_pos 96991 CRC32 0xa837726a 	Anonymous_GTID	last_committed=169	sequence_number=170	rbr_only=no	original_committed_timestamp=1789964262664183	immediate_commit_timestamp=1789964262664183	transaction_length=310
# original_commit_timestamp=1789964262664183 (2026-09-21 11:17:42.664183 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262664183 (2026-09-21 11:17:42.664183 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262664183*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 96991
#260921 11:17:42 server id 1  end_log_pos 97222 CRC32 0xccd8c8a5 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4737
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add unique `role_permission_role_id_permission_id_unique`(`role_id`, `permission_id`)
/*!*/;
# at 97222
#260921 11:17:42 server id 1  end_log_pos 97301 CRC32 0x5fb25cb9 	Anonymous_GTID	last_committed=170	sequence_number=171	rbr_only=no	original_committed_timestamp=1789964262690637	immediate_commit_timestamp=1789964262690637	transaction_length=469
# original_commit_timestamp=1789964262690637 (2026-09-21 11:17:42.690637 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262690637 (2026-09-21 11:17:42.690637 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262690637*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 97301
#260921 11:17:42 server id 1  end_log_pos 97691 CRC32 0xa66b4251 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4740
SET TIMESTAMP=1789964262/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `role_user` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `role_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 97691
#260921 11:17:42 server id 1  end_log_pos 97770 CRC32 0xe2173c72 	Anonymous_GTID	last_committed=171	sequence_number=172	rbr_only=no	original_committed_timestamp=1789964262785200	immediate_commit_timestamp=1789964262785200	transaction_length=329
# original_commit_timestamp=1789964262785200 (2026-09-21 11:17:42.785200 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262785200 (2026-09-21 11:17:42.785200 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262785200*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 97770
#260921 11:17:42 server id 1  end_log_pos 98020 CRC32 0x659b349f 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4743
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add constraint `role_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade
/*!*/;
# at 98020
#260921 11:17:42 server id 1  end_log_pos 98099 CRC32 0xe87bd738 	Anonymous_GTID	last_committed=172	sequence_number=173	rbr_only=no	original_committed_timestamp=1789964262864662	immediate_commit_timestamp=1789964262864662	transaction_length=329
# original_commit_timestamp=1789964262864662 (2026-09-21 11:17:42.864662 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262864662 (2026-09-21 11:17:42.864662 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262864662*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 98099
#260921 11:17:42 server id 1  end_log_pos 98349 CRC32 0x8f5622a9 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4746
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add constraint `role_user_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 98349
#260921 11:17:42 server id 1  end_log_pos 98428 CRC32 0x3e6aa3bc 	Anonymous_GTID	last_committed=173	sequence_number=174	rbr_only=no	original_committed_timestamp=1789964262925710	immediate_commit_timestamp=1789964262925710	transaction_length=286
# original_commit_timestamp=1789964262925710 (2026-09-21 11:17:42.925710 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262925710 (2026-09-21 11:17:42.925710 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262925710*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 98428
#260921 11:17:42 server id 1  end_log_pos 98635 CRC32 0xf0bda74c 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4749
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add unique `role_user_user_id_role_id_unique`(`user_id`, `role_id`)
/*!*/;
# at 98635
#260921 11:17:42 server id 1  end_log_pos 98714 CRC32 0xdd5a189b 	Anonymous_GTID	last_committed=174	sequence_number=175	rbr_only=yes	original_committed_timestamp=1789964262935339	immediate_commit_timestamp=1789964262935339	transaction_length=371
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964262935339 (2026-09-21 11:17:42.935339 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262935339 (2026-09-21 11:17:42.935339 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262935339*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 98714
#260921 11:17:42 server id 1  end_log_pos 98803 CRC32 0xf820e71e 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964262/*!*/;
BEGIN
/*!*/;
# at 98803
#260921 11:17:42 server id 1  end_log_pos 98880 CRC32 0x50915ef0 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 98880
#260921 11:17:42 server id 1  end_log_pos 98975 CRC32 0x28b1ff6b 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
5q+wahMBAAAATQAAAECCAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4PBekVA=
5q+wah4BAAAAXwAAAJ+CAQAAALoAAAAAAAEAAgAD/wAFAAAAMQAyMDI2XzA5XzEwXzAwMDAwMV9j
cmVhdGVfcm9sZXNfcGVybWlzc2lvbnNfdGFibGVzAQAAAGv/sSg=
'/*!*/;
# at 98975
#260921 11:17:42 server id 1  end_log_pos 99006 CRC32 0x496021fc 	Xid = 4752
COMMIT/*!*/;
# at 99006
#260921 11:17:42 server id 1  end_log_pos 99083 CRC32 0xbfd599fe 	Anonymous_GTID	last_committed=175	sequence_number=176	rbr_only=no	original_committed_timestamp=1789964262969197	immediate_commit_timestamp=1789964262969197	transaction_length=247
# original_commit_timestamp=1789964262969197 (2026-09-21 11:17:42.969197 SE Asia Standard Time)
# immediate_commit_timestamp=1789964262969197 (2026-09-21 11:17:42.969197 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964262969197*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 99083
#260921 11:17:42 server id 1  end_log_pos 99253 CRC32 0xc2db0af6 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4755
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `role_id` bigint unsigned null
/*!*/;
# at 99253
#260921 11:17:42 server id 1  end_log_pos 99332 CRC32 0x05da243a 	Anonymous_GTID	last_committed=176	sequence_number=177	rbr_only=no	original_committed_timestamp=1789964263121351	immediate_commit_timestamp=1789964263121351	transaction_length=322
# original_commit_timestamp=1789964263121351 (2026-09-21 11:17:43.121351 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263121351 (2026-09-21 11:17:43.121351 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263121351*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 99332
#260921 11:17:42 server id 1  end_log_pos 99575 CRC32 0xa2bbe823 	Query	thread_id=66	exec_time=1	error_code=0	Xid = 4758
SET TIMESTAMP=1789964262/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add constraint `users_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete set null
/*!*/;
# at 99575
#260921 11:17:43 server id 1  end_log_pos 99654 CRC32 0x54380322 	Anonymous_GTID	last_committed=177	sequence_number=178	rbr_only=yes	original_committed_timestamp=1789964263148243	immediate_commit_timestamp=1789964263148243	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964263148243 (2026-09-21 11:17:43.148243 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263148243 (2026-09-21 11:17:43.148243 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263148243*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 99654
#260921 11:17:43 server id 1  end_log_pos 99743 CRC32 0xa5decb2e 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964263/*!*/;
BEGIN
/*!*/;
# at 99743
#260921 11:17:43 server id 1  end_log_pos 99820 CRC32 0xf0146145 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 99820
#260921 11:17:43 server id 1  end_log_pos 99910 CRC32 0xd3ff3712 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
56+wahMBAAAATQAAAOyFAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4EVhFPA=
56+wah4BAAAAWgAAAEaGAQAAALoAAAAAAAEAAgAD/wAGAAAALAAyMDI2XzA5XzEwXzAwMDAwMl9h
ZGRfcm9sZV9pZF90b191c2Vyc190YWJsZQEAAAASN//T
'/*!*/;
# at 99910
#260921 11:17:43 server id 1  end_log_pos 99941 CRC32 0x135a5492 	Xid = 4761
COMMIT/*!*/;
# at 99941
#260921 11:17:43 server id 1  end_log_pos 100020 CRC32 0xd191cefa 	Anonymous_GTID	last_committed=178	sequence_number=179	rbr_only=no	original_committed_timestamp=1789964263181175	immediate_commit_timestamp=1789964263181175	transaction_length=747
# original_commit_timestamp=1789964263181175 (2026-09-21 11:17:43.181175 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263181175 (2026-09-21 11:17:43.181175 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263181175*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 100020
#260921 11:17:43 server id 1  end_log_pos 100688 CRC32 0xf348a323 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4767
SET TIMESTAMP=1789964263/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `news` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `category` enum('umum', 'teknis', 'kegiatan', 'kepegawaian') not null, `excerpt` text not null, `content` longtext null, `image` varchar(255) null, `author` varchar(255) null, `is_published` tinyint(1) not null default '0', `published_at` timestamp null, `author_user_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 100688
#260921 11:17:43 server id 1  end_log_pos 100767 CRC32 0xceca4ab6 	Anonymous_GTID	last_committed=179	sequence_number=180	rbr_only=no	original_committed_timestamp=1789964263249570	immediate_commit_timestamp=1789964263249570	transaction_length=334
# original_commit_timestamp=1789964263249570 (2026-09-21 11:17:43.249570 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263249570 (2026-09-21 11:17:43.249570 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263249570*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 100767
#260921 11:17:43 server id 1  end_log_pos 101022 CRC32 0xf37d8f18 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4770
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add constraint `news_author_user_id_foreign` foreign key (`author_user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 101022
#260921 11:17:43 server id 1  end_log_pos 101101 CRC32 0x176f1b00 	Anonymous_GTID	last_committed=180	sequence_number=181	rbr_only=no	original_committed_timestamp=1789964263291293	immediate_commit_timestamp=1789964263291293	transaction_length=265
# original_commit_timestamp=1789964263291293 (2026-09-21 11:17:43.291293 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263291293 (2026-09-21 11:17:43.291293 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263291293*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 101101
#260921 11:17:43 server id 1  end_log_pos 101287 CRC32 0xc11af5c6 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4773
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_is_published_index`(`is_published`)
/*!*/;
# at 101287
#260921 11:17:43 server id 1  end_log_pos 101366 CRC32 0x44d932b5 	Anonymous_GTID	last_committed=181	sequence_number=182	rbr_only=no	original_committed_timestamp=1789964263326726	immediate_commit_timestamp=1789964263326726	transaction_length=257
# original_commit_timestamp=1789964263326726 (2026-09-21 11:17:43.326726 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263326726 (2026-09-21 11:17:43.326726 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263326726*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 101366
#260921 11:17:43 server id 1  end_log_pos 101544 CRC32 0xe91a5510 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4776
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_category_index`(`category`)
/*!*/;
# at 101544
#260921 11:17:43 server id 1  end_log_pos 101623 CRC32 0xcd2d7b30 	Anonymous_GTID	last_committed=182	sequence_number=183	rbr_only=no	original_committed_timestamp=1789964263354407	immediate_commit_timestamp=1789964263354407	transaction_length=265
# original_commit_timestamp=1789964263354407 (2026-09-21 11:17:43.354407 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263354407 (2026-09-21 11:17:43.354407 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263354407*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 101623
#260921 11:17:43 server id 1  end_log_pos 101809 CRC32 0xbcb97682 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4779
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_published_at_index`(`published_at`)
/*!*/;
# at 101809
#260921 11:17:43 server id 1  end_log_pos 101886 CRC32 0x3c4d26a4 	Anonymous_GTID	last_committed=183	sequence_number=184	rbr_only=no	original_committed_timestamp=1789964263393186	immediate_commit_timestamp=1789964263393186	transaction_length=249
# original_commit_timestamp=1789964263393186 (2026-09-21 11:17:43.393186 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263393186 (2026-09-21 11:17:43.393186 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263393186*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 101886
#260921 11:17:43 server id 1  end_log_pos 102058 CRC32 0x2041b9bc 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4782
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add unique `news_slug_unique`(`slug`)
/*!*/;
# at 102058
#260921 11:17:43 server id 1  end_log_pos 102137 CRC32 0xb06a24ec 	Anonymous_GTID	last_committed=184	sequence_number=185	rbr_only=yes	original_committed_timestamp=1789964263404387	immediate_commit_timestamp=1789964263404387	transaction_length=357
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964263404387 (2026-09-21 11:17:43.404387 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263404387 (2026-09-21 11:17:43.404387 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263404387*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 102137
#260921 11:17:43 server id 1  end_log_pos 102226 CRC32 0xfd8d9814 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964263/*!*/;
BEGIN
/*!*/;
# at 102226
#260921 11:17:43 server id 1  end_log_pos 102303 CRC32 0x1be0ecdc 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 102303
#260921 11:17:43 server id 1  end_log_pos 102384 CRC32 0xdd636643 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
56+wahMBAAAATQAAAJ+PAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4Nzs4Bs=
56+wah4BAAAAUQAAAPCPAQAAALoAAAAAAAEAAgAD/wAHAAAAIwAyMDI2XzA5XzExXzAwMDAwMV9j
cmVhdGVfbmV3c190YWJsZQEAAABDZmPd
'/*!*/;
# at 102384
#260921 11:17:43 server id 1  end_log_pos 102415 CRC32 0x73c101c4 	Xid = 4785
COMMIT/*!*/;
# at 102415
#260921 11:17:43 server id 1  end_log_pos 102494 CRC32 0xe1b8a5e6 	Anonymous_GTID	last_committed=185	sequence_number=186	rbr_only=yes	original_committed_timestamp=1789964263420225	immediate_commit_timestamp=1789964263420225	transaction_length=368
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964263420225 (2026-09-21 11:17:43.420225 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263420225 (2026-09-21 11:17:43.420225 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263420225*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 102494
#260921 11:17:43 server id 1  end_log_pos 102583 CRC32 0x045f0654 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964263/*!*/;
BEGIN
/*!*/;
# at 102583
#260921 11:17:43 server id 1  end_log_pos 102660 CRC32 0xcfdf3aea 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 102660
#260921 11:17:43 server id 1  end_log_pos 102752 CRC32 0xdc82a379 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
56+wahMBAAAATQAAAASRAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4Oo6388=
56+wah4BAAAAXAAAAGCRAQAAALoAAAAAAAEAAgAD/wAIAAAALgAyMDI2XzA5XzExXzAwMDAwMl9h
ZGRfdGltZXN0YW1wc190b19uZXdzX3RhYmxlAQAAAHmjgtw=
'/*!*/;
# at 102752
#260921 11:17:43 server id 1  end_log_pos 102783 CRC32 0x19527752 	Xid = 4794
COMMIT/*!*/;
# at 102783
#260921 11:17:43 server id 1  end_log_pos 102862 CRC32 0x8107e93a 	Anonymous_GTID	last_committed=186	sequence_number=187	rbr_only=no	original_committed_timestamp=1789964263448633	immediate_commit_timestamp=1789964263448633	transaction_length=712
# original_commit_timestamp=1789964263448633 (2026-09-21 11:17:43.448633 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263448633 (2026-09-21 11:17:43.448633 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263448633*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 102862
#260921 11:17:43 server id 1  end_log_pos 103495 CRC32 0x106260fd 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4797
SET TIMESTAMP=1789964263/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `announcements` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `category` enum('umum', 'teknis', 'kepegawaian', 'keuangan', 'layanan') not null, `excerpt` text not null, `content` longtext null, `is_published` tinyint(1) not null default '0', `published_at` timestamp null, `author_user_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 103495
#260921 11:17:43 server id 1  end_log_pos 103574 CRC32 0x6508cefd 	Anonymous_GTID	last_committed=187	sequence_number=188	rbr_only=no	original_committed_timestamp=1789964263510959	immediate_commit_timestamp=1789964263510959	transaction_length=352
# original_commit_timestamp=1789964263510959 (2026-09-21 11:17:43.510959 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263510959 (2026-09-21 11:17:43.510959 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263510959*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 103574
#260921 11:17:43 server id 1  end_log_pos 103847 CRC32 0x0edf1a42 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4800
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add constraint `announcements_author_user_id_foreign` foreign key (`author_user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 103847
#260921 11:17:43 server id 1  end_log_pos 103926 CRC32 0x16da0ff2 	Anonymous_GTID	last_committed=188	sequence_number=189	rbr_only=no	original_committed_timestamp=1789964263545260	immediate_commit_timestamp=1789964263545260	transaction_length=283
# original_commit_timestamp=1789964263545260 (2026-09-21 11:17:43.545260 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263545260 (2026-09-21 11:17:43.545260 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263545260*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 103926
#260921 11:17:43 server id 1  end_log_pos 104130 CRC32 0x2f96f276 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4803
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_is_published_index`(`is_published`)
/*!*/;
# at 104130
#260921 11:17:43 server id 1  end_log_pos 104209 CRC32 0xea552e1e 	Anonymous_GTID	last_committed=189	sequence_number=190	rbr_only=no	original_committed_timestamp=1789964263576657	immediate_commit_timestamp=1789964263576657	transaction_length=275
# original_commit_timestamp=1789964263576657 (2026-09-21 11:17:43.576657 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263576657 (2026-09-21 11:17:43.576657 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263576657*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 104209
#260921 11:17:43 server id 1  end_log_pos 104405 CRC32 0xfc459475 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4806
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_category_index`(`category`)
/*!*/;
# at 104405
#260921 11:17:43 server id 1  end_log_pos 104484 CRC32 0x26f4b565 	Anonymous_GTID	last_committed=190	sequence_number=191	rbr_only=no	original_committed_timestamp=1789964263611865	immediate_commit_timestamp=1789964263611865	transaction_length=283
# original_commit_timestamp=1789964263611865 (2026-09-21 11:17:43.611865 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263611865 (2026-09-21 11:17:43.611865 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263611865*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 104484
#260921 11:17:43 server id 1  end_log_pos 104688 CRC32 0xd20455f5 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4809
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_published_at_index`(`published_at`)
/*!*/;
# at 104688
#260921 11:17:43 server id 1  end_log_pos 104767 CRC32 0x3cb0b307 	Anonymous_GTID	last_committed=191	sequence_number=192	rbr_only=no	original_committed_timestamp=1789964263646168	immediate_commit_timestamp=1789964263646168	transaction_length=269
# original_commit_timestamp=1789964263646168 (2026-09-21 11:17:43.646168 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263646168 (2026-09-21 11:17:43.646168 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263646168*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 104767
#260921 11:17:43 server id 1  end_log_pos 104957 CRC32 0xb2fa2e61 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4812
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add unique `announcements_slug_unique`(`slug`)
/*!*/;
# at 104957
#260921 11:17:43 server id 1  end_log_pos 105036 CRC32 0x86809c6d 	Anonymous_GTID	last_committed=192	sequence_number=193	rbr_only=yes	original_committed_timestamp=1789964263656203	immediate_commit_timestamp=1789964263656203	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964263656203 (2026-09-21 11:17:43.656203 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263656203 (2026-09-21 11:17:43.656203 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263656203*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 105036
#260921 11:17:43 server id 1  end_log_pos 105125 CRC32 0x6b5aea67 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964263/*!*/;
BEGIN
/*!*/;
# at 105125
#260921 11:17:43 server id 1  end_log_pos 105202 CRC32 0xc3068b6b 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 105202
#260921 11:17:43 server id 1  end_log_pos 105292 CRC32 0xd165caa3 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
56+wahMBAAAATQAAAPKaAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4GuLBsM=
56+wah4BAAAAWgAAAEybAQAAALoAAAAAAAEAAgAD/wAJAAAALAAyMDI2XzA5XzE0XzAwMDAwMV9j
cmVhdGVfYW5ub3VuY2VtZW50c190YWJsZQEAAACjymXR
'/*!*/;
# at 105292
#260921 11:17:43 server id 1  end_log_pos 105323 CRC32 0xb8a33df7 	Xid = 4815
COMMIT/*!*/;
# at 105323
#260921 11:17:43 server id 1  end_log_pos 105402 CRC32 0x98f9c5cd 	Anonymous_GTID	last_committed=193	sequence_number=194	rbr_only=no	original_committed_timestamp=1789964263685582	immediate_commit_timestamp=1789964263685582	transaction_length=720
# original_commit_timestamp=1789964263685582 (2026-09-21 11:17:43.685582 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263685582 (2026-09-21 11:17:43.685582 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263685582*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 105402
#260921 11:17:43 server id 1  end_log_pos 106043 CRC32 0xba0a8d8e 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4818
SET TIMESTAMP=1789964263/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `activity_logs` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned null, `user_name` varchar(255) null, `user_role` varchar(255) null, `module` varchar(255) not null, `action` varchar(255) not null, `description` text not null, `subject_type` varchar(255) null, `subject_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` varchar(500) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 106043
#260921 11:17:43 server id 1  end_log_pos 106122 CRC32 0x90843f33 	Anonymous_GTID	last_committed=194	sequence_number=195	rbr_only=no	original_committed_timestamp=1789964263801821	immediate_commit_timestamp=1789964263801821	transaction_length=338
# original_commit_timestamp=1789964263801821 (2026-09-21 11:17:43.801821 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263801821 (2026-09-21 11:17:43.801821 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263801821*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 106122
#260921 11:17:43 server id 1  end_log_pos 106381 CRC32 0x554de3e4 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4821
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add constraint `activity_logs_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 106381
#260921 11:17:43 server id 1  end_log_pos 106460 CRC32 0x69597ccc 	Anonymous_GTID	last_committed=195	sequence_number=196	rbr_only=no	original_committed_timestamp=1789964263852323	immediate_commit_timestamp=1789964263852323	transaction_length=279
# original_commit_timestamp=1789964263852323 (2026-09-21 11:17:43.852323 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263852323 (2026-09-21 11:17:43.852323 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263852323*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 106460
#260921 11:17:43 server id 1  end_log_pos 106660 CRC32 0xc81df0d8 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4824
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_created_at_index`(`created_at`)
/*!*/;
# at 106660
#260921 11:17:43 server id 1  end_log_pos 106739 CRC32 0x41588419 	Anonymous_GTID	last_committed=196	sequence_number=197	rbr_only=no	original_committed_timestamp=1789964263880792	immediate_commit_timestamp=1789964263880792	transaction_length=288
# original_commit_timestamp=1789964263880792 (2026-09-21 11:17:43.880792 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263880792 (2026-09-21 11:17:43.880792 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263880792*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 106739
#260921 11:17:43 server id 1  end_log_pos 106948 CRC32 0x610d2f33 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4827
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_action_index`(`module`, `action`)
/*!*/;
# at 106948
#260921 11:17:43 server id 1  end_log_pos 107027 CRC32 0xbabdb0bb 	Anonymous_GTID	last_committed=197	sequence_number=198	rbr_only=no	original_committed_timestamp=1789964263918115	immediate_commit_timestamp=1789964263918115	transaction_length=271
# original_commit_timestamp=1789964263918115 (2026-09-21 11:17:43.918115 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263918115 (2026-09-21 11:17:43.918115 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263918115*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 107027
#260921 11:17:43 server id 1  end_log_pos 107219 CRC32 0x0b3a3376 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4830
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_index`(`module`)
/*!*/;
# at 107219
#260921 11:17:43 server id 1  end_log_pos 107298 CRC32 0x9bfd2af3 	Anonymous_GTID	last_committed=198	sequence_number=199	rbr_only=no	original_committed_timestamp=1789964263952007	immediate_commit_timestamp=1789964263952007	transaction_length=271
# original_commit_timestamp=1789964263952007 (2026-09-21 11:17:43.952007 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263952007 (2026-09-21 11:17:43.952007 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263952007*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 107298
#260921 11:17:43 server id 1  end_log_pos 107490 CRC32 0xc0f93877 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4833
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_action_index`(`action`)
/*!*/;
# at 107490
#260921 11:17:43 server id 1  end_log_pos 107569 CRC32 0xad48ca0a 	Anonymous_GTID	last_committed=199	sequence_number=200	rbr_only=no	original_committed_timestamp=1789964263989281	immediate_commit_timestamp=1789964263989281	transaction_length=283
# original_commit_timestamp=1789964263989281 (2026-09-21 11:17:43.989281 SE Asia Standard Time)
# immediate_commit_timestamp=1789964263989281 (2026-09-21 11:17:43.989281 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964263989281*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 107569
#260921 11:17:43 server id 1  end_log_pos 107773 CRC32 0xea126d2c 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4836
SET TIMESTAMP=1789964263/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_subject_type_index`(`subject_type`)
/*!*/;
# at 107773
#260921 11:17:44 server id 1  end_log_pos 107852 CRC32 0x151391d1 	Anonymous_GTID	last_committed=200	sequence_number=201	rbr_only=yes	original_committed_timestamp=1789964264001304	immediate_commit_timestamp=1789964264001304	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964264001304 (2026-09-21 11:17:44.001304 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264001304 (2026-09-21 11:17:44.001304 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264001304*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 107852
#260921 11:17:44 server id 1  end_log_pos 107941 CRC32 0x81fd95e9 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964264/*!*/;
BEGIN
/*!*/;
# at 107941
#260921 11:17:44 server id 1  end_log_pos 108018 CRC32 0xe5de1095 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 108018
#260921 11:17:44 server id 1  end_log_pos 108108 CRC32 0x33fb4b21 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
6K+wahMBAAAATQAAAPKlAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4JUQ3uU=
6K+wah4BAAAAWgAAAEymAQAAALoAAAAAAAEAAgAD/wAKAAAALAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfYWN0aXZpdHlfbG9nc190YWJsZQEAAAAhS/sz
'/*!*/;
# at 108108
#260921 11:17:44 server id 1  end_log_pos 108139 CRC32 0xc2325949 	Xid = 4839
COMMIT/*!*/;
# at 108139
#260921 11:17:44 server id 1  end_log_pos 108218 CRC32 0xd7429cf3 	Anonymous_GTID	last_committed=201	sequence_number=202	rbr_only=no	original_committed_timestamp=1789964264025251	immediate_commit_timestamp=1789964264025251	transaction_length=668
# original_commit_timestamp=1789964264025251 (2026-09-21 11:17:44.025251 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264025251 (2026-09-21 11:17:44.025251 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264025251*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 108218
#260921 11:17:44 server id 1  end_log_pos 108807 CRC32 0xc77d7ff4 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4842
SET TIMESTAMP=1789964264/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `galleries` (`id` bigint unsigned not null auto_increment primary key, `judul` varchar(255) not null, `kategori` enum('KEGIATAN', 'FASILITAS', 'DOKUMENTASI', 'SEREMONIAL') not null, `deskripsi` text null, `file_gambar` varchar(255) not null, `tanggal_kegiatan` date not null, `status` enum('publikasi', 'draft') not null default 'publikasi', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 108807
#260921 11:17:44 server id 1  end_log_pos 108886 CRC32 0x6073c383 	Anonymous_GTID	last_committed=202	sequence_number=203	rbr_only=no	original_committed_timestamp=1789964264060552	immediate_commit_timestamp=1789964264060552	transaction_length=267
# original_commit_timestamp=1789964264060552 (2026-09-21 11:17:44.060552 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264060552 (2026-09-21 11:17:44.060552 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264060552*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 108886
#260921 11:17:44 server id 1  end_log_pos 109074 CRC32 0x681313f9 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4845
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_kategori_index`(`kategori`)
/*!*/;
# at 109074
#260921 11:17:44 server id 1  end_log_pos 109153 CRC32 0x00a57609 	Anonymous_GTID	last_committed=203	sequence_number=204	rbr_only=no	original_committed_timestamp=1789964264101812	immediate_commit_timestamp=1789964264101812	transaction_length=263
# original_commit_timestamp=1789964264101812 (2026-09-21 11:17:44.101812 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264101812 (2026-09-21 11:17:44.101812 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264101812*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 109153
#260921 11:17:44 server id 1  end_log_pos 109337 CRC32 0x1e9972d4 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4848
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_status_index`(`status`)
/*!*/;
# at 109337
#260921 11:17:44 server id 1  end_log_pos 109416 CRC32 0x776594f0 	Anonymous_GTID	last_committed=204	sequence_number=205	rbr_only=no	original_committed_timestamp=1789964264134947	immediate_commit_timestamp=1789964264134947	transaction_length=283
# original_commit_timestamp=1789964264134947 (2026-09-21 11:17:44.134947 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264134947 (2026-09-21 11:17:44.134947 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264134947*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 109416
#260921 11:17:44 server id 1  end_log_pos 109620 CRC32 0x97727133 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4851
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_tanggal_kegiatan_index`(`tanggal_kegiatan`)
/*!*/;
# at 109620
#260921 11:17:44 server id 1  end_log_pos 109699 CRC32 0x3bcd6e6b 	Anonymous_GTID	last_committed=205	sequence_number=206	rbr_only=yes	original_committed_timestamp=1789964264143963	immediate_commit_timestamp=1789964264143963	transaction_length=362
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964264143963 (2026-09-21 11:17:44.143963 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264143963 (2026-09-21 11:17:44.143963 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264143963*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 109699
#260921 11:17:44 server id 1  end_log_pos 109788 CRC32 0x2f6b2d5e 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964264/*!*/;
BEGIN
/*!*/;
# at 109788
#260921 11:17:44 server id 1  end_log_pos 109865 CRC32 0xd3c2dc7d 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 109865
#260921 11:17:44 server id 1  end_log_pos 109951 CRC32 0x4a9b65b6 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
6K+wahMBAAAATQAAACmtAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4H3cwtM=
6K+wah4BAAAAVgAAAH+tAQAAALoAAAAAAAEAAgAD/wALAAAAKAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfZ2FsbGVyaWVzX3RhYmxlAQAAALZlm0o=
'/*!*/;
# at 109951
#260921 11:17:44 server id 1  end_log_pos 109982 CRC32 0x7855e595 	Xid = 4854
COMMIT/*!*/;
# at 109982
#260921 11:17:44 server id 1  end_log_pos 110061 CRC32 0x4502e32c 	Anonymous_GTID	last_committed=206	sequence_number=207	rbr_only=no	original_committed_timestamp=1789964264173511	immediate_commit_timestamp=1789964264173511	transaction_length=665
# original_commit_timestamp=1789964264173511 (2026-09-21 11:17:44.173511 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264173511 (2026-09-21 11:17:44.173511 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264173511*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 110061
#260921 11:17:44 server id 1  end_log_pos 110647 CRC32 0xec8fef42 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4857
SET TIMESTAMP=1789964264/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `contact_messages` (`id` bigint unsigned not null auto_increment primary key, `nama` varchar(150) not null, `email` varchar(255) not null, `telepon` varchar(25) not null, `kategori` varchar(30) not null, `subjek` varchar(255) not null, `pesan` text not null, `status` varchar(20) not null default 'belum_dibaca', `read_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 110647
#260921 11:17:44 server id 1  end_log_pos 110726 CRC32 0x5c0d1264 	Anonymous_GTID	last_committed=207	sequence_number=208	rbr_only=no	original_committed_timestamp=1789964264201218	immediate_commit_timestamp=1789964264201218	transaction_length=277
# original_commit_timestamp=1789964264201218 (2026-09-21 11:17:44.201218 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264201218 (2026-09-21 11:17:44.201218 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264201218*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 110726
#260921 11:17:44 server id 1  end_log_pos 110924 CRC32 0xb282b45f 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4860
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `contact_messages` add index `contact_messages_status_index`(`status`)
/*!*/;
# at 110924
#260921 11:17:44 server id 1  end_log_pos 111003 CRC32 0x15f0be96 	Anonymous_GTID	last_committed=208	sequence_number=209	rbr_only=yes	original_committed_timestamp=1789964264212104	immediate_commit_timestamp=1789964264212104	transaction_length=369
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964264212104 (2026-09-21 11:17:44.212104 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264212104 (2026-09-21 11:17:44.212104 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264212104*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 111003
#260921 11:17:44 server id 1  end_log_pos 111092 CRC32 0xe9910821 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964264/*!*/;
BEGIN
/*!*/;
# at 111092
#260921 11:17:44 server id 1  end_log_pos 111169 CRC32 0x72412b13 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 111169
#260921 11:17:44 server id 1  end_log_pos 111262 CRC32 0xdcd4674e 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
6K+wahMBAAAATQAAAEGyAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4BMrQXI=
6K+wah4BAAAAXQAAAJ6yAQAAALoAAAAAAAEAAgAD/wAMAAAALwAyMDI2XzA5XzE1XzAwMDAwMV9j
cmVhdGVfY29udGFjdF9tZXNzYWdlc190YWJsZQEAAABOZ9Tc
'/*!*/;
# at 111262
#260921 11:17:44 server id 1  end_log_pos 111293 CRC32 0x4568d052 	Xid = 4863
COMMIT/*!*/;
# at 111293
#260921 11:17:44 server id 1  end_log_pos 111372 CRC32 0x1a336776 	Anonymous_GTID	last_committed=209	sequence_number=210	rbr_only=no	original_committed_timestamp=1789964264240159	immediate_commit_timestamp=1789964264240159	transaction_length=671
# original_commit_timestamp=1789964264240159 (2026-09-21 11:17:44.240159 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264240159 (2026-09-21 11:17:44.240159 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264240159*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 111372
#260921 11:17:44 server id 1  end_log_pos 111964 CRC32 0x14db9b82 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4866
SET TIMESTAMP=1789964264/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `pages` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `status` varchar(20) not null default 'draft', `visibility` varchar(20) not null default 'public', `show_in_list` tinyint(1) not null default '1', `created_by` bigint unsigned null, `updated_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 111964
#260921 11:17:44 server id 1  end_log_pos 112043 CRC32 0x2b49154d 	Anonymous_GTID	last_committed=210	sequence_number=211	rbr_only=no	original_committed_timestamp=1789964264324134	immediate_commit_timestamp=1789964264324134	transaction_length=328
# original_commit_timestamp=1789964264324134 (2026-09-21 11:17:44.324134 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264324134 (2026-09-21 11:17:44.324134 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264324134*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 112043
#260921 11:17:44 server id 1  end_log_pos 112292 CRC32 0xf9f509f7 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4869
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add constraint `pages_created_by_foreign` foreign key (`created_by`) references `users` (`id`) on delete set null
/*!*/;
# at 112292
#260921 11:17:44 server id 1  end_log_pos 112371 CRC32 0xf70f92d3 	Anonymous_GTID	last_committed=211	sequence_number=212	rbr_only=no	original_committed_timestamp=1789964264416750	immediate_commit_timestamp=1789964264416750	transaction_length=328
# original_commit_timestamp=1789964264416750 (2026-09-21 11:17:44.416750 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264416750 (2026-09-21 11:17:44.416750 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264416750*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 112371
#260921 11:17:44 server id 1  end_log_pos 112620 CRC32 0x99cb4b80 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4872
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add constraint `pages_updated_by_foreign` foreign key (`updated_by`) references `users` (`id`) on delete set null
/*!*/;
# at 112620
#260921 11:17:44 server id 1  end_log_pos 112699 CRC32 0x09004ef1 	Anonymous_GTID	last_committed=212	sequence_number=213	rbr_only=no	original_committed_timestamp=1789964264452406	immediate_commit_timestamp=1789964264452406	transaction_length=253
# original_commit_timestamp=1789964264452406 (2026-09-21 11:17:44.452406 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264452406 (2026-09-21 11:17:44.452406 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264452406*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 112699
#260921 11:17:44 server id 1  end_log_pos 112873 CRC32 0x2b8f03f7 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4875
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add unique `pages_slug_unique`(`slug`)
/*!*/;
# at 112873
#260921 11:17:44 server id 1  end_log_pos 112952 CRC32 0x8161b764 	Anonymous_GTID	last_committed=213	sequence_number=214	rbr_only=no	original_committed_timestamp=1789964264486758	immediate_commit_timestamp=1789964264486758	transaction_length=255
# original_commit_timestamp=1789964264486758 (2026-09-21 11:17:44.486758 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264486758 (2026-09-21 11:17:44.486758 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264486758*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 112952
#260921 11:17:44 server id 1  end_log_pos 113128 CRC32 0x5cd85bbb 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4878
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add index `pages_status_index`(`status`)
/*!*/;
# at 113128
#260921 11:17:44 server id 1  end_log_pos 113207 CRC32 0x46806d28 	Anonymous_GTID	last_committed=214	sequence_number=215	rbr_only=no	original_committed_timestamp=1789964264517766	immediate_commit_timestamp=1789964264517766	transaction_length=263
# original_commit_timestamp=1789964264517766 (2026-09-21 11:17:44.517766 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264517766 (2026-09-21 11:17:44.517766 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264517766*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 113207
#260921 11:17:44 server id 1  end_log_pos 113391 CRC32 0xf9ae8779 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4881
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add index `pages_visibility_index`(`visibility`)
/*!*/;
# at 113391
#260921 11:17:44 server id 1  end_log_pos 113470 CRC32 0x9792c143 	Anonymous_GTID	last_committed=215	sequence_number=216	rbr_only=no	original_committed_timestamp=1789964264561584	immediate_commit_timestamp=1789964264561584	transaction_length=409
# original_commit_timestamp=1789964264561584 (2026-09-21 11:17:44.561584 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264561584 (2026-09-21 11:17:44.561584 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264561584*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 113470
#260921 11:17:44 server id 1  end_log_pos 113800 CRC32 0xc5f0fea4 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4884
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `page_role` (`id` bigint unsigned not null auto_increment primary key, `page_id` bigint unsigned not null, `role_id` bigint unsigned not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 113800
#260921 11:17:44 server id 1  end_log_pos 113879 CRC32 0xe60ec225 	Anonymous_GTID	last_committed=216	sequence_number=217	rbr_only=no	original_committed_timestamp=1789964264658759	immediate_commit_timestamp=1789964264658759	transaction_length=329
# original_commit_timestamp=1789964264658759 (2026-09-21 11:17:44.658759 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264658759 (2026-09-21 11:17:44.658759 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264658759*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 113879
#260921 11:17:44 server id 1  end_log_pos 114129 CRC32 0x1951bdce 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4887
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add constraint `page_role_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete cascade
/*!*/;
# at 114129
#260921 11:17:44 server id 1  end_log_pos 114208 CRC32 0x835c74e1 	Anonymous_GTID	last_committed=217	sequence_number=218	rbr_only=no	original_committed_timestamp=1789964264735770	immediate_commit_timestamp=1789964264735770	transaction_length=329
# original_commit_timestamp=1789964264735770 (2026-09-21 11:17:44.735770 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264735770 (2026-09-21 11:17:44.735770 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264735770*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 114208
#260921 11:17:44 server id 1  end_log_pos 114458 CRC32 0x7b931631 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4890
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add constraint `page_role_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 114458
#260921 11:17:44 server id 1  end_log_pos 114537 CRC32 0xb6610b86 	Anonymous_GTID	last_committed=218	sequence_number=219	rbr_only=no	original_committed_timestamp=1789964264799721	immediate_commit_timestamp=1789964264799721	transaction_length=286
# original_commit_timestamp=1789964264799721 (2026-09-21 11:17:44.799721 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264799721 (2026-09-21 11:17:44.799721 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264799721*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 114537
#260921 11:17:44 server id 1  end_log_pos 114744 CRC32 0x0a9a5852 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4893
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add unique `page_role_page_id_role_id_unique`(`page_id`, `role_id`)
/*!*/;
# at 114744
#260921 11:17:44 server id 1  end_log_pos 114823 CRC32 0xfbb0b882 	Anonymous_GTID	last_committed=219	sequence_number=220	rbr_only=no	original_committed_timestamp=1789964264828709	immediate_commit_timestamp=1789964264828709	transaction_length=532
# original_commit_timestamp=1789964264828709 (2026-09-21 11:17:44.828709 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264828709 (2026-09-21 11:17:44.828709 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264828709*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 114823
#260921 11:17:44 server id 1  end_log_pos 115276 CRC32 0x7a3efb5b 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4896
SET TIMESTAMP=1789964264/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `page_sections` (`id` bigint unsigned not null auto_increment primary key, `page_id` bigint unsigned not null, `type` varchar(30) not null, `data` json null, `sort_order` int unsigned not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 115276
#260921 11:17:44 server id 1  end_log_pos 115355 CRC32 0xd40fdd8b 	Anonymous_GTID	last_committed=220	sequence_number=221	rbr_only=no	original_committed_timestamp=1789964264936356	immediate_commit_timestamp=1789964264936356	transaction_length=337
# original_commit_timestamp=1789964264936356 (2026-09-21 11:17:44.936356 SE Asia Standard Time)
# immediate_commit_timestamp=1789964264936356 (2026-09-21 11:17:44.936356 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964264936356*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 115355
#260921 11:17:44 server id 1  end_log_pos 115613 CRC32 0x7ab9854c 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4899
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_sections` add constraint `page_sections_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete cascade
/*!*/;
# at 115613
#260921 11:17:44 server id 1  end_log_pos 115692 CRC32 0x0b581e1e 	Anonymous_GTID	last_committed=221	sequence_number=222	rbr_only=no	original_committed_timestamp=1789964265104684	immediate_commit_timestamp=1789964265104684	transaction_length=279
# original_commit_timestamp=1789964265104684 (2026-09-21 11:17:45.104684 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265104684 (2026-09-21 11:17:45.104684 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265104684*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 115692
#260921 11:17:44 server id 1  end_log_pos 115892 CRC32 0x1716f5be 	Query	thread_id=66	exec_time=1	error_code=0	Xid = 4902
SET TIMESTAMP=1789964264/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_sections` add index `page_sections_sort_order_index`(`sort_order`)
/*!*/;
# at 115892
#260921 11:17:45 server id 1  end_log_pos 115971 CRC32 0x52d44b35 	Anonymous_GTID	last_committed=222	sequence_number=223	rbr_only=yes	original_committed_timestamp=1789964265120138	immediate_commit_timestamp=1789964265120138	transaction_length=359
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964265120138 (2026-09-21 11:17:45.120138 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265120138 (2026-09-21 11:17:45.120138 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265120138*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 115971
#260921 11:17:45 server id 1  end_log_pos 116060 CRC32 0x3f17c2b9 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964265/*!*/;
BEGIN
/*!*/;
# at 116060
#260921 11:17:45 server id 1  end_log_pos 116137 CRC32 0xccada35f 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 116137
#260921 11:17:45 server id 1  end_log_pos 116220 CRC32 0x2c9095bd 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
6a+wahMBAAAATQAAAKnFAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4F+jrcw=
6a+wah4BAAAAUwAAAPzFAQAAALoAAAAAAAEAAgAD/wANAAAAJQAyMDI2XzA5XzE1XzAwMDAwMV9j
cmVhdGVfcGFnZXNfdGFibGVzAQAAAL2VkCw=
'/*!*/;
# at 116220
#260921 11:17:45 server id 1  end_log_pos 116251 CRC32 0x817975a2 	Xid = 4905
COMMIT/*!*/;
# at 116251
#260921 11:17:45 server id 1  end_log_pos 116330 CRC32 0x443f3c89 	Anonymous_GTID	last_committed=223	sequence_number=224	rbr_only=no	original_committed_timestamp=1789964265153547	immediate_commit_timestamp=1789964265153547	transaction_length=743
# original_commit_timestamp=1789964265153547 (2026-09-21 11:17:45.153547 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265153547 (2026-09-21 11:17:45.153547 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265153547*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 116330
#260921 11:17:45 server id 1  end_log_pos 116994 CRC32 0x4aab847a 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4908
SET TIMESTAMP=1789964265/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `menus` (`id` bigint unsigned not null auto_increment primary key, `parent_id` bigint unsigned null, `label` varchar(255) not null, `type` varchar(20) not null default 'url', `route_name` varchar(255) null, `page_id` bigint unsigned null, `url` varchar(500) null, `icon` varchar(60) null, `sort_order` int unsigned not null default '0', `is_active` tinyint(1) not null default '1', `created_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 116994
#260921 11:17:45 server id 1  end_log_pos 117073 CRC32 0x2a7868fa 	Anonymous_GTID	last_committed=224	sequence_number=225	rbr_only=no	original_committed_timestamp=1789964265236595	immediate_commit_timestamp=1789964265236595	transaction_length=325
# original_commit_timestamp=1789964265236595 (2026-09-21 11:17:45.236595 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265236595 (2026-09-21 11:17:45.236595 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265236595*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 117073
#260921 11:17:45 server id 1  end_log_pos 117319 CRC32 0xa4555116 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4911
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_parent_id_foreign` foreign key (`parent_id`) references `menus` (`id`) on delete cascade
/*!*/;
# at 117319
#260921 11:17:45 server id 1  end_log_pos 117398 CRC32 0x3a49db18 	Anonymous_GTID	last_committed=225	sequence_number=226	rbr_only=no	original_committed_timestamp=1789964265379662	immediate_commit_timestamp=1789964265379662	transaction_length=322
# original_commit_timestamp=1789964265379662 (2026-09-21 11:17:45.379662 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265379662 (2026-09-21 11:17:45.379662 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265379662*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 117398
#260921 11:17:45 server id 1  end_log_pos 117641 CRC32 0x8482250f 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4914
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete set null
/*!*/;
# at 117641
#260921 11:17:45 server id 1  end_log_pos 117720 CRC32 0xa9e179eb 	Anonymous_GTID	last_committed=226	sequence_number=227	rbr_only=no	original_committed_timestamp=1789964265525072	immediate_commit_timestamp=1789964265525072	transaction_length=328
# original_commit_timestamp=1789964265525072 (2026-09-21 11:17:45.525072 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265525072 (2026-09-21 11:17:45.525072 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265525072*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 117720
#260921 11:17:45 server id 1  end_log_pos 117969 CRC32 0xa27563e4 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4917
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_created_by_foreign` foreign key (`created_by`) references `users` (`id`) on delete set null
/*!*/;
# at 117969
#260921 11:17:45 server id 1  end_log_pos 118048 CRC32 0x9f4e79d3 	Anonymous_GTID	last_committed=227	sequence_number=228	rbr_only=no	original_committed_timestamp=1789964265580870	immediate_commit_timestamp=1789964265580870	transaction_length=286
# original_commit_timestamp=1789964265580870 (2026-09-21 11:17:45.580870 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265580870 (2026-09-21 11:17:45.580870 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265580870*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 118048
#260921 11:17:45 server id 1  end_log_pos 118255 CRC32 0x7fd92511 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4920
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_parent_id_sort_order_index`(`parent_id`, `sort_order`)
/*!*/;
# at 118255
#260921 11:17:45 server id 1  end_log_pos 118334 CRC32 0xa25477d3 	Anonymous_GTID	last_committed=228	sequence_number=229	rbr_only=no	original_committed_timestamp=1789964265625028	immediate_commit_timestamp=1789964265625028	transaction_length=263
# original_commit_timestamp=1789964265625028 (2026-09-21 11:17:45.625028 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265625028 (2026-09-21 11:17:45.625028 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265625028*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 118334
#260921 11:17:45 server id 1  end_log_pos 118518 CRC32 0x7d34cb61 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4923
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_sort_order_index`(`sort_order`)
/*!*/;
# at 118518
#260921 11:17:45 server id 1  end_log_pos 118597 CRC32 0xd7b40658 	Anonymous_GTID	last_committed=229	sequence_number=230	rbr_only=no	original_committed_timestamp=1789964265674621	immediate_commit_timestamp=1789964265674621	transaction_length=261
# original_commit_timestamp=1789964265674621 (2026-09-21 11:17:45.674621 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265674621 (2026-09-21 11:17:45.674621 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265674621*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 118597
#260921 11:17:45 server id 1  end_log_pos 118779 CRC32 0xd6e2da1a 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4926
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_is_active_index`(`is_active`)
/*!*/;
# at 118779
#260921 11:17:45 server id 1  end_log_pos 118858 CRC32 0x3eb412b8 	Anonymous_GTID	last_committed=230	sequence_number=231	rbr_only=yes	original_committed_timestamp=1789964265687358	immediate_commit_timestamp=1789964265687358	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964265687358 (2026-09-21 11:17:45.687358 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265687358 (2026-09-21 11:17:45.687358 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265687358*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 118858
#260921 11:17:45 server id 1  end_log_pos 118947 CRC32 0xd9cd3fad 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964265/*!*/;
BEGIN
/*!*/;
# at 118947
#260921 11:17:45 server id 1  end_log_pos 119024 CRC32 0xa483821b 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 119024
#260921 11:17:45 server id 1  end_log_pos 119106 CRC32 0xa9e9048c 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
6a+wahMBAAAATQAAAPDQAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4BuCg6Q=
6a+wah4BAAAAUgAAAELRAQAAALoAAAAAAAEAAgAD/wAOAAAAJAAyMDI2XzA5XzE1XzAwMDAwMl9j
cmVhdGVfbWVudXNfdGFibGUBAAAAjATpqQ==
'/*!*/;
# at 119106
#260921 11:17:45 server id 1  end_log_pos 119137 CRC32 0x735b07f0 	Xid = 4929
COMMIT/*!*/;
# at 119137
#260921 11:17:45 server id 1  end_log_pos 119216 CRC32 0x660d3982 	Anonymous_GTID	last_committed=231	sequence_number=232	rbr_only=no	original_committed_timestamp=1789964265717737	immediate_commit_timestamp=1789964265717737	transaction_length=276
# original_commit_timestamp=1789964265717737 (2026-09-21 11:17:45.717737 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265717737 (2026-09-21 11:17:45.717737 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265717737*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 119216
#260921 11:17:45 server id 1  end_log_pos 119413 CRC32 0x5e3cc618 	Query	thread_id=66	exec_time=0	error_code=0	Xid = 4932
SET TIMESTAMP=1789964265/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add `target` varchar(10) not null default '_self' after `url`
/*!*/;
# at 119413
#260921 11:17:45 server id 1  end_log_pos 119492 CRC32 0xdb0c1a2d 	Anonymous_GTID	last_committed=232	sequence_number=233	rbr_only=yes	original_committed_timestamp=1789964265743207	immediate_commit_timestamp=1789964265743207	transaction_length=365
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964265743207 (2026-09-21 11:17:45.743207 SE Asia Standard Time)
# immediate_commit_timestamp=1789964265743207 (2026-09-21 11:17:45.743207 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964265743207*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 119492
#260921 11:17:45 server id 1  end_log_pos 119581 CRC32 0xd862fa2e 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789964265/*!*/;
BEGIN
/*!*/;
# at 119581
#260921 11:17:45 server id 1  end_log_pos 119658 CRC32 0x7395ad89 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 186
# at 119658
#260921 11:17:45 server id 1  end_log_pos 119747 CRC32 0xa59089be 	Write_rows: table id 186 flags: STMT_END_F

BINLOG '
6a+wahMBAAAATQAAAGrTAQAAALoAAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4ImtlXM=
6a+wah4BAAAAWQAAAMPTAQAAALoAAAAAAAEAAgAD/wAPAAAAKwAyMDI2XzA5XzE1XzAwMDAwM19h
ZGRfdGFyZ2V0X3RvX21lbnVzX3RhYmxlAQAAAL6JkKU=
'/*!*/;
# at 119747
#260921 11:17:45 server id 1  end_log_pos 119778 CRC32 0x2a7a7105 	Xid = 4935
COMMIT/*!*/;
# at 119778
#260921 11:19:31 server id 1  end_log_pos 119857 CRC32 0xea575d68 	Anonymous_GTID	last_committed=233	sequence_number=234	rbr_only=no	original_committed_timestamp=1789964371505592	immediate_commit_timestamp=1789964371505592	transaction_length=508
# original_commit_timestamp=1789964371505592 (2026-09-21 11:19:31.505592 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371505592 (2026-09-21 11:19:31.505592 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371505592*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 119857
#260921 11:19:31 server id 1  end_log_pos 120286 CRC32 0x9235baab 	Query	thread_id=87	exec_time=0	error_code=0	Xid = 6343
SET TIMESTAMP=1789964371/*!*/;
SET @@session.pseudo_thread_id=87/*!*/;
SET @@session.foreign_key_checks=0/*!*/;
DROP TABLE `activity_logs`,`announcements`,`cache`,`cache_locks`,`contact_messages`,`failed_jobs`,`galleries`,`job_batches`,`jobs`,`menus`,`migrations`,`news`,`page_role`,`page_sections`,`pages`,`password_reset_tokens`,`permissions`,`role_permission`,`role_user`,`roles`,`sessions`,`users` /* generated by server */
/*!*/;
# at 120286
#260921 11:19:31 server id 1  end_log_pos 120365 CRC32 0xf2d11287 	Anonymous_GTID	last_committed=234	sequence_number=235	rbr_only=no	original_committed_timestamp=1789964371611523	immediate_commit_timestamp=1789964371611523	transaction_length=392
# original_commit_timestamp=1789964371611523 (2026-09-21 11:19:31.611523 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371611523 (2026-09-21 11:19:31.611523 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371611523*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 120365
#260921 11:19:31 server id 1  end_log_pos 120678 CRC32 0x3dd47126 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6358
SET TIMESTAMP=1789964371/*!*/;
SET @@session.foreign_key_checks=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `migrations` (`id` int unsigned not null auto_increment primary key, `migration` varchar(255) not null, `batch` int not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 120678
#260921 11:19:31 server id 1  end_log_pos 120757 CRC32 0x4ccee9a7 	Anonymous_GTID	last_committed=235	sequence_number=236	rbr_only=no	original_committed_timestamp=1789964371668661	immediate_commit_timestamp=1789964371668661	transaction_length=560
# original_commit_timestamp=1789964371668661 (2026-09-21 11:19:31.668661 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371668661 (2026-09-21 11:19:31.668661 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371668661*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 120757
#260921 11:19:31 server id 1  end_log_pos 121238 CRC32 0x93c6666f 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6373
SET TIMESTAMP=1789964371/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 121238
#260921 11:19:31 server id 1  end_log_pos 121317 CRC32 0x20d3e3c5 	Anonymous_GTID	last_committed=236	sequence_number=237	rbr_only=no	original_committed_timestamp=1789964371726389	immediate_commit_timestamp=1789964371726389	transaction_length=255
# original_commit_timestamp=1789964371726389 (2026-09-21 11:19:31.726389 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371726389 (2026-09-21 11:19:31.726389 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371726389*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 121317
#260921 11:19:31 server id 1  end_log_pos 121493 CRC32 0x4133fa0e 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6376
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add unique `users_email_unique`(`email`)
/*!*/;
# at 121493
#260921 11:19:31 server id 1  end_log_pos 121572 CRC32 0xbca6b49d 	Anonymous_GTID	last_committed=237	sequence_number=238	rbr_only=no	original_committed_timestamp=1789964371743231	immediate_commit_timestamp=1789964371743231	transaction_length=407
# original_commit_timestamp=1789964371743231 (2026-09-21 11:19:31.743231 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371743231 (2026-09-21 11:19:31.743231 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371743231*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 121572
#260921 11:19:31 server id 1  end_log_pos 121900 CRC32 0x8af3bdea 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6379
SET TIMESTAMP=1789964371/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `password_reset_tokens` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null, primary key (`email`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 121900
#260921 11:19:31 server id 1  end_log_pos 121979 CRC32 0x0ac0da12 	Anonymous_GTID	last_committed=238	sequence_number=239	rbr_only=no	original_committed_timestamp=1789964371757305	immediate_commit_timestamp=1789964371757305	transaction_length=472
# original_commit_timestamp=1789964371757305 (2026-09-21 11:19:31.757305 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371757305 (2026-09-21 11:19:31.757305 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371757305*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 121979
#260921 11:19:31 server id 1  end_log_pos 122372 CRC32 0x20792639 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6382
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `sessions` (`id` varchar(255) not null, `user_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` text null, `payload` longtext not null, `last_activity` int not null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 122372
#260921 11:19:31 server id 1  end_log_pos 122451 CRC32 0xc30857fc 	Anonymous_GTID	last_committed=239	sequence_number=240	rbr_only=no	original_committed_timestamp=1789964371796174	immediate_commit_timestamp=1789964371796174	transaction_length=263
# original_commit_timestamp=1789964371796174 (2026-09-21 11:19:31.796174 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371796174 (2026-09-21 11:19:31.796174 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371796174*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 122451
#260921 11:19:31 server id 1  end_log_pos 122635 CRC32 0xf499a04e 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6385
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `sessions` add index `sessions_user_id_index`(`user_id`)
/*!*/;
# at 122635
#260921 11:19:31 server id 1  end_log_pos 122714 CRC32 0xa54f73cf 	Anonymous_GTID	last_committed=240	sequence_number=241	rbr_only=no	original_committed_timestamp=1789964371816062	immediate_commit_timestamp=1789964371816062	transaction_length=275
# original_commit_timestamp=1789964371816062 (2026-09-21 11:19:31.816062 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371816062 (2026-09-21 11:19:31.816062 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371816062*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 122714
#260921 11:19:31 server id 1  end_log_pos 122910 CRC32 0x5a0841f0 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6388
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `sessions` add index `sessions_last_activity_index`(`last_activity`)
/*!*/;
# at 122910
#260921 11:19:31 server id 1  end_log_pos 122989 CRC32 0x7b7a2443 	Anonymous_GTID	last_committed=241	sequence_number=242	rbr_only=yes	original_committed_timestamp=1789964371824138	immediate_commit_timestamp=1789964371824138	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964371824138 (2026-09-21 11:19:31.824138 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371824138 (2026-09-21 11:19:31.824138 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371824138*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 122989
#260921 11:19:31 server id 1  end_log_pos 123078 CRC32 0x2b12c97d 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964371/*!*/;
BEGIN
/*!*/;
# at 123078
#260921 11:19:31 server id 1  end_log_pos 123155 CRC32 0x72d3fdbb 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 123155
#260921 11:19:31 server id 1  end_log_pos 123237 CRC32 0xb8ae2131 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
U7CwahMBAAAATQAAABPhAQAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4Lv903I=
U7Cwah4BAAAAUgAAAGXhAQAAAA0BAAAAAAEAAgAD/wABAAAAJAAwMDAxXzAxXzAxXzAwMDAwMF9j
cmVhdGVfdXNlcnNfdGFibGUBAAAAMSGuuA==
'/*!*/;
# at 123237
#260921 11:19:31 server id 1  end_log_pos 123268 CRC32 0xa9382fdd 	Xid = 6391
COMMIT/*!*/;
# at 123268
#260921 11:19:31 server id 1  end_log_pos 123347 CRC32 0xaf7f3bcf 	Anonymous_GTID	last_committed=242	sequence_number=243	rbr_only=no	original_committed_timestamp=1789964371843132	immediate_commit_timestamp=1789964371843132	transaction_length=381
# original_commit_timestamp=1789964371843132 (2026-09-21 11:19:31.843132 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371843132 (2026-09-21 11:19:31.843132 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371843132*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 123347
#260921 11:19:31 server id 1  end_log_pos 123649 CRC32 0x820fd9cc 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6394
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `cache` (`key` varchar(255) not null, `value` mediumtext not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 123649
#260921 11:19:31 server id 1  end_log_pos 123728 CRC32 0xffbd34db 	Anonymous_GTID	last_committed=243	sequence_number=244	rbr_only=no	original_committed_timestamp=1789964371869906	immediate_commit_timestamp=1789964371869906	transaction_length=263
# original_commit_timestamp=1789964371869906 (2026-09-21 11:19:31.869906 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371869906 (2026-09-21 11:19:31.869906 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371869906*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 123728
#260921 11:19:31 server id 1  end_log_pos 123912 CRC32 0x1659a002 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6397
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `cache` add index `cache_expiration_index`(`expiration`)
/*!*/;
# at 123912
#260921 11:19:31 server id 1  end_log_pos 123991 CRC32 0x3aeb9467 	Anonymous_GTID	last_committed=244	sequence_number=245	rbr_only=no	original_committed_timestamp=1789964371886126	immediate_commit_timestamp=1789964371886126	transaction_length=389
# original_commit_timestamp=1789964371886126 (2026-09-21 11:19:31.886126 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371886126 (2026-09-21 11:19:31.886126 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371886126*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 123991
#260921 11:19:31 server id 1  end_log_pos 124301 CRC32 0x76238b76 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6400
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `cache_locks` (`key` varchar(255) not null, `owner` varchar(255) not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 124301
#260921 11:19:31 server id 1  end_log_pos 124380 CRC32 0xa3a7764d 	Anonymous_GTID	last_committed=245	sequence_number=246	rbr_only=no	original_committed_timestamp=1789964371907514	immediate_commit_timestamp=1789964371907514	transaction_length=275
# original_commit_timestamp=1789964371907514 (2026-09-21 11:19:31.907514 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371907514 (2026-09-21 11:19:31.907514 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371907514*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 124380
#260921 11:19:31 server id 1  end_log_pos 124576 CRC32 0x583f70d7 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6403
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `cache_locks` add index `cache_locks_expiration_index`(`expiration`)
/*!*/;
# at 124576
#260921 11:19:31 server id 1  end_log_pos 124655 CRC32 0xf6540377 	Anonymous_GTID	last_committed=246	sequence_number=247	rbr_only=yes	original_committed_timestamp=1789964371913677	immediate_commit_timestamp=1789964371913677	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964371913677 (2026-09-21 11:19:31.913677 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371913677 (2026-09-21 11:19:31.913677 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371913677*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 124655
#260921 11:19:31 server id 1  end_log_pos 124744 CRC32 0x0fe45ecf 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964371/*!*/;
BEGIN
/*!*/;
# at 124744
#260921 11:19:31 server id 1  end_log_pos 124821 CRC32 0xd46e4be5 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 124821
#260921 11:19:31 server id 1  end_log_pos 124903 CRC32 0xbcc7d88c 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
U7CwahMBAAAATQAAAJXnAQAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4OVLbtQ=
U7Cwah4BAAAAUgAAAOfnAQAAAA0BAAAAAAEAAgAD/wACAAAAJAAwMDAxXzAxXzAxXzAwMDAwMV9j
cmVhdGVfY2FjaGVfdGFibGUBAAAAjNjHvA==
'/*!*/;
# at 124903
#260921 11:19:31 server id 1  end_log_pos 124934 CRC32 0xd906111a 	Xid = 6406
COMMIT/*!*/;
# at 124934
#260921 11:19:31 server id 1  end_log_pos 125013 CRC32 0x57bc14b4 	Anonymous_GTID	last_committed=247	sequence_number=248	rbr_only=no	original_committed_timestamp=1789964371931343	immediate_commit_timestamp=1789964371931343	transaction_length=537
# original_commit_timestamp=1789964371931343 (2026-09-21 11:19:31.931343 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371931343 (2026-09-21 11:19:31.931343 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371931343*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 125013
#260921 11:19:31 server id 1  end_log_pos 125471 CRC32 0x9f59f413 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6409
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `jobs` (`id` bigint unsigned not null auto_increment primary key, `queue` varchar(255) not null, `payload` longtext not null, `attempts` tinyint unsigned not null, `reserved_at` int unsigned null, `available_at` int unsigned not null, `created_at` int unsigned not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 125471
#260921 11:19:31 server id 1  end_log_pos 125548 CRC32 0xc00a22df 	Anonymous_GTID	last_committed=248	sequence_number=249	rbr_only=no	original_committed_timestamp=1789964371960284	immediate_commit_timestamp=1789964371960284	transaction_length=249
# original_commit_timestamp=1789964371960284 (2026-09-21 11:19:31.960284 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371960284 (2026-09-21 11:19:31.960284 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371960284*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 125548
#260921 11:19:31 server id 1  end_log_pos 125720 CRC32 0xed9a50c4 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6412
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `jobs` add index `jobs_queue_index`(`queue`)
/*!*/;
# at 125720
#260921 11:19:31 server id 1  end_log_pos 125799 CRC32 0x88f5efb4 	Anonymous_GTID	last_committed=249	sequence_number=250	rbr_only=no	original_committed_timestamp=1789964371987864	immediate_commit_timestamp=1789964371987864	transaction_length=582
# original_commit_timestamp=1789964371987864 (2026-09-21 11:19:31.987864 SE Asia Standard Time)
# immediate_commit_timestamp=1789964371987864 (2026-09-21 11:19:31.987864 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964371987864*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 125799
#260921 11:19:31 server id 1  end_log_pos 126302 CRC32 0x081605a1 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6415
SET TIMESTAMP=1789964371/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `job_batches` (`id` varchar(255) not null, `name` varchar(255) not null, `total_jobs` int not null, `pending_jobs` int not null, `failed_jobs` int not null, `failed_job_ids` longtext not null, `options` mediumtext null, `cancelled_at` int null, `created_at` int not null, `finished_at` int null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 126302
#260921 11:19:31 server id 1  end_log_pos 126381 CRC32 0x32182267 	Anonymous_GTID	last_committed=250	sequence_number=251	rbr_only=no	original_committed_timestamp=1789964372015626	immediate_commit_timestamp=1789964372015626	transaction_length=540
# original_commit_timestamp=1789964372015626 (2026-09-21 11:19:32.015626 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372015626 (2026-09-21 11:19:32.015626 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372015626*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 126381
#260921 11:19:31 server id 1  end_log_pos 126842 CRC32 0x4a941768 	Query	thread_id=88	exec_time=1	error_code=0	Xid = 6418
SET TIMESTAMP=1789964371/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `failed_jobs` (`id` bigint unsigned not null auto_increment primary key, `uuid` varchar(255) not null, `connection` text not null, `queue` text not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp not null default CURRENT_TIMESTAMP) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 126842
#260921 11:19:32 server id 1  end_log_pos 126921 CRC32 0x2a45dc04 	Anonymous_GTID	last_committed=251	sequence_number=252	rbr_only=no	original_committed_timestamp=1789964372037703	immediate_commit_timestamp=1789964372037703	transaction_length=265
# original_commit_timestamp=1789964372037703 (2026-09-21 11:19:32.037703 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372037703 (2026-09-21 11:19:32.037703 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372037703*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 126921
#260921 11:19:32 server id 1  end_log_pos 127107 CRC32 0x327f2624 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6421
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `failed_jobs` add unique `failed_jobs_uuid_unique`(`uuid`)
/*!*/;
# at 127107
#260921 11:19:32 server id 1  end_log_pos 127186 CRC32 0xa9327e40 	Anonymous_GTID	last_committed=252	sequence_number=253	rbr_only=yes	original_committed_timestamp=1789964372044194	immediate_commit_timestamp=1789964372044194	transaction_length=357
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964372044194 (2026-09-21 11:19:32.044194 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372044194 (2026-09-21 11:19:32.044194 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372044194*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 127186
#260921 11:19:32 server id 1  end_log_pos 127275 CRC32 0x4634eb6b 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964372/*!*/;
BEGIN
/*!*/;
# at 127275
#260921 11:19:32 server id 1  end_log_pos 127352 CRC32 0xc4b43d70 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 127352
#260921 11:19:32 server id 1  end_log_pos 127433 CRC32 0x51b05fa9 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VLCwahMBAAAATQAAAHjxAQAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4HA9tMQ=
VLCwah4BAAAAUQAAAMnxAQAAAA0BAAAAAAEAAgAD/wADAAAAIwAwMDAxXzAxXzAxXzAwMDAwMl9j
cmVhdGVfam9ic190YWJsZQEAAACpX7BR
'/*!*/;
# at 127433
#260921 11:19:32 server id 1  end_log_pos 127464 CRC32 0x9545edfc 	Xid = 6424
COMMIT/*!*/;
# at 127464
#260921 11:19:32 server id 1  end_log_pos 127543 CRC32 0xd11035f3 	Anonymous_GTID	last_committed=253	sequence_number=254	rbr_only=no	original_committed_timestamp=1789964372059634	immediate_commit_timestamp=1789964372059634	transaction_length=276
# original_commit_timestamp=1789964372059634 (2026-09-21 11:19:32.059634 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372059634 (2026-09-21 11:19:32.059634 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372059634*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 127543
#260921 11:19:32 server id 1  end_log_pos 127740 CRC32 0x5aa5c913 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6427
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `role` varchar(255) not null default 'user' after `email`
/*!*/;
# at 127740
#260921 11:19:32 server id 1  end_log_pos 127819 CRC32 0xc3bc225f 	Anonymous_GTID	last_committed=254	sequence_number=255	rbr_only=no	original_committed_timestamp=1789964372075798	immediate_commit_timestamp=1789964372075798	transaction_length=260
# original_commit_timestamp=1789964372075798 (2026-09-21 11:19:32.075798 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372075798 (2026-09-21 11:19:32.075798 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372075798*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 127819
#260921 11:19:32 server id 1  end_log_pos 128000 CRC32 0x8f1ffe2c 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6430
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `no_hp` varchar(20) null after `password`
/*!*/;
# at 128000
#260921 11:19:32 server id 1  end_log_pos 128077 CRC32 0x39597190 	Anonymous_GTID	last_committed=255	sequence_number=256	rbr_only=no	original_committed_timestamp=1789964372093289	immediate_commit_timestamp=1789964372093289	transaction_length=249
# original_commit_timestamp=1789964372093289 (2026-09-21 11:19:32.093289 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372093289 (2026-09-21 11:19:32.093289 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372093289*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 128077
#260921 11:19:32 server id 1  end_log_pos 128249 CRC32 0x86ee3320 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6433
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `alamat` text null after `no_hp`
/*!*/;
# at 128249
#260921 11:19:32 server id 1  end_log_pos 128328 CRC32 0x44bb35fd 	Anonymous_GTID	last_committed=256	sequence_number=257	rbr_only=yes	original_committed_timestamp=1789964372104248	immediate_commit_timestamp=1789964372104248	transaction_length=378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964372104248 (2026-09-21 11:19:32.104248 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372104248 (2026-09-21 11:19:32.104248 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372104248*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 128328
#260921 11:19:32 server id 1  end_log_pos 128417 CRC32 0x02475d33 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964372/*!*/;
BEGIN
/*!*/;
# at 128417
#260921 11:19:32 server id 1  end_log_pos 128494 CRC32 0xabb250f7 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 128494
#260921 11:19:32 server id 1  end_log_pos 128596 CRC32 0x12e7565c 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VLCwahMBAAAATQAAAO71AQAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4PdQsqs=
VLCwah4BAAAAZgAAAFT2AQAAAA0BAAAAAAEAAgAD/wAEAAAAOAAyMDI2XzA5XzA5XzAyMDUxNF9h
ZGRfdXNlcl9wcm9maWxlX2ZpZWxkc190b191c2Vyc190YWJsZQEAAABcVucS
'/*!*/;
# at 128596
#260921 11:19:32 server id 1  end_log_pos 128627 CRC32 0x90ad45f5 	Xid = 6436
COMMIT/*!*/;
# at 128627
#260921 11:19:32 server id 1  end_log_pos 128706 CRC32 0xabfc2e5f 	Anonymous_GTID	last_committed=257	sequence_number=258	rbr_only=no	original_committed_timestamp=1789964372134314	immediate_commit_timestamp=1789964372134314	transaction_length=498
# original_commit_timestamp=1789964372134314 (2026-09-21 11:19:32.134314 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372134314 (2026-09-21 11:19:32.134314 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372134314*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 128706
#260921 11:19:32 server id 1  end_log_pos 129125 CRC32 0xd265f82a 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6439
SET TIMESTAMP=1789964372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `roles` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(100) not null, `description` varchar(255) null, `status` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 129125
#260921 11:19:32 server id 1  end_log_pos 129204 CRC32 0xb85c2ccc 	Anonymous_GTID	last_committed=258	sequence_number=259	rbr_only=no	original_committed_timestamp=1789964372184544	immediate_commit_timestamp=1789964372184544	transaction_length=253
# original_commit_timestamp=1789964372184544 (2026-09-21 11:19:32.184544 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372184544 (2026-09-21 11:19:32.184544 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372184544*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 129204
#260921 11:19:32 server id 1  end_log_pos 129378 CRC32 0x686a3aaa 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6442
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `roles` add unique `roles_name_unique`(`name`)
/*!*/;
# at 129378
#260921 11:19:32 server id 1  end_log_pos 129457 CRC32 0xc28c3ee1 	Anonymous_GTID	last_committed=259	sequence_number=260	rbr_only=no	original_committed_timestamp=1789964372206496	immediate_commit_timestamp=1789964372206496	transaction_length=491
# original_commit_timestamp=1789964372206496 (2026-09-21 11:19:32.206496 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372206496 (2026-09-21 11:19:32.206496 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372206496*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 129457
#260921 11:19:32 server id 1  end_log_pos 129869 CRC32 0x308dfbb5 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6445
SET TIMESTAMP=1789964372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `permissions` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(100) not null, `display_name` varchar(255) null, `module` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 129869
#260921 11:19:32 server id 1  end_log_pos 129948 CRC32 0xe0d4954b 	Anonymous_GTID	last_committed=260	sequence_number=261	rbr_only=no	original_committed_timestamp=1789964372263366	immediate_commit_timestamp=1789964372263366	transaction_length=265
# original_commit_timestamp=1789964372263366 (2026-09-21 11:19:32.263366 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372263366 (2026-09-21 11:19:32.263366 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372263366*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 129948
#260921 11:19:32 server id 1  end_log_pos 130134 CRC32 0x2a70076f 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6448
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `permissions` add unique `permissions_name_unique`(`name`)
/*!*/;
# at 130134
#260921 11:19:32 server id 1  end_log_pos 130213 CRC32 0x1222f739 	Anonymous_GTID	last_committed=261	sequence_number=262	rbr_only=no	original_committed_timestamp=1789964372306312	immediate_commit_timestamp=1789964372306312	transaction_length=481
# original_commit_timestamp=1789964372306312 (2026-09-21 11:19:32.306312 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372306312 (2026-09-21 11:19:32.306312 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372306312*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 130213
#260921 11:19:32 server id 1  end_log_pos 130615 CRC32 0xaff957ab 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6451
SET TIMESTAMP=1789964372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `role_permission` (`id` bigint unsigned not null auto_increment primary key, `role_id` bigint unsigned not null, `permission_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 130615
#260921 11:19:32 server id 1  end_log_pos 130694 CRC32 0x3c7fc4f3 	Anonymous_GTID	last_committed=262	sequence_number=263	rbr_only=no	original_committed_timestamp=1789964372424505	immediate_commit_timestamp=1789964372424505	transaction_length=341
# original_commit_timestamp=1789964372424505 (2026-09-21 11:19:32.424505 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372424505 (2026-09-21 11:19:32.424505 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372424505*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 130694
#260921 11:19:32 server id 1  end_log_pos 130956 CRC32 0xfda63faa 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6454
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add constraint `role_permission_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 130956
#260921 11:19:32 server id 1  end_log_pos 131035 CRC32 0x863570fa 	Anonymous_GTID	last_committed=263	sequence_number=264	rbr_only=no	original_committed_timestamp=1789964372522986	immediate_commit_timestamp=1789964372522986	transaction_length=359
# original_commit_timestamp=1789964372522986 (2026-09-21 11:19:32.522986 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372522986 (2026-09-21 11:19:32.522986 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372522986*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 131035
#260921 11:19:32 server id 1  end_log_pos 131315 CRC32 0xb40b57f0 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6457
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add constraint `role_permission_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade
/*!*/;
# at 131315
#260921 11:19:32 server id 1  end_log_pos 131394 CRC32 0x63688459 	Anonymous_GTID	last_committed=264	sequence_number=265	rbr_only=no	original_committed_timestamp=1789964372554177	immediate_commit_timestamp=1789964372554177	transaction_length=310
# original_commit_timestamp=1789964372554177 (2026-09-21 11:19:32.554177 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372554177 (2026-09-21 11:19:32.554177 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372554177*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 131394
#260921 11:19:32 server id 1  end_log_pos 131625 CRC32 0xd7a73732 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6460
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_permission` add unique `role_permission_role_id_permission_id_unique`(`role_id`, `permission_id`)
/*!*/;
# at 131625
#260921 11:19:32 server id 1  end_log_pos 131704 CRC32 0xd30cd532 	Anonymous_GTID	last_committed=265	sequence_number=266	rbr_only=no	original_committed_timestamp=1789964372582277	immediate_commit_timestamp=1789964372582277	transaction_length=469
# original_commit_timestamp=1789964372582277 (2026-09-21 11:19:32.582277 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372582277 (2026-09-21 11:19:32.582277 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372582277*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 131704
#260921 11:19:32 server id 1  end_log_pos 132094 CRC32 0x965ef34b 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6463
SET TIMESTAMP=1789964372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `role_user` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `role_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 132094
#260921 11:19:32 server id 1  end_log_pos 132173 CRC32 0x635720cf 	Anonymous_GTID	last_committed=266	sequence_number=267	rbr_only=no	original_committed_timestamp=1789964372691362	immediate_commit_timestamp=1789964372691362	transaction_length=329
# original_commit_timestamp=1789964372691362 (2026-09-21 11:19:32.691362 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372691362 (2026-09-21 11:19:32.691362 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372691362*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 132173
#260921 11:19:32 server id 1  end_log_pos 132423 CRC32 0x4e5025bf 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6466
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add constraint `role_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade
/*!*/;
# at 132423
#260921 11:19:32 server id 1  end_log_pos 132502 CRC32 0x30dc8ae2 	Anonymous_GTID	last_committed=267	sequence_number=268	rbr_only=no	original_committed_timestamp=1789964372760794	immediate_commit_timestamp=1789964372760794	transaction_length=329
# original_commit_timestamp=1789964372760794 (2026-09-21 11:19:32.760794 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372760794 (2026-09-21 11:19:32.760794 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372760794*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 132502
#260921 11:19:32 server id 1  end_log_pos 132752 CRC32 0xc0ded025 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6469
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add constraint `role_user_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 132752
#260921 11:19:32 server id 1  end_log_pos 132831 CRC32 0xacef8952 	Anonymous_GTID	last_committed=268	sequence_number=269	rbr_only=no	original_committed_timestamp=1789964372784846	immediate_commit_timestamp=1789964372784846	transaction_length=286
# original_commit_timestamp=1789964372784846 (2026-09-21 11:19:32.784846 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372784846 (2026-09-21 11:19:32.784846 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372784846*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 132831
#260921 11:19:32 server id 1  end_log_pos 133038 CRC32 0x89205e96 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6472
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `role_user` add unique `role_user_user_id_role_id_unique`(`user_id`, `role_id`)
/*!*/;
# at 133038
#260921 11:19:32 server id 1  end_log_pos 133117 CRC32 0xaf9c5dca 	Anonymous_GTID	last_committed=269	sequence_number=270	rbr_only=yes	original_committed_timestamp=1789964372794190	immediate_commit_timestamp=1789964372794190	transaction_length=371
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964372794190 (2026-09-21 11:19:32.794190 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372794190 (2026-09-21 11:19:32.794190 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372794190*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 133117
#260921 11:19:32 server id 1  end_log_pos 133206 CRC32 0x12e9fa12 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964372/*!*/;
BEGIN
/*!*/;
# at 133206
#260921 11:19:32 server id 1  end_log_pos 133283 CRC32 0x633c219e 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 133283
#260921 11:19:32 server id 1  end_log_pos 133378 CRC32 0xa3b3e6cb 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VLCwahMBAAAATQAAAKMIAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4J4hPGM=
VLCwah4BAAAAXwAAAAIJAgAAAA0BAAAAAAEAAgAD/wAFAAAAMQAyMDI2XzA5XzEwXzAwMDAwMV9j
cmVhdGVfcm9sZXNfcGVybWlzc2lvbnNfdGFibGVzAQAAAMvms6M=
'/*!*/;
# at 133378
#260921 11:19:32 server id 1  end_log_pos 133409 CRC32 0x1573a684 	Xid = 6475
COMMIT/*!*/;
# at 133409
#260921 11:19:32 server id 1  end_log_pos 133486 CRC32 0x064eec09 	Anonymous_GTID	last_committed=270	sequence_number=271	rbr_only=no	original_committed_timestamp=1789964372826134	immediate_commit_timestamp=1789964372826134	transaction_length=247
# original_commit_timestamp=1789964372826134 (2026-09-21 11:19:32.826134 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372826134 (2026-09-21 11:19:32.826134 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372826134*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 133486
#260921 11:19:32 server id 1  end_log_pos 133656 CRC32 0x87dbac08 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6478
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add `role_id` bigint unsigned null
/*!*/;
# at 133656
#260921 11:19:32 server id 1  end_log_pos 133735 CRC32 0x1e417287 	Anonymous_GTID	last_committed=271	sequence_number=272	rbr_only=no	original_committed_timestamp=1789964372913256	immediate_commit_timestamp=1789964372913256	transaction_length=322
# original_commit_timestamp=1789964372913256 (2026-09-21 11:19:32.913256 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372913256 (2026-09-21 11:19:32.913256 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372913256*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 133735
#260921 11:19:32 server id 1  end_log_pos 133978 CRC32 0x1982b3b1 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6481
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `users` add constraint `users_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete set null
/*!*/;
# at 133978
#260921 11:19:32 server id 1  end_log_pos 134057 CRC32 0xe8f6b8a4 	Anonymous_GTID	last_committed=272	sequence_number=273	rbr_only=yes	original_committed_timestamp=1789964372928679	immediate_commit_timestamp=1789964372928679	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964372928679 (2026-09-21 11:19:32.928679 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372928679 (2026-09-21 11:19:32.928679 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372928679*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 134057
#260921 11:19:32 server id 1  end_log_pos 134146 CRC32 0xcfc7a0d7 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964372/*!*/;
BEGIN
/*!*/;
# at 134146
#260921 11:19:32 server id 1  end_log_pos 134223 CRC32 0xe32e0cda 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 134223
#260921 11:19:32 server id 1  end_log_pos 134313 CRC32 0xe8d886a9 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VLCwahMBAAAATQAAAE8MAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4NoMLuM=
VLCwah4BAAAAWgAAAKkMAgAAAA0BAAAAAAEAAgAD/wAGAAAALAAyMDI2XzA5XzEwXzAwMDAwMl9h
ZGRfcm9sZV9pZF90b191c2Vyc190YWJsZQEAAACphtjo
'/*!*/;
# at 134313
#260921 11:19:32 server id 1  end_log_pos 134344 CRC32 0x0c3fa99b 	Xid = 6484
COMMIT/*!*/;
# at 134344
#260921 11:19:32 server id 1  end_log_pos 134423 CRC32 0x2e661f46 	Anonymous_GTID	last_committed=273	sequence_number=274	rbr_only=no	original_committed_timestamp=1789964372958710	immediate_commit_timestamp=1789964372958710	transaction_length=747
# original_commit_timestamp=1789964372958710 (2026-09-21 11:19:32.958710 SE Asia Standard Time)
# immediate_commit_timestamp=1789964372958710 (2026-09-21 11:19:32.958710 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964372958710*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 134423
#260921 11:19:32 server id 1  end_log_pos 135091 CRC32 0x8c4b0cd3 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6490
SET TIMESTAMP=1789964372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `news` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `category` enum('umum', 'teknis', 'kegiatan', 'kepegawaian') not null, `excerpt` text not null, `content` longtext null, `image` varchar(255) null, `author` varchar(255) null, `is_published` tinyint(1) not null default '0', `published_at` timestamp null, `author_user_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 135091
#260921 11:19:32 server id 1  end_log_pos 135170 CRC32 0x5a971a6e 	Anonymous_GTID	last_committed=274	sequence_number=275	rbr_only=no	original_committed_timestamp=1789964373043462	immediate_commit_timestamp=1789964373043462	transaction_length=334
# original_commit_timestamp=1789964373043462 (2026-09-21 11:19:33.043462 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373043462 (2026-09-21 11:19:33.043462 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373043462*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 135170
#260921 11:19:32 server id 1  end_log_pos 135425 CRC32 0x51a898a6 	Query	thread_id=88	exec_time=1	error_code=0	Xid = 6493
SET TIMESTAMP=1789964372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add constraint `news_author_user_id_foreign` foreign key (`author_user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 135425
#260921 11:19:33 server id 1  end_log_pos 135504 CRC32 0x49734120 	Anonymous_GTID	last_committed=275	sequence_number=276	rbr_only=no	original_committed_timestamp=1789964373087765	immediate_commit_timestamp=1789964373087765	transaction_length=265
# original_commit_timestamp=1789964373087765 (2026-09-21 11:19:33.087765 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373087765 (2026-09-21 11:19:33.087765 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373087765*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 135504
#260921 11:19:33 server id 1  end_log_pos 135690 CRC32 0x54c00da5 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6496
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_is_published_index`(`is_published`)
/*!*/;
# at 135690
#260921 11:19:33 server id 1  end_log_pos 135769 CRC32 0x4bcd9e29 	Anonymous_GTID	last_committed=276	sequence_number=277	rbr_only=no	original_committed_timestamp=1789964373117952	immediate_commit_timestamp=1789964373117952	transaction_length=257
# original_commit_timestamp=1789964373117952 (2026-09-21 11:19:33.117952 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373117952 (2026-09-21 11:19:33.117952 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373117952*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 135769
#260921 11:19:33 server id 1  end_log_pos 135947 CRC32 0x7a414621 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6499
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_category_index`(`category`)
/*!*/;
# at 135947
#260921 11:19:33 server id 1  end_log_pos 136026 CRC32 0xf100cdf6 	Anonymous_GTID	last_committed=277	sequence_number=278	rbr_only=no	original_committed_timestamp=1789964373144409	immediate_commit_timestamp=1789964373144409	transaction_length=265
# original_commit_timestamp=1789964373144409 (2026-09-21 11:19:33.144409 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373144409 (2026-09-21 11:19:33.144409 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373144409*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 136026
#260921 11:19:33 server id 1  end_log_pos 136212 CRC32 0xb0ffeec9 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6502
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add index `news_published_at_index`(`published_at`)
/*!*/;
# at 136212
#260921 11:19:33 server id 1  end_log_pos 136289 CRC32 0x1a9b1142 	Anonymous_GTID	last_committed=278	sequence_number=279	rbr_only=no	original_committed_timestamp=1789964373181728	immediate_commit_timestamp=1789964373181728	transaction_length=249
# original_commit_timestamp=1789964373181728 (2026-09-21 11:19:33.181728 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373181728 (2026-09-21 11:19:33.181728 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373181728*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 136289
#260921 11:19:33 server id 1  end_log_pos 136461 CRC32 0x00bfea91 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6505
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `news` add unique `news_slug_unique`(`slug`)
/*!*/;
# at 136461
#260921 11:19:33 server id 1  end_log_pos 136540 CRC32 0x2ca21ed7 	Anonymous_GTID	last_committed=279	sequence_number=280	rbr_only=yes	original_committed_timestamp=1789964373191509	immediate_commit_timestamp=1789964373191509	transaction_length=357
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964373191509 (2026-09-21 11:19:33.191509 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373191509 (2026-09-21 11:19:33.191509 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373191509*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 136540
#260921 11:19:33 server id 1  end_log_pos 136629 CRC32 0xdd61e6b8 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964373/*!*/;
BEGIN
/*!*/;
# at 136629
#260921 11:19:33 server id 1  end_log_pos 136706 CRC32 0xc354ab89 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 136706
#260921 11:19:33 server id 1  end_log_pos 136787 CRC32 0x13d6b178 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VbCwahMBAAAATQAAAAIWAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4ImrVMM=
VbCwah4BAAAAUQAAAFMWAgAAAA0BAAAAAAEAAgAD/wAHAAAAIwAyMDI2XzA5XzExXzAwMDAwMV9j
cmVhdGVfbmV3c190YWJsZQEAAAB4sdYT
'/*!*/;
# at 136787
#260921 11:19:33 server id 1  end_log_pos 136818 CRC32 0x40514b23 	Xid = 6508
COMMIT/*!*/;
# at 136818
#260921 11:19:33 server id 1  end_log_pos 136897 CRC32 0x49af6a9e 	Anonymous_GTID	last_committed=280	sequence_number=281	rbr_only=yes	original_committed_timestamp=1789964373199121	immediate_commit_timestamp=1789964373199121	transaction_length=368
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964373199121 (2026-09-21 11:19:33.199121 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373199121 (2026-09-21 11:19:33.199121 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373199121*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 136897
#260921 11:19:33 server id 1  end_log_pos 136986 CRC32 0x48e7b089 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964373/*!*/;
BEGIN
/*!*/;
# at 136986
#260921 11:19:33 server id 1  end_log_pos 137063 CRC32 0xa7aff6d3 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 137063
#260921 11:19:33 server id 1  end_log_pos 137155 CRC32 0x266ab3e0 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VbCwahMBAAAATQAAAGcXAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4NP2r6c=
VbCwah4BAAAAXAAAAMMXAgAAAA0BAAAAAAEAAgAD/wAIAAAALgAyMDI2XzA5XzExXzAwMDAwMl9h
ZGRfdGltZXN0YW1wc190b19uZXdzX3RhYmxlAQAAAOCzaiY=
'/*!*/;
# at 137155
#260921 11:19:33 server id 1  end_log_pos 137186 CRC32 0x1bf26b28 	Xid = 6517
COMMIT/*!*/;
# at 137186
#260921 11:19:33 server id 1  end_log_pos 137265 CRC32 0x2bf5983c 	Anonymous_GTID	last_committed=281	sequence_number=282	rbr_only=no	original_committed_timestamp=1789964373228792	immediate_commit_timestamp=1789964373228792	transaction_length=712
# original_commit_timestamp=1789964373228792 (2026-09-21 11:19:33.228792 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373228792 (2026-09-21 11:19:33.228792 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373228792*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 137265
#260921 11:19:33 server id 1  end_log_pos 137898 CRC32 0xfd02778d 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6520
SET TIMESTAMP=1789964373/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `announcements` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `category` enum('umum', 'teknis', 'kepegawaian', 'keuangan', 'layanan') not null, `excerpt` text not null, `content` longtext null, `is_published` tinyint(1) not null default '0', `published_at` timestamp null, `author_user_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 137898
#260921 11:19:33 server id 1  end_log_pos 137977 CRC32 0x19ed84e2 	Anonymous_GTID	last_committed=282	sequence_number=283	rbr_only=no	original_committed_timestamp=1789964373320515	immediate_commit_timestamp=1789964373320515	transaction_length=352
# original_commit_timestamp=1789964373320515 (2026-09-21 11:19:33.320515 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373320515 (2026-09-21 11:19:33.320515 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373320515*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 137977
#260921 11:19:33 server id 1  end_log_pos 138250 CRC32 0x63f69ad9 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6523
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add constraint `announcements_author_user_id_foreign` foreign key (`author_user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 138250
#260921 11:19:33 server id 1  end_log_pos 138329 CRC32 0x120de169 	Anonymous_GTID	last_committed=283	sequence_number=284	rbr_only=no	original_committed_timestamp=1789964373383497	immediate_commit_timestamp=1789964373383497	transaction_length=283
# original_commit_timestamp=1789964373383497 (2026-09-21 11:19:33.383497 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373383497 (2026-09-21 11:19:33.383497 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373383497*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 138329
#260921 11:19:33 server id 1  end_log_pos 138533 CRC32 0x4756e25b 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6526
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_is_published_index`(`is_published`)
/*!*/;
# at 138533
#260921 11:19:33 server id 1  end_log_pos 138612 CRC32 0x0366d04c 	Anonymous_GTID	last_committed=284	sequence_number=285	rbr_only=no	original_committed_timestamp=1789964373408495	immediate_commit_timestamp=1789964373408495	transaction_length=275
# original_commit_timestamp=1789964373408495 (2026-09-21 11:19:33.408495 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373408495 (2026-09-21 11:19:33.408495 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373408495*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 138612
#260921 11:19:33 server id 1  end_log_pos 138808 CRC32 0xc4cb504a 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6529
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_category_index`(`category`)
/*!*/;
# at 138808
#260921 11:19:33 server id 1  end_log_pos 138887 CRC32 0x620a9149 	Anonymous_GTID	last_committed=285	sequence_number=286	rbr_only=no	original_committed_timestamp=1789964373448815	immediate_commit_timestamp=1789964373448815	transaction_length=283
# original_commit_timestamp=1789964373448815 (2026-09-21 11:19:33.448815 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373448815 (2026-09-21 11:19:33.448815 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373448815*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 138887
#260921 11:19:33 server id 1  end_log_pos 139091 CRC32 0x0fc8b8eb 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6532
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add index `announcements_published_at_index`(`published_at`)
/*!*/;
# at 139091
#260921 11:19:33 server id 1  end_log_pos 139170 CRC32 0xe9656856 	Anonymous_GTID	last_committed=286	sequence_number=287	rbr_only=no	original_committed_timestamp=1789964373488211	immediate_commit_timestamp=1789964373488211	transaction_length=269
# original_commit_timestamp=1789964373488211 (2026-09-21 11:19:33.488211 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373488211 (2026-09-21 11:19:33.488211 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373488211*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 139170
#260921 11:19:33 server id 1  end_log_pos 139360 CRC32 0xe719c09c 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6535
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `announcements` add unique `announcements_slug_unique`(`slug`)
/*!*/;
# at 139360
#260921 11:19:33 server id 1  end_log_pos 139439 CRC32 0x32867c33 	Anonymous_GTID	last_committed=287	sequence_number=288	rbr_only=yes	original_committed_timestamp=1789964373499554	immediate_commit_timestamp=1789964373499554	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964373499554 (2026-09-21 11:19:33.499554 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373499554 (2026-09-21 11:19:33.499554 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373499554*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 139439
#260921 11:19:33 server id 1  end_log_pos 139528 CRC32 0x16f5b5c2 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964373/*!*/;
BEGIN
/*!*/;
# at 139528
#260921 11:19:33 server id 1  end_log_pos 139605 CRC32 0x0e5b4759 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 139605
#260921 11:19:33 server id 1  end_log_pos 139695 CRC32 0x31dfe9af 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VbCwahMBAAAATQAAAFUhAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4FlHWw4=
VbCwah4BAAAAWgAAAK8hAgAAAA0BAAAAAAEAAgAD/wAJAAAALAAyMDI2XzA5XzE0XzAwMDAwMV9j
cmVhdGVfYW5ub3VuY2VtZW50c190YWJsZQEAAACv6d8x
'/*!*/;
# at 139695
#260921 11:19:33 server id 1  end_log_pos 139726 CRC32 0x7db4b6c9 	Xid = 6538
COMMIT/*!*/;
# at 139726
#260921 11:19:33 server id 1  end_log_pos 139805 CRC32 0x819af220 	Anonymous_GTID	last_committed=288	sequence_number=289	rbr_only=no	original_committed_timestamp=1789964373534184	immediate_commit_timestamp=1789964373534184	transaction_length=720
# original_commit_timestamp=1789964373534184 (2026-09-21 11:19:33.534184 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373534184 (2026-09-21 11:19:33.534184 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373534184*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 139805
#260921 11:19:33 server id 1  end_log_pos 140446 CRC32 0x240cd0b7 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6541
SET TIMESTAMP=1789964373/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `activity_logs` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned null, `user_name` varchar(255) null, `user_role` varchar(255) null, `module` varchar(255) not null, `action` varchar(255) not null, `description` text not null, `subject_type` varchar(255) null, `subject_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` varchar(500) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 140446
#260921 11:19:33 server id 1  end_log_pos 140525 CRC32 0xbb8bdc46 	Anonymous_GTID	last_committed=289	sequence_number=290	rbr_only=no	original_committed_timestamp=1789964373660248	immediate_commit_timestamp=1789964373660248	transaction_length=338
# original_commit_timestamp=1789964373660248 (2026-09-21 11:19:33.660248 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373660248 (2026-09-21 11:19:33.660248 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373660248*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 140525
#260921 11:19:33 server id 1  end_log_pos 140784 CRC32 0x5c286686 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6544
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add constraint `activity_logs_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 140784
#260921 11:19:33 server id 1  end_log_pos 140863 CRC32 0x9869e3fa 	Anonymous_GTID	last_committed=290	sequence_number=291	rbr_only=no	original_committed_timestamp=1789964373700711	immediate_commit_timestamp=1789964373700711	transaction_length=279
# original_commit_timestamp=1789964373700711 (2026-09-21 11:19:33.700711 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373700711 (2026-09-21 11:19:33.700711 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373700711*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 140863
#260921 11:19:33 server id 1  end_log_pos 141063 CRC32 0x200d8810 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6547
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_created_at_index`(`created_at`)
/*!*/;
# at 141063
#260921 11:19:33 server id 1  end_log_pos 141142 CRC32 0x2d94d72a 	Anonymous_GTID	last_committed=291	sequence_number=292	rbr_only=no	original_committed_timestamp=1789964373728819	immediate_commit_timestamp=1789964373728819	transaction_length=288
# original_commit_timestamp=1789964373728819 (2026-09-21 11:19:33.728819 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373728819 (2026-09-21 11:19:33.728819 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373728819*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 141142
#260921 11:19:33 server id 1  end_log_pos 141351 CRC32 0xe606bdb2 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6550
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_action_index`(`module`, `action`)
/*!*/;
# at 141351
#260921 11:19:33 server id 1  end_log_pos 141430 CRC32 0xb97cd178 	Anonymous_GTID	last_committed=292	sequence_number=293	rbr_only=no	original_committed_timestamp=1789964373757546	immediate_commit_timestamp=1789964373757546	transaction_length=271
# original_commit_timestamp=1789964373757546 (2026-09-21 11:19:33.757546 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373757546 (2026-09-21 11:19:33.757546 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373757546*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 141430
#260921 11:19:33 server id 1  end_log_pos 141622 CRC32 0xbe3dbee1 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6553
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_index`(`module`)
/*!*/;
# at 141622
#260921 11:19:33 server id 1  end_log_pos 141701 CRC32 0x36e5c45c 	Anonymous_GTID	last_committed=293	sequence_number=294	rbr_only=no	original_committed_timestamp=1789964373791363	immediate_commit_timestamp=1789964373791363	transaction_length=271
# original_commit_timestamp=1789964373791363 (2026-09-21 11:19:33.791363 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373791363 (2026-09-21 11:19:33.791363 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373791363*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 141701
#260921 11:19:33 server id 1  end_log_pos 141893 CRC32 0x1df37d94 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6556
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_action_index`(`action`)
/*!*/;
# at 141893
#260921 11:19:33 server id 1  end_log_pos 141972 CRC32 0x3015e2ef 	Anonymous_GTID	last_committed=294	sequence_number=295	rbr_only=no	original_committed_timestamp=1789964373823451	immediate_commit_timestamp=1789964373823451	transaction_length=283
# original_commit_timestamp=1789964373823451 (2026-09-21 11:19:33.823451 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373823451 (2026-09-21 11:19:33.823451 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373823451*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 141972
#260921 11:19:33 server id 1  end_log_pos 142176 CRC32 0x6f1d7d54 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6559
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_subject_type_index`(`subject_type`)
/*!*/;
# at 142176
#260921 11:19:33 server id 1  end_log_pos 142255 CRC32 0xfe45768b 	Anonymous_GTID	last_committed=295	sequence_number=296	rbr_only=yes	original_committed_timestamp=1789964373837780	immediate_commit_timestamp=1789964373837780	transaction_length=366
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964373837780 (2026-09-21 11:19:33.837780 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373837780 (2026-09-21 11:19:33.837780 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373837780*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 142255
#260921 11:19:33 server id 1  end_log_pos 142344 CRC32 0x75b2f40d 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964373/*!*/;
BEGIN
/*!*/;
# at 142344
#260921 11:19:33 server id 1  end_log_pos 142421 CRC32 0xe5d47027 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 142421
#260921 11:19:33 server id 1  end_log_pos 142511 CRC32 0x5574587c 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VbCwahMBAAAATQAAAFUsAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4Cdw1OU=
VbCwah4BAAAAWgAAAK8sAgAAAA0BAAAAAAEAAgAD/wAKAAAALAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfYWN0aXZpdHlfbG9nc190YWJsZQEAAAB8WHRV
'/*!*/;
# at 142511
#260921 11:19:33 server id 1  end_log_pos 142542 CRC32 0x100baf54 	Xid = 6562
COMMIT/*!*/;
# at 142542
#260921 11:19:33 server id 1  end_log_pos 142621 CRC32 0x8466b54e 	Anonymous_GTID	last_committed=296	sequence_number=297	rbr_only=no	original_committed_timestamp=1789964373860931	immediate_commit_timestamp=1789964373860931	transaction_length=668
# original_commit_timestamp=1789964373860931 (2026-09-21 11:19:33.860931 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373860931 (2026-09-21 11:19:33.860931 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373860931*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 142621
#260921 11:19:33 server id 1  end_log_pos 143210 CRC32 0x3ca14710 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6565
SET TIMESTAMP=1789964373/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `galleries` (`id` bigint unsigned not null auto_increment primary key, `judul` varchar(255) not null, `kategori` enum('KEGIATAN', 'FASILITAS', 'DOKUMENTASI', 'SEREMONIAL') not null, `deskripsi` text null, `file_gambar` varchar(255) not null, `tanggal_kegiatan` date not null, `status` enum('publikasi', 'draft') not null default 'publikasi', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 143210
#260921 11:19:33 server id 1  end_log_pos 143289 CRC32 0xd3158a8b 	Anonymous_GTID	last_committed=297	sequence_number=298	rbr_only=no	original_committed_timestamp=1789964373909124	immediate_commit_timestamp=1789964373909124	transaction_length=267
# original_commit_timestamp=1789964373909124 (2026-09-21 11:19:33.909124 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373909124 (2026-09-21 11:19:33.909124 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373909124*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 143289
#260921 11:19:33 server id 1  end_log_pos 143477 CRC32 0x34c44131 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6568
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_kategori_index`(`kategori`)
/*!*/;
# at 143477
#260921 11:19:33 server id 1  end_log_pos 143556 CRC32 0x0743fadb 	Anonymous_GTID	last_committed=298	sequence_number=299	rbr_only=no	original_committed_timestamp=1789964373978380	immediate_commit_timestamp=1789964373978380	transaction_length=263
# original_commit_timestamp=1789964373978380 (2026-09-21 11:19:33.978380 SE Asia Standard Time)
# immediate_commit_timestamp=1789964373978380 (2026-09-21 11:19:33.978380 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964373978380*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 143556
#260921 11:19:33 server id 1  end_log_pos 143740 CRC32 0xfbfe1acc 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6571
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_status_index`(`status`)
/*!*/;
# at 143740
#260921 11:19:33 server id 1  end_log_pos 143819 CRC32 0xb1068670 	Anonymous_GTID	last_committed=299	sequence_number=300	rbr_only=no	original_committed_timestamp=1789964374020160	immediate_commit_timestamp=1789964374020160	transaction_length=283
# original_commit_timestamp=1789964374020160 (2026-09-21 11:19:34.020160 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374020160 (2026-09-21 11:19:34.020160 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374020160*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 143819
#260921 11:19:33 server id 1  end_log_pos 144023 CRC32 0xee88b1d2 	Query	thread_id=88	exec_time=1	error_code=0	Xid = 6574
SET TIMESTAMP=1789964373/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_tanggal_kegiatan_index`(`tanggal_kegiatan`)
/*!*/;
# at 144023
#260921 11:19:34 server id 1  end_log_pos 144102 CRC32 0xb3da5fa7 	Anonymous_GTID	last_committed=300	sequence_number=301	rbr_only=yes	original_committed_timestamp=1789964374030947	immediate_commit_timestamp=1789964374030947	transaction_length=362
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964374030947 (2026-09-21 11:19:34.030947 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374030947 (2026-09-21 11:19:34.030947 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374030947*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 144102
#260921 11:19:34 server id 1  end_log_pos 144191 CRC32 0xac0c28a7 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964374/*!*/;
BEGIN
/*!*/;
# at 144191
#260921 11:19:34 server id 1  end_log_pos 144268 CRC32 0xb9db1a00 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 144268
#260921 11:19:34 server id 1  end_log_pos 144354 CRC32 0xf54f0dde 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VrCwahMBAAAATQAAAIwzAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4AAa27k=
VrCwah4BAAAAVgAAAOIzAgAAAA0BAAAAAAEAAgAD/wALAAAAKAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfZ2FsbGVyaWVzX3RhYmxlAQAAAN4NT/U=
'/*!*/;
# at 144354
#260921 11:19:34 server id 1  end_log_pos 144385 CRC32 0x2bf16d0d 	Xid = 6577
COMMIT/*!*/;
# at 144385
#260921 11:19:34 server id 1  end_log_pos 144464 CRC32 0xbdb100df 	Anonymous_GTID	last_committed=301	sequence_number=302	rbr_only=no	original_committed_timestamp=1789964374056688	immediate_commit_timestamp=1789964374056688	transaction_length=665
# original_commit_timestamp=1789964374056688 (2026-09-21 11:19:34.056688 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374056688 (2026-09-21 11:19:34.056688 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374056688*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 144464
#260921 11:19:34 server id 1  end_log_pos 145050 CRC32 0xde7c562c 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6580
SET TIMESTAMP=1789964374/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `contact_messages` (`id` bigint unsigned not null auto_increment primary key, `nama` varchar(150) not null, `email` varchar(255) not null, `telepon` varchar(25) not null, `kategori` varchar(30) not null, `subjek` varchar(255) not null, `pesan` text not null, `status` varchar(20) not null default 'belum_dibaca', `read_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 145050
#260921 11:19:34 server id 1  end_log_pos 145129 CRC32 0x466cca6a 	Anonymous_GTID	last_committed=302	sequence_number=303	rbr_only=no	original_committed_timestamp=1789964374086408	immediate_commit_timestamp=1789964374086408	transaction_length=277
# original_commit_timestamp=1789964374086408 (2026-09-21 11:19:34.086408 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374086408 (2026-09-21 11:19:34.086408 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374086408*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 145129
#260921 11:19:34 server id 1  end_log_pos 145327 CRC32 0x2cd731ea 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6583
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `contact_messages` add index `contact_messages_status_index`(`status`)
/*!*/;
# at 145327
#260921 11:19:34 server id 1  end_log_pos 145406 CRC32 0x6e9782f6 	Anonymous_GTID	last_committed=303	sequence_number=304	rbr_only=yes	original_committed_timestamp=1789964374094653	immediate_commit_timestamp=1789964374094653	transaction_length=369
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964374094653 (2026-09-21 11:19:34.094653 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374094653 (2026-09-21 11:19:34.094653 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374094653*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 145406
#260921 11:19:34 server id 1  end_log_pos 145495 CRC32 0x238866db 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964374/*!*/;
BEGIN
/*!*/;
# at 145495
#260921 11:19:34 server id 1  end_log_pos 145572 CRC32 0x28e3fc52 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 145572
#260921 11:19:34 server id 1  end_log_pos 145665 CRC32 0x00689361 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VrCwahMBAAAATQAAAKQ4AgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4FL84yg=
VrCwah4BAAAAXQAAAAE5AgAAAA0BAAAAAAEAAgAD/wAMAAAALwAyMDI2XzA5XzE1XzAwMDAwMV9j
cmVhdGVfY29udGFjdF9tZXNzYWdlc190YWJsZQEAAABhk2gA
'/*!*/;
# at 145665
#260921 11:19:34 server id 1  end_log_pos 145696 CRC32 0x61dc888b 	Xid = 6586
COMMIT/*!*/;
# at 145696
#260921 11:19:34 server id 1  end_log_pos 145775 CRC32 0xd94bc997 	Anonymous_GTID	last_committed=304	sequence_number=305	rbr_only=no	original_committed_timestamp=1789964374114521	immediate_commit_timestamp=1789964374114521	transaction_length=671
# original_commit_timestamp=1789964374114521 (2026-09-21 11:19:34.114521 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374114521 (2026-09-21 11:19:34.114521 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374114521*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 145775
#260921 11:19:34 server id 1  end_log_pos 146367 CRC32 0xc5b7adff 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6589
SET TIMESTAMP=1789964374/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `pages` (`id` bigint unsigned not null auto_increment primary key, `title` varchar(255) not null, `slug` varchar(255) not null, `status` varchar(20) not null default 'draft', `visibility` varchar(20) not null default 'public', `show_in_list` tinyint(1) not null default '1', `created_by` bigint unsigned null, `updated_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 146367
#260921 11:19:34 server id 1  end_log_pos 146446 CRC32 0x9ec178ee 	Anonymous_GTID	last_committed=305	sequence_number=306	rbr_only=no	original_committed_timestamp=1789964374180174	immediate_commit_timestamp=1789964374180174	transaction_length=328
# original_commit_timestamp=1789964374180174 (2026-09-21 11:19:34.180174 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374180174 (2026-09-21 11:19:34.180174 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374180174*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 146446
#260921 11:19:34 server id 1  end_log_pos 146695 CRC32 0xa9421f35 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6592
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add constraint `pages_created_by_foreign` foreign key (`created_by`) references `users` (`id`) on delete set null
/*!*/;
# at 146695
#260921 11:19:34 server id 1  end_log_pos 146774 CRC32 0x53e07aba 	Anonymous_GTID	last_committed=306	sequence_number=307	rbr_only=no	original_committed_timestamp=1789964374277446	immediate_commit_timestamp=1789964374277446	transaction_length=328
# original_commit_timestamp=1789964374277446 (2026-09-21 11:19:34.277446 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374277446 (2026-09-21 11:19:34.277446 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374277446*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 146774
#260921 11:19:34 server id 1  end_log_pos 147023 CRC32 0x51c589cd 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6595
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add constraint `pages_updated_by_foreign` foreign key (`updated_by`) references `users` (`id`) on delete set null
/*!*/;
# at 147023
#260921 11:19:34 server id 1  end_log_pos 147102 CRC32 0x4f2429ba 	Anonymous_GTID	last_committed=307	sequence_number=308	rbr_only=no	original_committed_timestamp=1789964374313638	immediate_commit_timestamp=1789964374313638	transaction_length=253
# original_commit_timestamp=1789964374313638 (2026-09-21 11:19:34.313638 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374313638 (2026-09-21 11:19:34.313638 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374313638*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 147102
#260921 11:19:34 server id 1  end_log_pos 147276 CRC32 0xcd1f107f 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6598
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add unique `pages_slug_unique`(`slug`)
/*!*/;
# at 147276
#260921 11:19:34 server id 1  end_log_pos 147355 CRC32 0x25f5950d 	Anonymous_GTID	last_committed=308	sequence_number=309	rbr_only=no	original_committed_timestamp=1789964374340700	immediate_commit_timestamp=1789964374340700	transaction_length=255
# original_commit_timestamp=1789964374340700 (2026-09-21 11:19:34.340700 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374340700 (2026-09-21 11:19:34.340700 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374340700*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 147355
#260921 11:19:34 server id 1  end_log_pos 147531 CRC32 0x73ff69e0 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6601
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add index `pages_status_index`(`status`)
/*!*/;
# at 147531
#260921 11:19:34 server id 1  end_log_pos 147610 CRC32 0xf0eee6d0 	Anonymous_GTID	last_committed=309	sequence_number=310	rbr_only=no	original_committed_timestamp=1789964374370072	immediate_commit_timestamp=1789964374370072	transaction_length=263
# original_commit_timestamp=1789964374370072 (2026-09-21 11:19:34.370072 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374370072 (2026-09-21 11:19:34.370072 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374370072*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 147610
#260921 11:19:34 server id 1  end_log_pos 147794 CRC32 0xe8166141 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6604
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `pages` add index `pages_visibility_index`(`visibility`)
/*!*/;
# at 147794
#260921 11:19:34 server id 1  end_log_pos 147873 CRC32 0x29ed5be5 	Anonymous_GTID	last_committed=310	sequence_number=311	rbr_only=no	original_committed_timestamp=1789964374413558	immediate_commit_timestamp=1789964374413558	transaction_length=409
# original_commit_timestamp=1789964374413558 (2026-09-21 11:19:34.413558 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374413558 (2026-09-21 11:19:34.413558 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374413558*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 147873
#260921 11:19:34 server id 1  end_log_pos 148203 CRC32 0xc89f74a0 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6607
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `page_role` (`id` bigint unsigned not null auto_increment primary key, `page_id` bigint unsigned not null, `role_id` bigint unsigned not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 148203
#260921 11:19:34 server id 1  end_log_pos 148282 CRC32 0xa33e2b4b 	Anonymous_GTID	last_committed=311	sequence_number=312	rbr_only=no	original_committed_timestamp=1789964374481830	immediate_commit_timestamp=1789964374481830	transaction_length=329
# original_commit_timestamp=1789964374481830 (2026-09-21 11:19:34.481830 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374481830 (2026-09-21 11:19:34.481830 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374481830*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 148282
#260921 11:19:34 server id 1  end_log_pos 148532 CRC32 0x8de90ff3 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6610
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add constraint `page_role_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete cascade
/*!*/;
# at 148532
#260921 11:19:34 server id 1  end_log_pos 148611 CRC32 0x13d29ce8 	Anonymous_GTID	last_committed=312	sequence_number=313	rbr_only=no	original_committed_timestamp=1789964374579138	immediate_commit_timestamp=1789964374579138	transaction_length=329
# original_commit_timestamp=1789964374579138 (2026-09-21 11:19:34.579138 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374579138 (2026-09-21 11:19:34.579138 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374579138*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 148611
#260921 11:19:34 server id 1  end_log_pos 148861 CRC32 0xf9f5e855 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6613
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add constraint `page_role_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade
/*!*/;
# at 148861
#260921 11:19:34 server id 1  end_log_pos 148940 CRC32 0x4181a113 	Anonymous_GTID	last_committed=313	sequence_number=314	rbr_only=no	original_committed_timestamp=1789964374604317	immediate_commit_timestamp=1789964374604317	transaction_length=286
# original_commit_timestamp=1789964374604317 (2026-09-21 11:19:34.604317 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374604317 (2026-09-21 11:19:34.604317 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374604317*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 148940
#260921 11:19:34 server id 1  end_log_pos 149147 CRC32 0x577ad662 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6616
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_role` add unique `page_role_page_id_role_id_unique`(`page_id`, `role_id`)
/*!*/;
# at 149147
#260921 11:19:34 server id 1  end_log_pos 149226 CRC32 0x3e021995 	Anonymous_GTID	last_committed=314	sequence_number=315	rbr_only=no	original_committed_timestamp=1789964374641621	immediate_commit_timestamp=1789964374641621	transaction_length=532
# original_commit_timestamp=1789964374641621 (2026-09-21 11:19:34.641621 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374641621 (2026-09-21 11:19:34.641621 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374641621*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 149226
#260921 11:19:34 server id 1  end_log_pos 149679 CRC32 0x8ddad09e 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6619
SET TIMESTAMP=1789964374/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `page_sections` (`id` bigint unsigned not null auto_increment primary key, `page_id` bigint unsigned not null, `type` varchar(30) not null, `data` json null, `sort_order` int unsigned not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 149679
#260921 11:19:34 server id 1  end_log_pos 149758 CRC32 0x5fedda5e 	Anonymous_GTID	last_committed=315	sequence_number=316	rbr_only=no	original_committed_timestamp=1789964374703558	immediate_commit_timestamp=1789964374703558	transaction_length=337
# original_commit_timestamp=1789964374703558 (2026-09-21 11:19:34.703558 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374703558 (2026-09-21 11:19:34.703558 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374703558*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 149758
#260921 11:19:34 server id 1  end_log_pos 150016 CRC32 0x551cb668 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6622
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_sections` add constraint `page_sections_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete cascade
/*!*/;
# at 150016
#260921 11:19:34 server id 1  end_log_pos 150095 CRC32 0xd9ba99c8 	Anonymous_GTID	last_committed=316	sequence_number=317	rbr_only=no	original_committed_timestamp=1789964374729681	immediate_commit_timestamp=1789964374729681	transaction_length=279
# original_commit_timestamp=1789964374729681 (2026-09-21 11:19:34.729681 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374729681 (2026-09-21 11:19:34.729681 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374729681*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 150095
#260921 11:19:34 server id 1  end_log_pos 150295 CRC32 0x32517a00 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6625
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `page_sections` add index `page_sections_sort_order_index`(`sort_order`)
/*!*/;
# at 150295
#260921 11:19:34 server id 1  end_log_pos 150374 CRC32 0xf8fd0717 	Anonymous_GTID	last_committed=317	sequence_number=318	rbr_only=yes	original_committed_timestamp=1789964374740453	immediate_commit_timestamp=1789964374740453	transaction_length=359
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964374740453 (2026-09-21 11:19:34.740453 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374740453 (2026-09-21 11:19:34.740453 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374740453*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 150374
#260921 11:19:34 server id 1  end_log_pos 150463 CRC32 0xa33f1523 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964374/*!*/;
BEGIN
/*!*/;
# at 150463
#260921 11:19:34 server id 1  end_log_pos 150540 CRC32 0xb69866ef 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 150540
#260921 11:19:34 server id 1  end_log_pos 150623 CRC32 0xe638ec75 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
VrCwahMBAAAATQAAAAxMAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4O9mmLY=
VrCwah4BAAAAUwAAAF9MAgAAAA0BAAAAAAEAAgAD/wANAAAAJQAyMDI2XzA5XzE1XzAwMDAwMV9j
cmVhdGVfcGFnZXNfdGFibGVzAQAAAHXsOOY=
'/*!*/;
# at 150623
#260921 11:19:34 server id 1  end_log_pos 150654 CRC32 0x6a3b38f5 	Xid = 6628
COMMIT/*!*/;
# at 150654
#260921 11:19:34 server id 1  end_log_pos 150733 CRC32 0xfeecb4af 	Anonymous_GTID	last_committed=318	sequence_number=319	rbr_only=no	original_committed_timestamp=1789964374776685	immediate_commit_timestamp=1789964374776685	transaction_length=743
# original_commit_timestamp=1789964374776685 (2026-09-21 11:19:34.776685 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374776685 (2026-09-21 11:19:34.776685 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374776685*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 150733
#260921 11:19:34 server id 1  end_log_pos 151397 CRC32 0x7d2ee2e5 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6631
SET TIMESTAMP=1789964374/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `menus` (`id` bigint unsigned not null auto_increment primary key, `parent_id` bigint unsigned null, `label` varchar(255) not null, `type` varchar(20) not null default 'url', `route_name` varchar(255) null, `page_id` bigint unsigned null, `url` varchar(500) null, `icon` varchar(60) null, `sort_order` int unsigned not null default '0', `is_active` tinyint(1) not null default '1', `created_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 151397
#260921 11:19:34 server id 1  end_log_pos 151476 CRC32 0xdfc54169 	Anonymous_GTID	last_committed=319	sequence_number=320	rbr_only=no	original_committed_timestamp=1789964374895689	immediate_commit_timestamp=1789964374895689	transaction_length=325
# original_commit_timestamp=1789964374895689 (2026-09-21 11:19:34.895689 SE Asia Standard Time)
# immediate_commit_timestamp=1789964374895689 (2026-09-21 11:19:34.895689 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964374895689*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 151476
#260921 11:19:34 server id 1  end_log_pos 151722 CRC32 0x1b390437 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6634
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_parent_id_foreign` foreign key (`parent_id`) references `menus` (`id`) on delete cascade
/*!*/;
# at 151722
#260921 11:19:34 server id 1  end_log_pos 151801 CRC32 0xf86a512e 	Anonymous_GTID	last_committed=320	sequence_number=321	rbr_only=no	original_committed_timestamp=1789964375047530	immediate_commit_timestamp=1789964375047530	transaction_length=322
# original_commit_timestamp=1789964375047530 (2026-09-21 11:19:35.047530 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375047530 (2026-09-21 11:19:35.047530 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375047530*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 151801
#260921 11:19:34 server id 1  end_log_pos 152044 CRC32 0x37025703 	Query	thread_id=88	exec_time=1	error_code=0	Xid = 6637
SET TIMESTAMP=1789964374/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_page_id_foreign` foreign key (`page_id`) references `pages` (`id`) on delete set null
/*!*/;
# at 152044
#260921 11:19:35 server id 1  end_log_pos 152123 CRC32 0x3a3d49a6 	Anonymous_GTID	last_committed=321	sequence_number=322	rbr_only=no	original_committed_timestamp=1789964375157791	immediate_commit_timestamp=1789964375157791	transaction_length=328
# original_commit_timestamp=1789964375157791 (2026-09-21 11:19:35.157791 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375157791 (2026-09-21 11:19:35.157791 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375157791*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 152123
#260921 11:19:35 server id 1  end_log_pos 152372 CRC32 0xf5e871d8 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6640
SET TIMESTAMP=1789964375/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add constraint `menus_created_by_foreign` foreign key (`created_by`) references `users` (`id`) on delete set null
/*!*/;
# at 152372
#260921 11:19:35 server id 1  end_log_pos 152451 CRC32 0xc8e3a29a 	Anonymous_GTID	last_committed=322	sequence_number=323	rbr_only=no	original_committed_timestamp=1789964375214483	immediate_commit_timestamp=1789964375214483	transaction_length=286
# original_commit_timestamp=1789964375214483 (2026-09-21 11:19:35.214483 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375214483 (2026-09-21 11:19:35.214483 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375214483*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 152451
#260921 11:19:35 server id 1  end_log_pos 152658 CRC32 0x8cc3a0b0 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6643
SET TIMESTAMP=1789964375/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_parent_id_sort_order_index`(`parent_id`, `sort_order`)
/*!*/;
# at 152658
#260921 11:19:35 server id 1  end_log_pos 152737 CRC32 0xe8bea7fc 	Anonymous_GTID	last_committed=323	sequence_number=324	rbr_only=no	original_committed_timestamp=1789964375243888	immediate_commit_timestamp=1789964375243888	transaction_length=263
# original_commit_timestamp=1789964375243888 (2026-09-21 11:19:35.243888 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375243888 (2026-09-21 11:19:35.243888 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375243888*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 152737
#260921 11:19:35 server id 1  end_log_pos 152921 CRC32 0x891832a8 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6646
SET TIMESTAMP=1789964375/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_sort_order_index`(`sort_order`)
/*!*/;
# at 152921
#260921 11:19:35 server id 1  end_log_pos 153000 CRC32 0xc40fa10d 	Anonymous_GTID	last_committed=324	sequence_number=325	rbr_only=no	original_committed_timestamp=1789964375270461	immediate_commit_timestamp=1789964375270461	transaction_length=261
# original_commit_timestamp=1789964375270461 (2026-09-21 11:19:35.270461 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375270461 (2026-09-21 11:19:35.270461 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375270461*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 153000
#260921 11:19:35 server id 1  end_log_pos 153182 CRC32 0x544e257d 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6649
SET TIMESTAMP=1789964375/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add index `menus_is_active_index`(`is_active`)
/*!*/;
# at 153182
#260921 11:19:35 server id 1  end_log_pos 153261 CRC32 0xba23cc3e 	Anonymous_GTID	last_committed=325	sequence_number=326	rbr_only=yes	original_committed_timestamp=1789964375282252	immediate_commit_timestamp=1789964375282252	transaction_length=358
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964375282252 (2026-09-21 11:19:35.282252 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375282252 (2026-09-21 11:19:35.282252 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375282252*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 153261
#260921 11:19:35 server id 1  end_log_pos 153350 CRC32 0x9771901b 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964375/*!*/;
BEGIN
/*!*/;
# at 153350
#260921 11:19:35 server id 1  end_log_pos 153427 CRC32 0xaa5b0f29 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 153427
#260921 11:19:35 server id 1  end_log_pos 153509 CRC32 0xc43caeb1 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
V7CwahMBAAAATQAAAFNXAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4CkPW6o=
V7Cwah4BAAAAUgAAAKVXAgAAAA0BAAAAAAEAAgAD/wAOAAAAJAAyMDI2XzA5XzE1XzAwMDAwMl9j
cmVhdGVfbWVudXNfdGFibGUBAAAAsa48xA==
'/*!*/;
# at 153509
#260921 11:19:35 server id 1  end_log_pos 153540 CRC32 0x02b5619e 	Xid = 6652
COMMIT/*!*/;
# at 153540
#260921 11:19:35 server id 1  end_log_pos 153619 CRC32 0x4b2bac7e 	Anonymous_GTID	last_committed=326	sequence_number=327	rbr_only=no	original_committed_timestamp=1789964375297821	immediate_commit_timestamp=1789964375297821	transaction_length=276
# original_commit_timestamp=1789964375297821 (2026-09-21 11:19:35.297821 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375297821 (2026-09-21 11:19:35.297821 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375297821*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 153619
#260921 11:19:35 server id 1  end_log_pos 153816 CRC32 0xc44ef20b 	Query	thread_id=88	exec_time=0	error_code=0	Xid = 6655
SET TIMESTAMP=1789964375/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `menus` add `target` varchar(10) not null default '_self' after `url`
/*!*/;
# at 153816
#260921 11:19:35 server id 1  end_log_pos 153895 CRC32 0x8454e36b 	Anonymous_GTID	last_committed=327	sequence_number=328	rbr_only=yes	original_committed_timestamp=1789964375320111	immediate_commit_timestamp=1789964375320111	transaction_length=365
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789964375320111 (2026-09-21 11:19:35.320111 SE Asia Standard Time)
# immediate_commit_timestamp=1789964375320111 (2026-09-21 11:19:35.320111 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789964375320111*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 153895
#260921 11:19:35 server id 1  end_log_pos 153984 CRC32 0x7ec8be23 	Query	thread_id=88	exec_time=0	error_code=0
SET TIMESTAMP=1789964375/*!*/;
BEGIN
/*!*/;
# at 153984
#260921 11:19:35 server id 1  end_log_pos 154061 CRC32 0x0b6e217b 	Table_map: `pln_up_imy_testing`.`migrations` mapped to number 269
# at 154061
#260921 11:19:35 server id 1  end_log_pos 154150 CRC32 0xd7d8fb64 	Write_rows: table id 269 flags: STMT_END_F

BINLOG '
V7CwahMBAAAATQAAAM1ZAgAAAA0BAAAAAAEAEnBsbl91cF9pbXlfdGVzdGluZwAKbWlncmF0aW9u
cwADAw8DAvwDAAEBgAIB4Hshbgs=
V7Cwah4BAAAAWQAAACZaAgAAAA0BAAAAAAEAAgAD/wAPAAAAKwAyMDI2XzA5XzE1XzAwMDAwM19h
ZGRfdGFyZ2V0X3RvX21lbnVzX3RhYmxlAQAAAGT72Nc=
'/*!*/;
# at 154150
#260921 11:19:35 server id 1  end_log_pos 154181 CRC32 0x80ec1391 	Xid = 6658
COMMIT/*!*/;
# at 154181
#260921 13:35:38 server id 1  end_log_pos 154260 CRC32 0x9b8855ff 	Anonymous_GTID	last_committed=328	sequence_number=329	rbr_only=yes	original_committed_timestamp=1789972538693378	immediate_commit_timestamp=1789972538693378	transaction_length=746
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972538693378 (2026-09-21 13:35:38.693378 SE Asia Standard Time)
# immediate_commit_timestamp=1789972538693378 (2026-09-21 13:35:38.693378 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972538693378*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 154260
#260921 13:35:38 server id 1  end_log_pos 154341 CRC32 0xbe9f9e85 	Query	thread_id=226	exec_time=0	error_code=0
SET TIMESTAMP=1789972538/*!*/;
BEGIN
/*!*/;
# at 154341
#260921 13:35:38 server id 1  end_log_pos 154415 CRC32 0x3065a0df 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 154415
#260921 13:35:38 server id 1  end_log_pos 154896 CRC32 0xb2da5a23 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
OtCwahMBAAAASgAAAC9bAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N+gZTA=
OtCwah4BAAAA4QEAABBdAgAAAFMAAAAAAAEAAgAG/wIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1D
SThLNXB6b1JzbVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lNRGRhVTA5VlRUVkhXbVZyY0hJM2IyZDZVRkZaUzBWemJXWXlTa0ozYTNSMmEzUlphRTFO
Y1NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElq
dDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWZRPT060LBqI1rasg==
'/*!*/;
# at 154896
#260921 13:35:38 server id 1  end_log_pos 154927 CRC32 0xe745c6df 	Xid = 20294
COMMIT/*!*/;
# at 154927
#260921 13:35:43 server id 1  end_log_pos 155006 CRC32 0xdc10638e 	Anonymous_GTID	last_committed=329	sequence_number=330	rbr_only=yes	original_committed_timestamp=1789972543855989	immediate_commit_timestamp=1789972543855989	transaction_length=1382
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972543855989 (2026-09-21 13:35:43.855989 SE Asia Standard Time)
# immediate_commit_timestamp=1789972543855989 (2026-09-21 13:35:43.855989 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972543855989*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 155006
#260921 13:35:43 server id 1  end_log_pos 155096 CRC32 0x779bd243 	Query	thread_id=227	exec_time=0	error_code=0
SET TIMESTAMP=1789972543/*!*/;
BEGIN
/*!*/;
# at 155096
#260921 13:35:43 server id 1  end_log_pos 155170 CRC32 0x037c2b06 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 155170
#260921 13:35:43 server id 1  end_log_pos 156278 CRC32 0x8a5815b5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
P9CwahMBAAAASgAAACJeAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AYrfAM=
P9Cwah8BAAAAVAQAAHZiAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pTURkYVUwOVZUVFZIV21WcmNISTNiMmQ2VUZGWlMwVnpiV1l5U2tKM2EzUjJhM1JaYUUx
TmNTSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT09OtCwagIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1DSThLNXB6b1Jz
bVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzbEAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lNRGRh
VTA5VlRUVkhXbVZyY0hJM2IyZDZVRkZaUzBWemJXWXlTa0ozYTNSMmEzUlphRTFOY1NJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TkRnNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhZM1JwZG1sMGVTMXNiMmR6UDNCaFoyVTlOQ0k3Y3pv
MU9pSnliM1YwWlNJN2N6b3lOVG9pWVdSdGFXNHVZV04wYVhacGRIa3RiRzluY3k1cGJtUmxlQ0k3
ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxk
eUk3WVRvd09udDlmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9pYVc1MFpXNWtaV1FpTzNNNk5E
ZzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloWTNScGRtbDBlUzFzYjJk
elAzQmhaMlU5TkNJN2ZYMD0/0LBqtRVYig==
'/*!*/;
# at 156278
#260921 13:35:43 server id 1  end_log_pos 156309 CRC32 0x2d5ce427 	Xid = 20303
COMMIT/*!*/;
# at 156309
#260921 13:35:44 server id 1  end_log_pos 156388 CRC32 0x52023c9f 	Anonymous_GTID	last_committed=330	sequence_number=331	rbr_only=yes	original_committed_timestamp=1789972544646280	immediate_commit_timestamp=1789972544646280	transaction_length=1514
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972544646280 (2026-09-21 13:35:44.646280 SE Asia Standard Time)
# immediate_commit_timestamp=1789972544646280 (2026-09-21 13:35:44.646280 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972544646280*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 156388
#260921 13:35:44 server id 1  end_log_pos 156478 CRC32 0x4db44f5b 	Query	thread_id=228	exec_time=0	error_code=0
SET TIMESTAMP=1789972544/*!*/;
BEGIN
/*!*/;
# at 156478
#260921 13:35:44 server id 1  end_log_pos 156552 CRC32 0x9130594b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 156552
#260921 13:35:44 server id 1  end_log_pos 157792 CRC32 0x83c64db1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QNCwahMBAAAASgAAAIhjAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EtZMJE=
QNCwah8BAAAA2AQAAGBoAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2xAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pTURkYVUwOVZUVFZIV21WcmNISTNiMmQ2VUZGWlMwVnpiV1l5U2tKM2EzUjJhM1JaYUUx
TmNTSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5EZzZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloWTNScGRtbDBlUzFzYjJkelAzQmha
MlU5TkNJN2N6bzFPaUp5YjNWMFpTSTdjem95TlRvaVlXUnRhVzR1WVdOMGFYWnBkSGt0Ykc5bmN5
NXBibVJsZUNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMx
ek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0RvaWFXNTBaVzVr
WldRaU8zTTZORGc2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aFkzUnBk
bWwwZVMxc2IyZHpQM0JoWjJVOU5DSTdmWDA9P9CwagIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1D
SThLNXB6b1JzbVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaUAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lNRGRhVTA5VlRUVkhXbVZyY0hJM2IyZDZVRkZaUzBWemJXWXlTa0ozYTNSMmEzUlphRTFO
Y1NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9p
YVc1MFpXNWtaV1FpTzNNNk5EZzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBi
aTloWTNScGRtbDBlUzFzYjJkelAzQmhaMlU5TkNJN2ZYMD1A0LBqsU3Ggw==
'/*!*/;
# at 157792
#260921 13:35:44 server id 1  end_log_pos 157823 CRC32 0xea90b099 	Xid = 20360
COMMIT/*!*/;
# at 157823
#260921 13:35:57 server id 1  end_log_pos 157902 CRC32 0xabe2f47d 	Anonymous_GTID	last_committed=331	sequence_number=332	rbr_only=yes	original_committed_timestamp=1789972557736955	immediate_commit_timestamp=1789972557736955	transaction_length=878
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972557736955 (2026-09-21 13:35:57.736955 SE Asia Standard Time)
# immediate_commit_timestamp=1789972557736955 (2026-09-21 13:35:57.736955 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972557736955*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 157902
#260921 13:35:57 server id 1  end_log_pos 157983 CRC32 0x9b997fbc 	Query	thread_id=229	exec_time=0	error_code=0
SET TIMESTAMP=1789972557/*!*/;
BEGIN
/*!*/;
# at 157983
#260921 13:35:57 server id 1  end_log_pos 158057 CRC32 0xc3fee8a8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 158057
#260921 13:35:57 server id 1  end_log_pos 158670 CRC32 0x040f6ab2 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
TdCwahMBAAAASgAAAGlpAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Kjo/sM=
TdCwaiABAAAAZQIAAM5rAgAAAFMAAAAAAAEAAgAG/wIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1D
SThLNXB6b1JzbVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaUAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lNRGRhVTA5VlRUVkhXbVZyY0hJM2IyZDZVRkZaUzBWemJXWXlTa0ozYTNSMmEzUlphRTFO
Y1NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9p
YVc1MFpXNWtaV1FpTzNNNk5EZzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBi
aTloWTNScGRtbDBlUzFzYjJkelAzQmhaMlU5TkNJN2ZYMD1A0LBqsmoPBA==
'/*!*/;
# at 158670
#260921 13:35:57 server id 1  end_log_pos 158701 CRC32 0xb5ae499e 	Xid = 20372
COMMIT/*!*/;
# at 158701
#260921 13:35:57 server id 1  end_log_pos 158780 CRC32 0xf1ab89d2 	Anonymous_GTID	last_committed=332	sequence_number=333	rbr_only=yes	original_committed_timestamp=1789972557844816	immediate_commit_timestamp=1789972557844816	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972557844816 (2026-09-21 13:35:57.844816 SE Asia Standard Time)
# immediate_commit_timestamp=1789972557844816 (2026-09-21 13:35:57.844816 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972557844816*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 158780
#260921 13:35:57 server id 1  end_log_pos 158861 CRC32 0x21bba449 	Query	thread_id=229	exec_time=0	error_code=0
SET TIMESTAMP=1789972557/*!*/;
BEGIN
/*!*/;
# at 158861
#260921 13:35:57 server id 1  end_log_pos 158935 CRC32 0x2f81a093 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 158935
#260921 13:35:57 server id 1  end_log_pos 159544 CRC32 0x7fd75ad1 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
TdCwahMBAAAASgAAANdsAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JOggS8=
TdCwah4BAAAAYQIAADhvAgAAAFMAAAAAAAEAAgAG/wAoAGV5WjRhTnVtZU5lWGFZRDgxWXdNTmdy
WHNudnNVckRFVGI3V0t0SXcEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVQySjZRa2d3YmtWc1NXTm5hVmRyVjJKbE0zWmljbk53YzNOcE1YSmlWa1JN
Y3pOSk5HRnphaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPU3QsGrRWtd/
'/*!*/;
# at 159544
#260921 13:35:57 server id 1  end_log_pos 159575 CRC32 0x9a0f40f7 	Xid = 20378
COMMIT/*!*/;
# at 159575
#260921 13:35:58 server id 1  end_log_pos 159654 CRC32 0x143d4d08 	Anonymous_GTID	last_committed=333	sequence_number=334	rbr_only=yes	original_committed_timestamp=1789972558590596	immediate_commit_timestamp=1789972558590596	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972558590596 (2026-09-21 13:35:58.590596 SE Asia Standard Time)
# immediate_commit_timestamp=1789972558590596 (2026-09-21 13:35:58.590596 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972558590596*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 159654
#260921 13:35:58 server id 1  end_log_pos 159735 CRC32 0x9c1e0863 	Query	thread_id=230	exec_time=0	error_code=0
SET TIMESTAMP=1789972558/*!*/;
BEGIN
/*!*/;
# at 159735
#260921 13:35:58 server id 1  end_log_pos 159809 CRC32 0xbda7c569 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 159809
#260921 13:35:58 server id 1  end_log_pos 160178 CRC32 0x4eda13e7 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
TtCwahMBAAAASgAAAEFwAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GnFp70=
TtCwah4BAAAAcQEAALJxAgAAAFMAAAAAAAEAAgAG/wIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1D
SThLNXB6b1JzbVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lRVnBFVEhnemNWSmFkVU00YUd4aU5EVkpjSE5rV2twVWNreE9VWFZhUW5CTVpXbzFNSGt6
VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PU7QsGrnE9pO
'/*!*/;
# at 160178
#260921 13:35:58 server id 1  end_log_pos 160209 CRC32 0xcea92538 	Xid = 20390
COMMIT/*!*/;
# at 160209
#260921 13:35:59 server id 1  end_log_pos 160288 CRC32 0xea3e1dc8 	Anonymous_GTID	last_committed=334	sequence_number=335	rbr_only=yes	original_committed_timestamp=1789972559216061	immediate_commit_timestamp=1789972559216061	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972559216061 (2026-09-21 13:35:59.216061 SE Asia Standard Time)
# immediate_commit_timestamp=1789972559216061 (2026-09-21 13:35:59.216061 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972559216061*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 160288
#260921 13:35:59 server id 1  end_log_pos 160378 CRC32 0x702f95b5 	Query	thread_id=231	exec_time=0	error_code=0
SET TIMESTAMP=1789972559/*!*/;
BEGIN
/*!*/;
# at 160378
#260921 13:35:59 server id 1  end_log_pos 160452 CRC32 0x46984b93 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 160452
#260921 13:35:59 server id 1  end_log_pos 161156 CRC32 0xd15b4248 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
T9CwahMBAAAASgAAAMRyAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JNLmEY=
T9Cwah8BAAAAwAIAAIR1AgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1O0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09T9CwakhCW9E=
'/*!*/;
# at 161156
#260921 13:35:59 server id 1  end_log_pos 161187 CRC32 0x74d2382c 	Xid = 20399
COMMIT/*!*/;
# at 161187
#260921 13:36:00 server id 1  end_log_pos 161266 CRC32 0xa2b3f871 	Anonymous_GTID	last_committed=335	sequence_number=336	rbr_only=yes	original_committed_timestamp=1789972560341803	immediate_commit_timestamp=1789972560341803	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972560341803 (2026-09-21 13:36:00.341803 SE Asia Standard Time)
# immediate_commit_timestamp=1789972560341803 (2026-09-21 13:36:00.341803 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972560341803*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 161266
#260921 13:36:00 server id 1  end_log_pos 161356 CRC32 0x34c774c0 	Query	thread_id=233	exec_time=0	error_code=0
SET TIMESTAMP=1789972560/*!*/;
BEGIN
/*!*/;
# at 161356
#260921 13:36:00 server id 1  end_log_pos 161430 CRC32 0xa991f5ff 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 161430
#260921 13:36:00 server id 1  end_log_pos 162134 CRC32 0xe3861efd 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
UNCwahMBAAAASgAAAJZ2AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4P/1kak=
UNCwah8BAAAAwAIAAFZ5AgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1P0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09UNCwav0ehuM=
'/*!*/;
# at 162134
#260921 13:36:00 server id 1  end_log_pos 162165 CRC32 0x399067ce 	Xid = 20417
COMMIT/*!*/;
# at 162165
#260921 13:36:01 server id 1  end_log_pos 162244 CRC32 0xa6c1352e 	Anonymous_GTID	last_committed=336	sequence_number=337	rbr_only=yes	original_committed_timestamp=1789972561424575	immediate_commit_timestamp=1789972561424575	transaction_length=834
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972561424575 (2026-09-21 13:36:01.424575 SE Asia Standard Time)
# immediate_commit_timestamp=1789972561424575 (2026-09-21 13:36:01.424575 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972561424575*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 162244
#260921 13:36:01 server id 1  end_log_pos 162325 CRC32 0xf88f55fe 	Query	thread_id=235	exec_time=0	error_code=0
SET TIMESTAMP=1789972561/*!*/;
BEGIN
/*!*/;
# at 162325
#260921 13:36:01 server id 1  end_log_pos 162399 CRC32 0xc884d1ba 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 162399
#260921 13:36:01 server id 1  end_log_pos 162968 CRC32 0x2bb73e88 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
UdCwahMBAAAASgAAAF96AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LrRhMg=
UdCwaiABAAAAOQIAAJh8AgAAAFMAAAAAAAEAAgAG/wAoAGRVeDI4T1U3OWVZdmNpVjBCQ1RRQ0pv
SDFhYlZzc1JHYlNibWVmeW4EAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNmABAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVJYRTFVazVpZEhwRmNuWXlRM1pwV1ROQllXSnJNR3hsWW1ab2MwNUZhR1p5
ZWpoR1JWbFhjU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNW
MFpTSTdjem8wT2lKb2IyMWxJanQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5QKCwaog+tys=
'/*!*/;
# at 162968
#260921 13:36:01 server id 1  end_log_pos 162999 CRC32 0x57092574 	Xid = 20435
COMMIT/*!*/;
# at 162999
#260921 13:36:01 server id 1  end_log_pos 163078 CRC32 0x275b2b1d 	Anonymous_GTID	last_committed=337	sequence_number=338	rbr_only=yes	original_committed_timestamp=1789972561490614	immediate_commit_timestamp=1789972561490614	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972561490614 (2026-09-21 13:36:01.490614 SE Asia Standard Time)
# immediate_commit_timestamp=1789972561490614 (2026-09-21 13:36:01.490614 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972561490614*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 163078
#260921 13:36:01 server id 1  end_log_pos 163168 CRC32 0x74ec995d 	Query	thread_id=235	exec_time=0	error_code=0
SET TIMESTAMP=1789972561/*!*/;
BEGIN
/*!*/;
# at 163168
#260921 13:36:01 server id 1  end_log_pos 163242 CRC32 0x6f79dde6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 163242
#260921 13:36:01 server id 1  end_log_pos 163946 CRC32 0x102b549b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
UdCwahMBAAAASgAAAKp9AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ObdeW8=
UdCwah8BAAAAwAIAAGqAAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1Q0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09UdCwaptUKxA=
'/*!*/;
# at 163946
#260921 13:36:01 server id 1  end_log_pos 163977 CRC32 0xff80da4c 	Xid = 20438
COMMIT/*!*/;
# at 163977
#260921 13:36:02 server id 1  end_log_pos 164056 CRC32 0x8352feb2 	Anonymous_GTID	last_committed=338	sequence_number=339	rbr_only=yes	original_committed_timestamp=1789972562050099	immediate_commit_timestamp=1789972562050099	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972562050099 (2026-09-21 13:36:02.050099 SE Asia Standard Time)
# immediate_commit_timestamp=1789972562050099 (2026-09-21 13:36:02.050099 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972562050099*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 164056
#260921 13:36:02 server id 1  end_log_pos 164146 CRC32 0x724c9090 	Query	thread_id=236	exec_time=0	error_code=0
SET TIMESTAMP=1789972562/*!*/;
BEGIN
/*!*/;
# at 164146
#260921 13:36:02 server id 1  end_log_pos 164220 CRC32 0x7c9f7d77 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 164220
#260921 13:36:02 server id 1  end_log_pos 164924 CRC32 0x43bd0c7b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
UtCwahMBAAAASgAAAHyBAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Hd9n3w=
UtCwah8BAAAAwAIAADyEAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1R0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09UtCwansMvUM=
'/*!*/;
# at 164924
#260921 13:36:02 server id 1  end_log_pos 164955 CRC32 0xd6f466e0 	Xid = 20447
COMMIT/*!*/;
# at 164955
#260921 13:36:03 server id 1  end_log_pos 165034 CRC32 0x622c6476 	Anonymous_GTID	last_committed=339	sequence_number=340	rbr_only=yes	original_committed_timestamp=1789972563107988	immediate_commit_timestamp=1789972563107988	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972563107988 (2026-09-21 13:36:03.107988 SE Asia Standard Time)
# immediate_commit_timestamp=1789972563107988 (2026-09-21 13:36:03.107988 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972563107988*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 165034
#260921 13:36:03 server id 1  end_log_pos 165124 CRC32 0x25cbf784 	Query	thread_id=238	exec_time=0	error_code=0
SET TIMESTAMP=1789972563/*!*/;
BEGIN
/*!*/;
# at 165124
#260921 13:36:03 server id 1  end_log_pos 165198 CRC32 0x909cce8b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 165198
#260921 13:36:03 server id 1  end_log_pos 165902 CRC32 0xa7c0fdd1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
U9CwahMBAAAASgAAAE6FAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IvOnJA=
U9Cwah8BAAAAwAIAAA6IAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1S0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09U9CwatH9wKc=
'/*!*/;
# at 165902
#260921 13:36:03 server id 1  end_log_pos 165933 CRC32 0xdc934ccd 	Xid = 20465
COMMIT/*!*/;
# at 165933
#260921 13:36:04 server id 1  end_log_pos 166012 CRC32 0xdd2e9281 	Anonymous_GTID	last_committed=340	sequence_number=341	rbr_only=yes	original_committed_timestamp=1789972564163990	immediate_commit_timestamp=1789972564163990	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972564163990 (2026-09-21 13:36:04.163990 SE Asia Standard Time)
# immediate_commit_timestamp=1789972564163990 (2026-09-21 13:36:04.163990 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972564163990*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 166012
#260921 13:36:04 server id 1  end_log_pos 166102 CRC32 0xf8a3c172 	Query	thread_id=240	exec_time=0	error_code=0
SET TIMESTAMP=1789972564/*!*/;
BEGIN
/*!*/;
# at 166102
#260921 13:36:04 server id 1  end_log_pos 166176 CRC32 0xf6320800 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 166176
#260921 13:36:04 server id 1  end_log_pos 166880 CRC32 0x64569954 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
VNCwahMBAAAASgAAACCJAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AAIMvY=
VNCwah8BAAAAwAIAAOCLAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1T0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09VNCwalSZVmQ=
'/*!*/;
# at 166880
#260921 13:36:04 server id 1  end_log_pos 166911 CRC32 0xda427947 	Xid = 20483
COMMIT/*!*/;
# at 166911
#260921 13:36:05 server id 1  end_log_pos 166990 CRC32 0xdfcb587f 	Anonymous_GTID	last_committed=341	sequence_number=342	rbr_only=yes	original_committed_timestamp=1789972565231698	immediate_commit_timestamp=1789972565231698	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972565231698 (2026-09-21 13:36:05.231698 SE Asia Standard Time)
# immediate_commit_timestamp=1789972565231698 (2026-09-21 13:36:05.231698 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972565231698*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 166990
#260921 13:36:05 server id 1  end_log_pos 167080 CRC32 0x57008bf7 	Query	thread_id=242	exec_time=0	error_code=0
SET TIMESTAMP=1789972565/*!*/;
BEGIN
/*!*/;
# at 167080
#260921 13:36:05 server id 1  end_log_pos 167154 CRC32 0xdb6f64a7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 167154
#260921 13:36:05 server id 1  end_log_pos 167858 CRC32 0x036f78ab 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
VdCwahMBAAAASgAAAPKMAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Kdkb9s=
VdCwah8BAAAAwAIAALKPAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1U0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09VdCwaqt4bwM=
'/*!*/;
# at 167858
#260921 13:36:05 server id 1  end_log_pos 167889 CRC32 0xc85c1d64 	Xid = 20501
COMMIT/*!*/;
# at 167889
#260921 13:36:06 server id 1  end_log_pos 167968 CRC32 0x6ec264fb 	Anonymous_GTID	last_committed=342	sequence_number=343	rbr_only=yes	original_committed_timestamp=1789972566358384	immediate_commit_timestamp=1789972566358384	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972566358384 (2026-09-21 13:36:06.358384 SE Asia Standard Time)
# immediate_commit_timestamp=1789972566358384 (2026-09-21 13:36:06.358384 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972566358384*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 167968
#260921 13:36:06 server id 1  end_log_pos 168058 CRC32 0xcb316cbb 	Query	thread_id=244	exec_time=0	error_code=0
SET TIMESTAMP=1789972566/*!*/;
BEGIN
/*!*/;
# at 168058
#260921 13:36:06 server id 1  end_log_pos 168132 CRC32 0x09834b94 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 168132
#260921 13:36:06 server id 1  end_log_pos 168836 CRC32 0x77dc7c41 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
VtCwahMBAAAASgAAAMSQAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JRLgwk=
VtCwah8BAAAAwAIAAISTAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1V0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09VtCwakF83Hc=
'/*!*/;
# at 168836
#260921 13:36:06 server id 1  end_log_pos 168867 CRC32 0x029919bf 	Xid = 20522
COMMIT/*!*/;
# at 168867
#260921 13:36:07 server id 1  end_log_pos 168946 CRC32 0xa22d2c83 	Anonymous_GTID	last_committed=343	sequence_number=344	rbr_only=yes	original_committed_timestamp=1789972567459469	immediate_commit_timestamp=1789972567459469	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972567459469 (2026-09-21 13:36:07.459469 SE Asia Standard Time)
# immediate_commit_timestamp=1789972567459469 (2026-09-21 13:36:07.459469 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972567459469*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 168946
#260921 13:36:07 server id 1  end_log_pos 169036 CRC32 0x9cb60baf 	Query	thread_id=246	exec_time=0	error_code=0
SET TIMESTAMP=1789972567/*!*/;
BEGIN
/*!*/;
# at 169036
#260921 13:36:07 server id 1  end_log_pos 169110 CRC32 0xda393e2f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 169110
#260921 13:36:07 server id 1  end_log_pos 169814 CRC32 0x4e5026d6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
V9CwahMBAAAASgAAAJaUAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4C8+Odo=
V9Cwah8BAAAAwAIAAFaXAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1W0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09V9CwatYmUE4=
'/*!*/;
# at 169814
#260921 13:36:07 server id 1  end_log_pos 169845 CRC32 0x4ac23f0d 	Xid = 20540
COMMIT/*!*/;
# at 169845
#260921 13:36:08 server id 1  end_log_pos 169924 CRC32 0x0372be1d 	Anonymous_GTID	last_committed=344	sequence_number=345	rbr_only=yes	original_committed_timestamp=1789972568521184	immediate_commit_timestamp=1789972568521184	transaction_length=978
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972568521184 (2026-09-21 13:36:08.521184 SE Asia Standard Time)
# immediate_commit_timestamp=1789972568521184 (2026-09-21 13:36:08.521184 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972568521184*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 169924
#260921 13:36:08 server id 1  end_log_pos 170014 CRC32 0x0f74291c 	Query	thread_id=248	exec_time=0	error_code=0
SET TIMESTAMP=1789972568/*!*/;
BEGIN
/*!*/;
# at 170014
#260921 13:36:08 server id 1  end_log_pos 170088 CRC32 0xa89b1bf5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 170088
#260921 13:36:08 server id 1  end_log_pos 170792 CRC32 0x167f1ba2 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
WNCwahMBAAAASgAAAGiYAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PUbm6g=
WNCwah8BAAAAwAIAACibAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1X0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNqAAAABZVG95T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTlmUT09WNCwaqIbfxY=
'/*!*/;
# at 170792
#260921 13:36:08 server id 1  end_log_pos 170823 CRC32 0x64e2000e 	Xid = 20558
COMMIT/*!*/;
# at 170823
#260921 13:36:15 server id 1  end_log_pos 170902 CRC32 0x70629c0e 	Anonymous_GTID	last_committed=345	sequence_number=346	rbr_only=yes	original_committed_timestamp=1789972575602286	immediate_commit_timestamp=1789972575602286	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972575602286 (2026-09-21 13:36:15.602286 SE Asia Standard Time)
# immediate_commit_timestamp=1789972575602286 (2026-09-21 13:36:15.602286 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972575602286*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 170902
#260921 13:36:15 server id 1  end_log_pos 170992 CRC32 0xd2d503c3 	Query	thread_id=249	exec_time=0	error_code=0
SET TIMESTAMP=1789972575/*!*/;
BEGIN
/*!*/;
# at 170992
#260921 13:36:15 server id 1  end_log_pos 171066 CRC32 0x7704f975 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 171066
#260921 13:36:15 server id 1  end_log_pos 171882 CRC32 0x8e1baab9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
X9CwahMBAAAASgAAADqcAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HX5BHc=
X9Cwah8BAAAAMAMAAGqfAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1Y0LBqAigAbHlkWVR3WHNDbDhPVXAxdW9ueVBUbUNJOEs1cHpv
UnNtVU9XSkhTYgkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
cEVUSGd6Y1ZKYWRVTTRhR3hpTkRWSmNITmtXa3BVY2t4T1VYVmFRbkJNWldvMU1Ia3pUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PV/QsGq5qhuO
'/*!*/;
# at 171882
#260921 13:36:15 server id 1  end_log_pos 171913 CRC32 0x1a363d91 	Xid = 20615
COMMIT/*!*/;
# at 171913
#260921 13:36:19 server id 1  end_log_pos 171992 CRC32 0x2d8b44af 	Anonymous_GTID	last_committed=346	sequence_number=347	rbr_only=yes	original_committed_timestamp=1789972579058003	immediate_commit_timestamp=1789972579058003	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972579058003 (2026-09-21 13:36:19.058003 SE Asia Standard Time)
# immediate_commit_timestamp=1789972579058003 (2026-09-21 13:36:19.058003 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972579058003*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 171992
#260921 13:36:19 server id 1  end_log_pos 172082 CRC32 0x5ae0e1d8 	Query	thread_id=250	exec_time=0	error_code=0
SET TIMESTAMP=1789972579/*!*/;
BEGIN
/*!*/;
# at 172082
#260921 13:36:19 server id 1  end_log_pos 172156 CRC32 0x5d009971 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 172156
#260921 13:36:19 server id 1  end_log_pos 173100 CRC32 0x614b541d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Y9CwahMBAAAASgAAAHygAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HGZAF0=
Y9Cwah8BAAAAsAMAACykAgAAAFMAAAAAAAEAAgAG//8CKABseWRZVHdYc0NsOE9VcDF1b255UFRt
Q0k4SzVwem9Sc21VT1dKSFNiCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pUVZwRVRIZ3pjVkphZFVNNGFHeGlORFZKY0hOa1drcFVja3hPVVhWYVFuQk1aV28xTUhr
elRpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09X9CwagIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1DSThLNXB6b1Jz
bVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lRVnBF
VEhnemNWSmFkVU00YUd4aU5EVkpjSE5rV2twVWNreE9VWFZhUW5CTVpXbzFNSGt6VGlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1Yw
WlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9Y9Cwah1US2E=
'/*!*/;
# at 173100
#260921 13:36:19 server id 1  end_log_pos 173131 CRC32 0xbb243867 	Xid = 20672
COMMIT/*!*/;
# at 173131
#260921 13:36:32 server id 1  end_log_pos 173210 CRC32 0xa4c891e8 	Anonymous_GTID	last_committed=347	sequence_number=348	rbr_only=yes	original_committed_timestamp=1789972592986589	immediate_commit_timestamp=1789972592986589	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972592986589 (2026-09-21 13:36:32.986589 SE Asia Standard Time)
# immediate_commit_timestamp=1789972592986589 (2026-09-21 13:36:32.986589 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972592986589*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 173210
#260921 13:36:32 server id 1  end_log_pos 173291 CRC32 0x1ac50d21 	Query	thread_id=251	exec_time=0	error_code=0
SET TIMESTAMP=1789972592/*!*/;
BEGIN
/*!*/;
# at 173291
#260921 13:36:32 server id 1  end_log_pos 173365 CRC32 0x0aa2df31 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 173365
#260921 13:36:32 server id 1  end_log_pos 173862 CRC32 0x9a61a41a 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
cNCwahMBAAAASgAAADWlAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DHfogo=
cNCwaiABAAAA8QEAACanAgAAAFMAAAAAAAEAAgAG/wIoAGx5ZFlUd1hzQ2w4T1VwMXVvbnlQVG1D
SThLNXB6b1JzbVVPV0pIU2IJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lRVnBFVEhnemNWSmFkVU00YUd4aU5EVkpjSE5rV2twVWNreE9VWFZhUW5CTVpXbzFNSGt6
VGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8z
TTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pv
MU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9Y9CwahqkYZo=
'/*!*/;
# at 173862
#260921 13:36:32 server id 1  end_log_pos 173893 CRC32 0x773a92f0 	Xid = 20684
COMMIT/*!*/;
# at 173893
#260921 13:36:33 server id 1  end_log_pos 173972 CRC32 0x4168ca68 	Anonymous_GTID	last_committed=348	sequence_number=349	rbr_only=yes	original_committed_timestamp=1789972593063346	immediate_commit_timestamp=1789972593063346	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972593063346 (2026-09-21 13:36:33.063346 SE Asia Standard Time)
# immediate_commit_timestamp=1789972593063346 (2026-09-21 13:36:33.063346 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972593063346*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 173972
#260921 13:36:33 server id 1  end_log_pos 174053 CRC32 0x1c2c758d 	Query	thread_id=251	exec_time=0	error_code=0
SET TIMESTAMP=1789972593/*!*/;
BEGIN
/*!*/;
# at 174053
#260921 13:36:33 server id 1  end_log_pos 174127 CRC32 0x71723280 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 174127
#260921 13:36:33 server id 1  end_log_pos 174716 CRC32 0x180bd589 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
cdCwahMBAAAASgAAAC+oAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IAycnE=
cdCwah4BAAAATQIAAHyqAgAAAFMAAAAAAAEAAgAG/wAoAHcwd0JDVzFjNDh6SEZRSVlOQTJadG9I
T1ZKa0lwSmh1ejVuMW54VGYEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVFWZFVVMGRRZEc0d2NtVmxZWE0wVlRaUk9Wa3dVMEpIU2psdFZURlhaVkp2
ZUVsSU9HcFphaUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT1x0LBqidULGA==
'/*!*/;
# at 174716
#260921 13:36:33 server id 1  end_log_pos 174747 CRC32 0x5848bb29 	Xid = 20690
COMMIT/*!*/;
# at 174747
#260921 13:36:33 server id 1  end_log_pos 174826 CRC32 0xa46d053e 	Anonymous_GTID	last_committed=349	sequence_number=350	rbr_only=yes	original_committed_timestamp=1789972593943717	immediate_commit_timestamp=1789972593943717	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972593943717 (2026-09-21 13:36:33.943717 SE Asia Standard Time)
# immediate_commit_timestamp=1789972593943717 (2026-09-21 13:36:33.943717 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972593943717*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 174826
#260921 13:36:33 server id 1  end_log_pos 174916 CRC32 0x9b0cadd0 	Query	thread_id=252	exec_time=0	error_code=0
SET TIMESTAMP=1789972593/*!*/;
BEGIN
/*!*/;
# at 174916
#260921 13:36:33 server id 1  end_log_pos 174990 CRC32 0x0fad9e54 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 174990
#260921 13:36:33 server id 1  end_log_pos 176154 CRC32 0x586ba7b7 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
cdCwahMBAAAASgAAAI6rAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FSerQ8=
cdCwah8BAAAAjAQAABqwAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09cdCwagAoAHcwd0JDVzFjNDh6SEZRSVlOQTJadG9IT1ZKa0lwSmh1ejVuMW54
VGYEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFW
ZFVVMGRRZEc0d2NtVmxZWE0wVlRaUk9Wa3dVMEpIU2psdFZURlhaVkp2ZUVsSU9HcFphaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5U
b2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PXHQsGq3p2tY
'/*!*/;
# at 176154
#260921 13:36:33 server id 1  end_log_pos 176185 CRC32 0x9fb2c202 	Xid = 20876
COMMIT/*!*/;
# at 176185
#260921 13:36:40 server id 1  end_log_pos 176264 CRC32 0xef41e16f 	Anonymous_GTID	last_committed=350	sequence_number=351	rbr_only=yes	original_committed_timestamp=1789972600983667	immediate_commit_timestamp=1789972600983667	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972600983667 (2026-09-21 13:36:40.983667 SE Asia Standard Time)
# immediate_commit_timestamp=1789972600983667 (2026-09-21 13:36:40.983667 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972600983667*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 176264
#260921 13:36:40 server id 1  end_log_pos 176354 CRC32 0xc9421c1f 	Query	thread_id=253	exec_time=0	error_code=0
SET TIMESTAMP=1789972600/*!*/;
BEGIN
/*!*/;
# at 176354
#260921 13:36:40 server id 1  end_log_pos 176428 CRC32 0x54540382 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 176428
#260921 13:36:40 server id 1  end_log_pos 177612 CRC32 0x8661c7b6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
eNCwahMBAAAASgAAACyxAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IIDVFQ=
eNCwah8BAAAAoAQAAMy1AgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1x0LBqACgAdzB3QkNXMWM0OHpIRlFJWU5B
Mlp0b0hPVkprSXBKaHV6NW4xbnhUZgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUVZkVVUwZFFkRzR3Y21WbFlYTTBWVFpST1Zrd1UwSkhTamx0VlRG
WFpWSnZlRWxJT0dwWmFpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09eNCwarbHYYY=
'/*!*/;
# at 177612
#260921 13:36:40 server id 1  end_log_pos 177643 CRC32 0x85f0cae5 	Xid = 20990
COMMIT/*!*/;
# at 177643
#260921 13:36:56 server id 1  end_log_pos 177722 CRC32 0xea1bcfdf 	Anonymous_GTID	last_committed=351	sequence_number=352	rbr_only=yes	original_committed_timestamp=1789972616160331	immediate_commit_timestamp=1789972616160331	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789972616160331 (2026-09-21 13:36:56.160331 SE Asia Standard Time)
# immediate_commit_timestamp=1789972616160331 (2026-09-21 13:36:56.160331 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789972616160331*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 177722
#260921 13:36:56 server id 1  end_log_pos 177812 CRC32 0x9e809591 	Query	thread_id=254	exec_time=0	error_code=0
SET TIMESTAMP=1789972616/*!*/;
BEGIN
/*!*/;
# at 177812
#260921 13:36:56 server id 1  end_log_pos 177886 CRC32 0x8612681b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 177886
#260921 13:36:56 server id 1  end_log_pos 179070 CRC32 0x200e2c6a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
iNCwahMBAAAASgAAAN62AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BtoEoY=
iNCwah8BAAAAoAQAAH67AgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT140LBqACgAdzB3QkNXMWM0OHpIRlFJWU5B
Mlp0b0hPVkprSXBKaHV6NW4xbnhUZgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUVZkVVUwZFFkRzR3Y21WbFlYTTBWVFpST1Zrd1UwSkhTamx0VlRG
WFpWSnZlRWxJT0dwWmFpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09iNCwamosDiA=
'/*!*/;
# at 179070
#260921 13:36:56 server id 1  end_log_pos 179101 CRC32 0x1dcaa7fe 	Xid = 21119
COMMIT/*!*/;
# at 179101
#260921 13:46:08 server id 1  end_log_pos 179180 CRC32 0xdd33ed88 	Anonymous_GTID	last_committed=352	sequence_number=353	rbr_only=yes	original_committed_timestamp=1789973168279999	immediate_commit_timestamp=1789973168279999	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973168279999 (2026-09-21 13:46:08.279999 SE Asia Standard Time)
# immediate_commit_timestamp=1789973168279999 (2026-09-21 13:46:08.279999 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973168279999*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 179180
#260921 13:46:08 server id 1  end_log_pos 179270 CRC32 0xee6c413c 	Query	thread_id=255	exec_time=0	error_code=0
SET TIMESTAMP=1789973168/*!*/;
BEGIN
/*!*/;
# at 179270
#260921 13:46:08 server id 1  end_log_pos 179344 CRC32 0xedcca7ca 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 179344
#260921 13:46:08 server id 1  end_log_pos 180524 CRC32 0xe76d85c9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
sNKwahMBAAAASgAAAJC8AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MqnzO0=
sNKwah8BAAAAnAQAACzBAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2I0LBqACgAdzB3QkNXMWM0OHpIRlFJWU5B
Mlp0b0hPVkprSXBKaHV6NW4xbnhUZgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pUVZkVVUwZFFkRzR3Y21WbFlYTTBWVFpST1Zrd1UwSkhTamx0VlRG
WFpWSnZlRWxJT0dwWmFpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXliMnhsY3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1Y205c1pYTXVhVzVrWlhn
aU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2w0rBqyYVt5w==
'/*!*/;
# at 180524
#260921 13:46:08 server id 1  end_log_pos 180555 CRC32 0x27893a07 	Xid = 21248
COMMIT/*!*/;
# at 180555
#260921 13:49:09 server id 1  end_log_pos 180634 CRC32 0x4d264af5 	Anonymous_GTID	last_committed=353	sequence_number=354	rbr_only=yes	original_committed_timestamp=1789973349111631	immediate_commit_timestamp=1789973349111631	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973349111631 (2026-09-21 13:49:09.111631 SE Asia Standard Time)
# immediate_commit_timestamp=1789973349111631 (2026-09-21 13:49:09.111631 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973349111631*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 180634
#260921 13:49:09 server id 1  end_log_pos 180724 CRC32 0x64339278 	Query	thread_id=256	exec_time=0	error_code=0
SET TIMESTAMP=1789973349/*!*/;
BEGIN
/*!*/;
# at 180724
#260921 13:49:09 server id 1  end_log_pos 180798 CRC32 0x6fe5130a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 180798
#260921 13:49:09 server id 1  end_log_pos 181974 CRC32 0xb047498c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ZdOwahMBAAAASgAAAD7CAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AoT5W8=
ZdOwah8BAAAAmAQAANbGAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5eWIy
eGxjeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVjbTlzWlhNdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPbDSsGoAKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5eWIy
eGxjeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVjbTlzWlhNdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPWXTsGqMSUew
'/*!*/;
# at 181974
#260921 13:49:09 server id 1  end_log_pos 182005 CRC32 0xc2cfc9f7 	Xid = 21371
COMMIT/*!*/;
# at 182005
#260921 13:49:23 server id 1  end_log_pos 182084 CRC32 0xec20cd0f 	Anonymous_GTID	last_committed=354	sequence_number=355	rbr_only=yes	original_committed_timestamp=1789973363105597	immediate_commit_timestamp=1789973363105597	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973363105597 (2026-09-21 13:49:23.105597 SE Asia Standard Time)
# immediate_commit_timestamp=1789973363105597 (2026-09-21 13:49:23.105597 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973363105597*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 182084
#260921 13:49:23 server id 1  end_log_pos 182174 CRC32 0x7b4a4516 	Query	thread_id=257	exec_time=0	error_code=0
SET TIMESTAMP=1789973363/*!*/;
BEGIN
/*!*/;
# at 182174
#260921 13:49:23 server id 1  end_log_pos 182248 CRC32 0xe3640c1a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 182248
#260921 13:49:23 server id 1  end_log_pos 183424 CRC32 0x99d9077c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
c9OwahMBAAAASgAAAOjHAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BoMZOM=
c9Owah8BAAAAmAQAAIDMAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5eWIy
eGxjeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVjbTlzWlhNdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPWXTsGoAKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5eWIy
eGxjeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVjbTlzWlhNdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPXPTsGp8B9mZ
'/*!*/;
# at 183424
#260921 13:49:23 server id 1  end_log_pos 183455 CRC32 0x1da98032 	Xid = 21500
COMMIT/*!*/;
# at 183455
#260921 13:49:25 server id 1  end_log_pos 183534 CRC32 0x23a51f30 	Anonymous_GTID	last_committed=355	sequence_number=356	rbr_only=yes	original_committed_timestamp=1789973365735591	immediate_commit_timestamp=1789973365735591	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973365735591 (2026-09-21 13:49:25.735591 SE Asia Standard Time)
# immediate_commit_timestamp=1789973365735591 (2026-09-21 13:49:25.735591 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973365735591*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 183534
#260921 13:49:25 server id 1  end_log_pos 183624 CRC32 0x7448ab2e 	Query	thread_id=258	exec_time=0	error_code=0
SET TIMESTAMP=1789973365/*!*/;
BEGIN
/*!*/;
# at 183624
#260921 13:49:25 server id 1  end_log_pos 183698 CRC32 0xa2a5f399 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 183698
#260921 13:49:25 server id 1  end_log_pos 184874 CRC32 0x7ba44de5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ddOwahMBAAAASgAAAJLNAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JnzpaI=
ddOwah8BAAAAmAQAACrSAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5eWIy
eGxjeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVjbTlzWlhNdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPXPTsGoAKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPXXTsGrlTaR7
'/*!*/;
# at 184874
#260921 13:49:25 server id 1  end_log_pos 184905 CRC32 0x785dbf54 	Xid = 21623
COMMIT/*!*/;
# at 184905
#260921 13:49:36 server id 1  end_log_pos 184984 CRC32 0x512e177f 	Anonymous_GTID	last_committed=356	sequence_number=357	rbr_only=yes	original_committed_timestamp=1789973376179379	immediate_commit_timestamp=1789973376179379	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973376179379 (2026-09-21 13:49:36.179379 SE Asia Standard Time)
# immediate_commit_timestamp=1789973376179379 (2026-09-21 13:49:36.179379 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973376179379*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 184984
#260921 13:49:36 server id 1  end_log_pos 185074 CRC32 0x8760278c 	Query	thread_id=259	exec_time=0	error_code=0
SET TIMESTAMP=1789973376/*!*/;
BEGIN
/*!*/;
# at 185074
#260921 13:49:36 server id 1  end_log_pos 185148 CRC32 0x0e518d2c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 185148
#260921 13:49:36 server id 1  end_log_pos 186324 CRC32 0x2efa0ab0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
gNOwahMBAAAASgAAADzTAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CyNUQ4=
gNOwah8BAAAAmAQAANTXAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPXXTsGoAKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPYDTsGqwCvou
'/*!*/;
# at 186324
#260921 13:49:36 server id 1  end_log_pos 186355 CRC32 0x3ccfa3a8 	Xid = 21740
COMMIT/*!*/;
# at 186355
#260921 13:50:23 server id 1  end_log_pos 186434 CRC32 0xe5fb33f7 	Anonymous_GTID	last_committed=357	sequence_number=358	rbr_only=yes	original_committed_timestamp=1789973423291016	immediate_commit_timestamp=1789973423291016	transaction_length=2202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973423291016 (2026-09-21 13:50:23.291016 SE Asia Standard Time)
# immediate_commit_timestamp=1789973423291016 (2026-09-21 13:50:23.291016 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973423291016*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 186434
#260921 13:50:23 server id 1  end_log_pos 186524 CRC32 0x7e3db0b6 	Query	thread_id=260	exec_time=0	error_code=0
SET TIMESTAMP=1789973423/*!*/;
BEGIN
/*!*/;
# at 186524
#260921 13:50:23 server id 1  end_log_pos 186598 CRC32 0x1a13f6ee 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 186598
#260921 13:50:23 server id 1  end_log_pos 188526 CRC32 0x85da94a7 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
r9OwahMBAAAASgAAAObYAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O72Exo=
r9Owah8BAAAAiAcAAG7gAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPYDTsGoAKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0BAAAWVRvMk9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNanA3
YVRvd08zTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yazZNVHR6T2pZNkltVnljbTl5Y3lJN2ZYTTZN
em9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNt
d2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJ
N2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalV3
T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRa
V0UwWlRNd09UZzVaQ0k3YVRvME8zTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yRTZOanA3Y3pvMk9p
SmZkRzlyWlc0aU8zTTZOREE2SWtGWFZGTkhVSFJ1TUhKbFpXRnpORlUyVVRsWk1GTkNSMG81YlZV
eFYyVlNiM2hKU0RocVdXb2lPM002TkRvaWJtRnRaU0k3Y3pveE1qb2lZWE5sY0d0aGNubGhkMkZ1
SWp0ek9qVTZJbVZ0WVdsc0lqdHpPakl4T2lKemVXRm1hWEYzYkdSdU1FQm5iV0ZwYkM1amIyMGlP
M002TnpvaWNtOXNaVjlwWkNJN2N6b3hPaUl5SWp0ek9qVTZJbTV2WDJod0lqdHpPakV5T2lJd09E
YzNOREE1TkRNNE9EQWlPM002TmpvaVlXeGhiV0YwSWp0ek9qUXlPaUpFWlhOaElGTnNaVzFoYmlC
Q2JHOXJJRXRsYzJGdFlta05Da3RsWTJGdFlYUmhiaUJUYkdsNVpXY2lPMzF6T2pZNkltVnljbTl5
Y3lJN1R6b3pNVG9pU1d4c2RXMXBibUYwWlZ4VGRYQndiM0owWEZacFpYZEZjbkp2Y2tKaFp5STZN
VHA3Y3pvM09pSUFLZ0JpWVdkeklqdGhPakU2ZTNNNk56b2laR1ZtWVhWc2RDSTdUem95T1RvaVNX
eHNkVzFwYm1GMFpWeFRkWEJ3YjNKMFhFMWxjM05oWjJWQ1lXY2lPakk2ZTNNNk1URTZJZ0FxQUcx
bGMzTmhaMlZ6SWp0aE9qRTZlM002TlRvaVpXMWhhV3dpTzJFNk1UcDdhVG93TzNNNk16TTZJbFJv
WlNCbGJXRnBiQ0JvWVhNZ1lXeHlaV0ZrZVNCaVpXVnVJSFJoYTJWdUxpSTdmWDF6T2prNklnQXFB
R1p2Y20xaGRDSTdjem80T2lJNmJXVnpjMkZuWlNJN2ZYMTlmUT09r9OwaqeU2oU=
'/*!*/;
# at 188526
#260921 13:50:23 server id 1  end_log_pos 188557 CRC32 0xb3425a3f 	Xid = 21767
COMMIT/*!*/;
# at 188557
#260921 13:50:24 server id 1  end_log_pos 188636 CRC32 0x1d49b28a 	Anonymous_GTID	last_committed=358	sequence_number=359	rbr_only=yes	original_committed_timestamp=1789973424044039	immediate_commit_timestamp=1789973424044039	transaction_length=2214
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973424044039 (2026-09-21 13:50:24.044039 SE Asia Standard Time)
# immediate_commit_timestamp=1789973424044039 (2026-09-21 13:50:24.044039 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973424044039*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 188636
#260921 13:50:24 server id 1  end_log_pos 188726 CRC32 0xfe73b251 	Query	thread_id=261	exec_time=0	error_code=0
SET TIMESTAMP=1789973424/*!*/;
BEGIN
/*!*/;
# at 188726
#260921 13:50:24 server id 1  end_log_pos 188800 CRC32 0xe4dcee71 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 188800
#260921 13:50:24 server id 1  end_log_pos 190740 CRC32 0xaedbd80d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
sNOwahMBAAAASgAAAIDhAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HHu3OQ=
sNOwah8BAAAAlAcAABTpAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0BAAAWVRvMk9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNanA3
YVRvd08zTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yazZNVHR6T2pZNkltVnljbTl5Y3lJN2ZYTTZN
em9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNt
d2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJ
N2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalV3
T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRa
V0UwWlRNd09UZzVaQ0k3YVRvME8zTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yRTZOanA3Y3pvMk9p
SmZkRzlyWlc0aU8zTTZOREE2SWtGWFZGTkhVSFJ1TUhKbFpXRnpORlUyVVRsWk1GTkNSMG81YlZV
eFYyVlNiM2hKU0RocVdXb2lPM002TkRvaWJtRnRaU0k3Y3pveE1qb2lZWE5sY0d0aGNubGhkMkZ1
SWp0ek9qVTZJbVZ0WVdsc0lqdHpPakl4T2lKemVXRm1hWEYzYkdSdU1FQm5iV0ZwYkM1amIyMGlP
M002TnpvaWNtOXNaVjlwWkNJN2N6b3hPaUl5SWp0ek9qVTZJbTV2WDJod0lqdHpPakV5T2lJd09E
YzNOREE1TkRNNE9EQWlPM002TmpvaVlXeGhiV0YwSWp0ek9qUXlPaUpFWlhOaElGTnNaVzFoYmlC
Q2JHOXJJRXRsYzJGdFlta05Da3RsWTJGdFlYUmhiaUJUYkdsNVpXY2lPMzF6T2pZNkltVnljbTl5
Y3lJN1R6b3pNVG9pU1d4c2RXMXBibUYwWlZ4VGRYQndiM0owWEZacFpYZEZjbkp2Y2tKaFp5STZN
VHA3Y3pvM09pSUFLZ0JpWVdkeklqdGhPakU2ZTNNNk56b2laR1ZtWVhWc2RDSTdUem95T1RvaVNX
eHNkVzFwYm1GMFpWeFRkWEJ3YjNKMFhFMWxjM05oWjJWQ1lXY2lPakk2ZTNNNk1URTZJZ0FxQUcx
bGMzTmhaMlZ6SWp0aE9qRTZlM002TlRvaVpXMWhhV3dpTzJFNk1UcDdhVG93TzNNNk16TTZJbFJv
WlNCbGJXRnBiQ0JvWVhNZ1lXeHlaV0ZrZVNCaVpXVnVJSFJoYTJWdUxpSTdmWDF6T2prNklnQXFB
R1p2Y20xaGRDSTdjem80T2lJNmJXVnpjMkZuWlNJN2ZYMTlmUT09r9OwagAoAHcwd0JDVzFjNDh6
SEZRSVlOQTJadG9IT1ZKa0lwSmh1ejVuMW54VGYEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEv
NS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hU
TUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNpABAABZVG8wT250
ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVFWZFVVMGRRZEc0d2NtVmxZWE0wVlRaUk9Wa3dVMEpI
U2psdFZURlhaVkp2ZUVsSU9HcFphaUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZi
R1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8y
RTZNanA3Y3pvek9pSjFjbXdpTzNNNk5EQTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5
aFpHMXBiaTkxYzJWeWN5OWpjbVZoZEdVaU8zTTZOVG9pY205MWRHVWlPM002TVRnNkltRmtiV2x1
TG5WelpYSnpMbU55WldGMFpTSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpN
bUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09sNOwag3Y
264=
'/*!*/;
# at 190740
#260921 13:50:24 server id 1  end_log_pos 190771 CRC32 0x68f0189e 	Xid = 21884
COMMIT/*!*/;
# at 190771
#260921 13:52:29 server id 1  end_log_pos 190850 CRC32 0xef5bdef0 	Anonymous_GTID	last_committed=359	sequence_number=360	rbr_only=yes	original_committed_timestamp=1789973549982249	immediate_commit_timestamp=1789973549982249	transaction_length=525
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973549982249 (2026-09-21 13:52:29.982249 SE Asia Standard Time)
# immediate_commit_timestamp=1789973549982249 (2026-09-21 13:52:29.982249 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973549982249*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 190850
#260921 13:52:29 server id 1  end_log_pos 190941 CRC32 0x74f57c09 	Query	thread_id=262	exec_time=0	error_code=0
SET TIMESTAMP=1789973549/*!*/;
BEGIN
/*!*/;
# at 190941
#260921 13:52:29 server id 1  end_log_pos 191029 CRC32 0x482fe167 	Table_map: `pln_up_imy`.`users` mapped to number 91
# at 191029
#260921 13:52:29 server id 1  end_log_pos 191265 CRC32 0x9a8566ef 	Write_rows: table id 91 flags: STMT_END_F

BINLOG '
LdSwahMBAAAAWAAAADXqAgAAAFsAAAAAAAMACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHgZ+EvSA==
LdSwah4BAAAA7AAAACHrAgAAAFsAAAAAAAEAAgAM//8QAQsAAAAAAAAADABhc2Vwa2FyeWF3YW4d
AHN5YWZpcS53aWxkYW4udGkuMjNAY2ljLmFjLmlkCABLYXJ5YXdhbjwAJDJ5JDEyJGEvWGJlT3FM
NjFNSFc5MmF4RExLVy4wdDhweDFFLlVVYlBsTXNDOXo1cFkvdlUvTmtITElhDDA4Nzc0MDk0Mzg4
MCoARGVzYSBTbGVtYW4gQmxvayBLZXNhbWJpDQpLZWNhbWF0YW4gU2xpeWVnarBxvWqwcb0CAAAA
AAAAAO9mhZo=
'/*!*/;
# at 191265
#260921 13:52:29 server id 1  end_log_pos 191296 CRC32 0x0ed3313b 	Xid = 21914
COMMIT/*!*/;
# at 191296
#260921 13:52:29 server id 1  end_log_pos 191375 CRC32 0xaa468082 	Anonymous_GTID	last_committed=360	sequence_number=361	rbr_only=yes	original_committed_timestamp=1789973549995221	immediate_commit_timestamp=1789973549995221	transaction_length=334
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973549995221 (2026-09-21 13:52:29.995221 SE Asia Standard Time)
# immediate_commit_timestamp=1789973549995221 (2026-09-21 13:52:29.995221 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973549995221*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 191375
#260921 13:52:29 server id 1  end_log_pos 191464 CRC32 0x4734de90 	Query	thread_id=262	exec_time=0	error_code=0
SET TIMESTAMP=1789973549/*!*/;
BEGIN
/*!*/;
# at 191464
#260921 13:52:29 server id 1  end_log_pos 191531 CRC32 0x36298082 	Table_map: `pln_up_imy`.`role_user` mapped to number 98
# at 191531
#260921 13:52:29 server id 1  end_log_pos 191599 CRC32 0x9dcc3ea6 	Write_rows: table id 98 flags: STMT_END_F

BINLOG '
LdSwahMBAAAAQwAAACvsAgAAAGIAAAAAAAEACnBsbl91cF9pbXkACXJvbGVfdXNlcgAFCAgIEREC
AAAYAQHggoApNg==
LdSwah4BAAAARAAAAG/sAgAAAGIAAAAAAAEAAgAF/wADAAAAAAAAAAsAAAAAAAAAAgAAAAAAAABq
sHG9arBxvaY+zJ0=
'/*!*/;
# at 191599
#260921 13:52:29 server id 1  end_log_pos 191630 CRC32 0x6efc3545 	Xid = 21920
COMMIT/*!*/;
# at 191630
#260921 13:52:30 server id 1  end_log_pos 191709 CRC32 0x66497c64 	Anonymous_GTID	last_committed=361	sequence_number=362	rbr_only=yes	original_committed_timestamp=1789973550070736	immediate_commit_timestamp=1789973550070736	transaction_length=1566
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973550070736 (2026-09-21 13:52:30.070736 SE Asia Standard Time)
# immediate_commit_timestamp=1789973550070736 (2026-09-21 13:52:30.070736 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973550070736*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 191709
#260921 13:52:30 server id 1  end_log_pos 191799 CRC32 0xc0905f61 	Query	thread_id=262	exec_time=0	error_code=0
SET TIMESTAMP=1789973550/*!*/;
BEGIN
/*!*/;
# at 191799
#260921 13:52:30 server id 1  end_log_pos 191873 CRC32 0x7632e7af 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 191873
#260921 13:52:30 server id 1  end_log_pos 193165 CRC32 0xb367344d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
LtSwahMBAAAASgAAAIHtAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K/nMnY=
LtSwah8BAAAADAUAAI3yAgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaQAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeTlqY21WaGRHVWlPM002TlRvaWNtOTFkR1VpTzNNNk1UZzZJbUZrYldsdUxuVnpaWEp6TG1O
eVpXRjBaU0k3ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUx
T0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PbDTsGoAKAB3MHdCQ1cxYzQ4
ekhGUUlZTkEyWnRvSE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxh
LzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtI
VE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzbsAQAAWVRvMU9u
dHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBK
SFNqbHRWVEZYWlZKdmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2
YkdRaU8yRTZNVHA3YVRvd08zTTZOem9pYzNWalkyVnpjeUk3ZlhNNk16b2libVYzSWp0aE9qQTZl
MzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOREE2SW1oMGRI
QTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMyVnljeTlqY21WaGRHVWlPM002TlRv
aWNtOTFkR1VpTzNNNk1UZzZJbUZrYldsdUxuVnpaWEp6TG1OeVpXRjBaU0k3ZlhNNk5UQTZJbXh2
WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxN
ekE1T0Rsa0lqdHBPalE3Y3pvM09pSnpkV05qWlhOeklqdHpPak13T2lKUVpXNW5aM1Z1WVNCaVpY
Sm9ZWE5wYkNCa2FYUmhiV0poYUd0aGJpNGlPMzA9LtSwak00Z7M=
'/*!*/;
# at 193165
#260921 13:52:30 server id 1  end_log_pos 193196 CRC32 0x310c097a 	Xid = 21923
COMMIT/*!*/;
# at 193196
#260921 13:52:30 server id 1  end_log_pos 193275 CRC32 0x26f48d08 	Anonymous_GTID	last_committed=362	sequence_number=363	rbr_only=yes	original_committed_timestamp=1789973550848546	immediate_commit_timestamp=1789973550848546	transaction_length=1554
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973550848546 (2026-09-21 13:52:30.848546 SE Asia Standard Time)
# immediate_commit_timestamp=1789973550848546 (2026-09-21 13:52:30.848546 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973550848546*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 193275
#260921 13:52:30 server id 1  end_log_pos 193365 CRC32 0x680c4c80 	Query	thread_id=263	exec_time=0	error_code=0
SET TIMESTAMP=1789973550/*!*/;
BEGIN
/*!*/;
# at 193365
#260921 13:52:30 server id 1  end_log_pos 193439 CRC32 0x12b074ad 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 193439
#260921 13:52:30 server id 1  end_log_pos 194719 CRC32 0xefc5f2ab 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
LtSwahMBAAAASgAAAJ/zAgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K10sBI=
LtSwah8BAAAAAAUAAJ/4AgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzbsAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNVHA3
YVRvd08zTTZOem9pYzNWalkyVnpjeUk3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOREE2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5MWMyVnljeTlqY21WaGRHVWlPM002TlRvaWNtOTFkR1VpTzNN
Nk1UZzZJbUZrYldsdUxuVnpaWEp6TG1OeVpXRjBaU0k3ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgx
T1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBP
alE3Y3pvM09pSnpkV05qWlhOeklqdHpPak13T2lKUVpXNW5aM1Z1WVNCaVpYSm9ZWE5wYkNCa2FY
UmhiV0poYUd0aGJpNGlPMzA9LtSwagAoAHcwd0JDVzFjNDh6SEZRSVlOQTJadG9IT1ZKa0lwSmh1
ejVuMW54VGYEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7
IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9t
ZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNoQBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8w
TURvaVFWZFVVMGRRZEc0d2NtVmxZWE0wVlRaUk9Wa3dVMEpIU2psdFZURlhaVkp2ZUVsSU9HcFph
aUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNN
Nk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTkxYzJWeWN5STdjem8x
T2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0dWRYTmxjbk11YVc1a1pYZ2lPMzF6T2pVd09pSnNi
MmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpU
TXdPVGc1WkNJN2FUbzBPMzA9LtSwaqvyxe8=
'/*!*/;
# at 194719
#260921 13:52:30 server id 1  end_log_pos 194750 CRC32 0xf0944e76 	Xid = 22046
COMMIT/*!*/;
# at 194750
#260921 13:52:46 server id 1  end_log_pos 194829 CRC32 0x3fb1dc3c 	Anonymous_GTID	last_committed=363	sequence_number=364	rbr_only=yes	original_committed_timestamp=1789973566237785	immediate_commit_timestamp=1789973566237785	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973566237785 (2026-09-21 13:52:46.237785 SE Asia Standard Time)
# immediate_commit_timestamp=1789973566237785 (2026-09-21 13:52:46.237785 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973566237785*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 194829
#260921 13:52:46 server id 1  end_log_pos 194919 CRC32 0x97cb4ac8 	Query	thread_id=264	exec_time=0	error_code=0
SET TIMESTAMP=1789973566/*!*/;
BEGIN
/*!*/;
# at 194919
#260921 13:52:46 server id 1  end_log_pos 194993 CRC32 0x661666b6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 194993
#260921 13:52:46 server id 1  end_log_pos 196169 CRC32 0xdec5dfd4 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
PtSwahMBAAAASgAAALH5AgAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LZmFmY=
PtSwah8BAAAAmAQAAEn+AgAAAFMAAAAAAAEAAgAG//8AKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPS7UsGoAKAB3MHdCQ1cxYzQ4ekhGUUlZTkEyWnRv
SE9WSmtJcEpodXo1bjFueFRmBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lRVmRVVTBkUWRHNHdjbVZsWVhNMFZUWlJPVmt3VTBKSFNqbHRWVEZYWlZK
dmVFbElPR3BaYWlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPT7UsGrU38Xe
'/*!*/;
# at 196169
#260921 13:52:46 server id 1  end_log_pos 196200 CRC32 0x43a1d790 	Xid = 22172
COMMIT/*!*/;
# at 196200
#260921 13:52:49 server id 1  end_log_pos 196279 CRC32 0xb1788f9e 	Anonymous_GTID	last_committed=364	sequence_number=365	rbr_only=yes	original_committed_timestamp=1789973569057375	immediate_commit_timestamp=1789973569057375	transaction_length=714
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973569057375 (2026-09-21 13:52:49.057375 SE Asia Standard Time)
# immediate_commit_timestamp=1789973569057375 (2026-09-21 13:52:49.057375 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973569057375*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 196279
#260921 13:52:49 server id 1  end_log_pos 196371 CRC32 0x9596fafc 	Query	thread_id=265	exec_time=0	error_code=0
SET TIMESTAMP=1789973569/*!*/;
BEGIN
/*!*/;
# at 196371
#260921 13:52:49 server id 1  end_log_pos 196459 CRC32 0xd55fd476 	Table_map: `pln_up_imy`.`users` mapped to number 91
# at 196459
#260921 13:52:49 server id 1  end_log_pos 196883 CRC32 0x7c507924 	Update_rows: table id 91 flags: STMT_END_F

BINLOG '
QdSwahMBAAAAWAAAAGv/AgAAAFsAAAAAAAMACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHgdtRf1Q==
QdSwah8BAAAAqAEAABMBAwAAAFsAAAAAAAEAAgAM/////8AABAAAAAAAAAAFAEFkbWluDwBhZG1p
bkBnbWFpbC5jb20NAEFkbWluaXN0cmF0b3Jqpu8iPAAkMnkkMTIkT2N3UVlua0NzVEpvQVZ5SENH
VUFITzgvTm9kaWNDZGJObk1NU1Z1Z1JvMEhUdVlWaC9JRGk8AEc2N3JubXB6UGFpMkJrdmxjVlQ4
c05uTnNnVWhtb0NvT3pJR1BHRHFlR2Q2T3hUeVI2SVdkWkE0TXlIb2qm7yJqqJFFAQAAAAAAAADA
AAQAAAAAAAAABQBBZG1pbg8AYWRtaW5AZ21haWwuY29tDQBBZG1pbmlzdHJhdG9yaqbvIjwAJDJ5
JDEyJE9jd1FZbmtDc1RKb0FWeUhDR1VBSE84L05vZGljQ2RiTm5NTVNWdWdSbzBIVHVZVmgvSURp
PABaaXQ1Y05UZEhodDM3elFIYXp4ZFZ4Z3VkcWNCeWx3aFF6YVh1R1pGWlozc2ttdnJLbVlmajN0
dVlvMGFqpu8iaqiRRQEAAAAAAAAAJHlQfA==
'/*!*/;
# at 196883
#260921 13:52:49 server id 1  end_log_pos 196914 CRC32 0x41389d3e 	Xid = 22184
COMMIT/*!*/;
# at 196914
#260921 13:52:49 server id 1  end_log_pos 196993 CRC32 0xee184340 	Anonymous_GTID	last_committed=365	sequence_number=366	rbr_only=yes	original_committed_timestamp=1789973569068452	immediate_commit_timestamp=1789973569068452	transaction_length=870
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973569068452 (2026-09-21 13:52:49.068452 SE Asia Standard Time)
# immediate_commit_timestamp=1789973569068452 (2026-09-21 13:52:49.068452 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973569068452*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 196993
#260921 13:52:49 server id 1  end_log_pos 197074 CRC32 0xd5f001b9 	Query	thread_id=265	exec_time=0	error_code=0
SET TIMESTAMP=1789973569/*!*/;
BEGIN
/*!*/;
# at 197074
#260921 13:52:49 server id 1  end_log_pos 197148 CRC32 0xc9f2c569 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 197148
#260921 13:52:49 server id 1  end_log_pos 197753 CRC32 0x85358f54 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
QdSwahMBAAAASgAAABwCAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GnF8sk=
QdSwaiABAAAAXQIAAHkEAwAAAFMAAAAAAAEAAgAG/wAoAHcwd0JDVzFjNDh6SEZRSVlOQTJadG9I
T1ZKa0lwSmh1ejVuMW54VGYEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNoQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVFWZFVVMGRRZEc0d2NtVmxZWE0wVlRaUk9Wa3dVMEpIU2psdFZURlhaVkp2
ZUVsSU9HcFphaUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTkxYzJW
eWN5STdjem8xT2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0dWRYTmxjbk11YVc1a1pYZ2lPMzF6
T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNa
alU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9PtSwalSPNYU=
'/*!*/;
# at 197753
#260921 13:52:49 server id 1  end_log_pos 197784 CRC32 0x4eb8646f 	Xid = 22187
COMMIT/*!*/;
# at 197784
#260921 13:52:49 server id 1  end_log_pos 197863 CRC32 0xf72750f8 	Anonymous_GTID	last_committed=366	sequence_number=367	rbr_only=yes	original_committed_timestamp=1789973569087366	immediate_commit_timestamp=1789973569087366	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973569087366 (2026-09-21 13:52:49.087366 SE Asia Standard Time)
# immediate_commit_timestamp=1789973569087366 (2026-09-21 13:52:49.087366 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973569087366*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 197863
#260921 13:52:49 server id 1  end_log_pos 197944 CRC32 0xf003096f 	Query	thread_id=265	exec_time=0	error_code=0
SET TIMESTAMP=1789973569/*!*/;
BEGIN
/*!*/;
# at 197944
#260921 13:52:49 server id 1  end_log_pos 198018 CRC32 0xbd1feafe 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 198018
#260921 13:52:49 server id 1  end_log_pos 198387 CRC32 0x8277baf0 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
QdSwahMBAAAASgAAAIIFAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4P7qH70=
QdSwah4BAAAAcQEAAPMGAwAAAFMAAAAAAAEAAgAG/wIoAHFEc3lTZnNTdHFpZFNCZEZPSzVjNGR5
TjBFbDRvSUdZdThMbUtTY1AJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2ljV3ROVHpoUVFWUXlZMGhSY0hsR1kxVnVOblIwYmxvMVNrOXBhRU5WVUZWd1kzUllWM2hz
YmlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PUHUsGrwuneC
'/*!*/;
# at 198387
#260921 13:52:49 server id 1  end_log_pos 198418 CRC32 0x4f4d103b 	Xid = 22193
COMMIT/*!*/;
# at 198418
#260921 13:52:49 server id 1  end_log_pos 198497 CRC32 0x407acf71 	Anonymous_GTID	last_committed=367	sequence_number=368	rbr_only=yes	original_committed_timestamp=1789973569685740	immediate_commit_timestamp=1789973569685740	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973569685740 (2026-09-21 13:52:49.685740 SE Asia Standard Time)
# immediate_commit_timestamp=1789973569685740 (2026-09-21 13:52:49.685740 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973569685740*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 198497
#260921 13:52:49 server id 1  end_log_pos 198587 CRC32 0x9a90b4df 	Query	thread_id=266	exec_time=0	error_code=0
SET TIMESTAMP=1789973569/*!*/;
BEGIN
/*!*/;
# at 198587
#260921 13:52:49 server id 1  end_log_pos 198661 CRC32 0x92501d3a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 198661
#260921 13:52:49 server id 1  end_log_pos 199477 CRC32 0x2bee5c77 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QdSwahMBAAAASgAAAAUIAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DodUJI=
QdSwah8BAAAAMAMAADULAwAAAFMAAAAAAAEAAgAG//8CKABxRHN5U2ZzU3RxaWRTQmRGT0s1YzRk
eU4wRWw0b0lHWXU4TG1LU2NQCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pY1d0TlR6aFFRVlF5WTBoUmNIbEdZMVZ1Tm5SMGJsbzFTazlwYUVOVlVGVndZM1JZVjNo
c2JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT1B1LBqAigAcURzeVNmc1N0cWlkU0JkRk9LNWM0ZHlOMEVsNG9J
R1l1OExtS1NjUAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWNX
dE5UemhRUVZReVkwaFJjSGxHWTFWdU5uUjBibG8xU2s5cGFFTlZVRlZ3WTNSWVYzaHNiaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PUHUsGp3XO4r
'/*!*/;
# at 199477
#260921 13:52:49 server id 1  end_log_pos 199508 CRC32 0x64c0fa17 	Xid = 22250
COMMIT/*!*/;
# at 199508
#260921 13:52:53 server id 1  end_log_pos 199587 CRC32 0x55678999 	Anonymous_GTID	last_committed=368	sequence_number=369	rbr_only=yes	original_committed_timestamp=1789973573194556	immediate_commit_timestamp=1789973573194556	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973573194556 (2026-09-21 13:52:53.194556 SE Asia Standard Time)
# immediate_commit_timestamp=1789973573194556 (2026-09-21 13:52:53.194556 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973573194556*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 199587
#260921 13:52:53 server id 1  end_log_pos 199677 CRC32 0xc3994e1a 	Query	thread_id=267	exec_time=0	error_code=0
SET TIMESTAMP=1789973573/*!*/;
BEGIN
/*!*/;
# at 199677
#260921 13:52:53 server id 1  end_log_pos 199751 CRC32 0xf7b99706 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 199751
#260921 13:52:53 server id 1  end_log_pos 200695 CRC32 0xbf753d7b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
RdSwahMBAAAASgAAAEcMAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AaXufc=
RdSwah8BAAAAsAMAAPcPAwAAAFMAAAAAAAEAAgAG//8CKABxRHN5U2ZzU3RxaWRTQmRGT0s1YzRk
eU4wRWw0b0lHWXU4TG1LU2NQCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pY1d0TlR6aFFRVlF5WTBoUmNIbEdZMVZ1Tm5SMGJsbzFTazlwYUVOVlVGVndZM1JZVjNo
c2JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09QdSwagIoAHFEc3lTZnNTdHFpZFNCZEZPSzVjNGR5TjBFbDRvSUdZ
dThMbUtTY1AJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2ljV3RO
VHpoUVFWUXlZMGhSY0hsR1kxVnVOblIwYmxvMVNrOXBhRU5WVUZWd1kzUllWM2hzYmlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1Yw
WlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9RdSwans9db8=
'/*!*/;
# at 200695
#260921 13:52:53 server id 1  end_log_pos 200726 CRC32 0x3506ecdf 	Xid = 22307
COMMIT/*!*/;
# at 200726
#260921 13:53:35 server id 1  end_log_pos 200805 CRC32 0xafeba5f8 	Anonymous_GTID	last_committed=369	sequence_number=370	rbr_only=yes	original_committed_timestamp=1789973615530540	immediate_commit_timestamp=1789973615530540	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973615530540 (2026-09-21 13:53:35.530540 SE Asia Standard Time)
# immediate_commit_timestamp=1789973615530540 (2026-09-21 13:53:35.530540 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973615530540*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 200805
#260921 13:53:35 server id 1  end_log_pos 200886 CRC32 0x4cded13a 	Query	thread_id=268	exec_time=0	error_code=0
SET TIMESTAMP=1789973615/*!*/;
BEGIN
/*!*/;
# at 200886
#260921 13:53:35 server id 1  end_log_pos 200960 CRC32 0x46d3429f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 200960
#260921 13:53:35 server id 1  end_log_pos 201457 CRC32 0x399d318c 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
b9SwahMBAAAASgAAAAARAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4J9C00Y=
b9SwaiABAAAA8QEAAPESAwAAAFMAAAAAAAEAAgAG/wIoAHFEc3lTZnNTdHFpZFNCZEZPSzVjNGR5
TjBFbDRvSUdZdThMbUtTY1AJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2ljV3ROVHpoUVFWUXlZMGhSY0hsR1kxVnVOblIwYmxvMVNrOXBhRU5WVUZWd1kzUllWM2hz
YmlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8z
TTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pv
MU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9RdSwaowxnTk=
'/*!*/;
# at 201457
#260921 13:53:35 server id 1  end_log_pos 201488 CRC32 0x84d2684a 	Xid = 22319
COMMIT/*!*/;
# at 201488
#260921 13:53:35 server id 1  end_log_pos 201567 CRC32 0xc16d0e6a 	Anonymous_GTID	last_committed=370	sequence_number=371	rbr_only=yes	original_committed_timestamp=1789973615596817	immediate_commit_timestamp=1789973615596817	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973615596817 (2026-09-21 13:53:35.596817 SE Asia Standard Time)
# immediate_commit_timestamp=1789973615596817 (2026-09-21 13:53:35.596817 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973615596817*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 201567
#260921 13:53:35 server id 1  end_log_pos 201648 CRC32 0x29578fa2 	Query	thread_id=268	exec_time=0	error_code=0
SET TIMESTAMP=1789973615/*!*/;
BEGIN
/*!*/;
# at 201648
#260921 13:53:35 server id 1  end_log_pos 201722 CRC32 0x04edbe54 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 201722
#260921 13:53:35 server id 1  end_log_pos 202311 CRC32 0x809e7310 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
b9SwahMBAAAASgAAAPoTAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FS+7QQ=
b9Swah4BAAAATQIAAEcWAwAAAFMAAAAAAAEAAgAG/wAoAEY3VE4zTjVZRDA2aFJFZFhPckxubDBx
YUo4NGZVWGJxM2Z2Sng4ZUQLAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWExTlhZalJXZGxWR05uZFhXRlk0WkZCdGVEUmpRVTFtWW10dFNEQjFOa1pv
V0VJd1JqSkJkeUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pFeE8zMD1v1LBqEHOegA==
'/*!*/;
# at 202311
#260921 13:53:35 server id 1  end_log_pos 202342 CRC32 0x662b0e49 	Xid = 22325
COMMIT/*!*/;
# at 202342
#260921 13:53:36 server id 1  end_log_pos 202421 CRC32 0x6ca85031 	Anonymous_GTID	last_committed=371	sequence_number=372	rbr_only=yes	original_committed_timestamp=1789973616369536	immediate_commit_timestamp=1789973616369536	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973616369536 (2026-09-21 13:53:36.369536 SE Asia Standard Time)
# immediate_commit_timestamp=1789973616369536 (2026-09-21 13:53:36.369536 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973616369536*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 202421
#260921 13:53:36 server id 1  end_log_pos 202511 CRC32 0x699af70e 	Query	thread_id=269	exec_time=0	error_code=0
SET TIMESTAMP=1789973616/*!*/;
BEGIN
/*!*/;
# at 202511
#260921 13:53:36 server id 1  end_log_pos 202585 CRC32 0x7e593ed1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 202585
#260921 13:53:36 server id 1  end_log_pos 203749 CRC32 0x8e63c4c1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
cNSwahMBAAAASgAAAFkXAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NE+WX4=
cNSwah8BAAAAjAQAAOUbAwAAAFMAAAAAAAEAAgAG//8AKABGN1ROM041WUQwNmhSRWRYT3JMbmww
cWFKODRmVVhicTNmdkp4OGVECwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lhMU5YWWpSV2RsVkdObmRYV0ZZNFpGQnRlRFJqUVUxbVltdHRTREIxTmta
b1dFSXdSakpCZHlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qRXhPMzA9b9SwagAoAEY3VE4zTjVZRDA2aFJFZFhPckxubDBxYUo4NGZVWGJxM2Z2Sng4
ZUQLAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWEx
TlhZalJXZGxWR05uZFhXRlk0WkZCdGVEUmpRVTFtWW10dFNEQjFOa1pvV0VJd1JqSkJkeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5U
b2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPakV4TzMwPXDUsGrBxGOO
'/*!*/;
# at 203749
#260921 13:53:36 server id 1  end_log_pos 203780 CRC32 0xe8397266 	Xid = 22511
COMMIT/*!*/;
# at 203780
#260921 13:54:17 server id 1  end_log_pos 203859 CRC32 0x5f003b9c 	Anonymous_GTID	last_committed=372	sequence_number=373	rbr_only=yes	original_committed_timestamp=1789973657495904	immediate_commit_timestamp=1789973657495904	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973657495904 (2026-09-21 13:54:17.495904 SE Asia Standard Time)
# immediate_commit_timestamp=1789973657495904 (2026-09-21 13:54:17.495904 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973657495904*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 203859
#260921 13:54:17 server id 1  end_log_pos 203949 CRC32 0xd5b4aacc 	Query	thread_id=270	exec_time=0	error_code=0
SET TIMESTAMP=1789973657/*!*/;
BEGIN
/*!*/;
# at 203949
#260921 13:54:17 server id 1  end_log_pos 204023 CRC32 0x35339cdf 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 204023
#260921 13:54:17 server id 1  end_log_pos 205207 CRC32 0x9f11873b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
mdSwahMBAAAASgAAAPccAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N+cMzU=
mdSwah8BAAAAoAQAAJchAwAAAFMAAAAAAAEAAgAG//8AKABGN1ROM041WUQwNmhSRWRYT3JMbmww
cWFKODRmVVhicTNmdkp4OGVECwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lhMU5YWWpSV2RsVkdObmRYV0ZZNFpGQnRlRFJqUVUxbVltdHRTREIxTmta
b1dFSXdSakpCZHlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD1w1LBqACgARjdUTjNONVlEMDZoUkVkWE9y
TG5sMHFhSjg0ZlVYYnEzZnZKeDhlRAsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pYTFOWFlqUldkbFZHTm5kWFdGWTRaRkJ0ZURSalFVMW1ZbXR0U0RC
MU5rWm9XRUl3UmpKQmR5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qRXhPMzA9mdSwajuHEZ8=
'/*!*/;
# at 205207
#260921 13:54:17 server id 1  end_log_pos 205238 CRC32 0xaa83029d 	Xid = 22637
COMMIT/*!*/;
# at 205238
#260921 13:54:50 server id 1  end_log_pos 205317 CRC32 0x26e34f8a 	Anonymous_GTID	last_committed=373	sequence_number=374	rbr_only=yes	original_committed_timestamp=1789973690672233	immediate_commit_timestamp=1789973690672233	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973690672233 (2026-09-21 13:54:50.672233 SE Asia Standard Time)
# immediate_commit_timestamp=1789973690672233 (2026-09-21 13:54:50.672233 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973690672233*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 205317
#260921 13:54:50 server id 1  end_log_pos 205398 CRC32 0xa5dfc6f7 	Query	thread_id=271	exec_time=0	error_code=0
SET TIMESTAMP=1789973690/*!*/;
BEGIN
/*!*/;
# at 205398
#260921 13:54:50 server id 1  end_log_pos 205472 CRC32 0x08bedaac 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 205472
#260921 13:54:50 server id 1  end_log_pos 206081 CRC32 0x29faae81 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
utSwahMBAAAASgAAAKAiAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Kzavgg=
utSwaiABAAAAYQIAAAElAwAAAFMAAAAAAAEAAgAG/wAoAEY3VE4zTjVZRDA2aFJFZFhPckxubDBx
YUo4NGZVWGJxM2Z2Sng4ZUQLAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWExTlhZalJXZGxWR05uZFhXRlk0WkZCdGVEUmpRVTFtWW10dFNEQjFOa1pv
V0VJd1JqSkJkeUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhO
b1ltOWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3
ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZ
emRtTlRobFlUUmxNekE1T0Rsa0lqdHBPakV4TzMwPZnUsGqBrvop
'/*!*/;
# at 206081
#260921 13:54:50 server id 1  end_log_pos 206112 CRC32 0x80b5b48b 	Xid = 22649
COMMIT/*!*/;
# at 206112
#260921 13:54:50 server id 1  end_log_pos 206191 CRC32 0x567a9eed 	Anonymous_GTID	last_committed=374	sequence_number=375	rbr_only=yes	original_committed_timestamp=1789973690695128	immediate_commit_timestamp=1789973690695128	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973690695128 (2026-09-21 13:54:50.695128 SE Asia Standard Time)
# immediate_commit_timestamp=1789973690695128 (2026-09-21 13:54:50.695128 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973690695128*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 206191
#260921 13:54:50 server id 1  end_log_pos 206272 CRC32 0xefdc742d 	Query	thread_id=271	exec_time=0	error_code=0
SET TIMESTAMP=1789973690/*!*/;
BEGIN
/*!*/;
# at 206272
#260921 13:54:50 server id 1  end_log_pos 206346 CRC32 0xca23e8d1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 206346
#260921 13:54:50 server id 1  end_log_pos 206715 CRC32 0xc4768f31 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
utSwahMBAAAASgAAAAomAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NHoI8o=
utSwah4BAAAAcQEAAHsnAwAAAFMAAAAAAAEAAgAG/wIoADhsaTRETlRXeVQzY3dybnFCV1FpVFRx
emo4SnJjaTFKa1lsWGlyM1cJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lXbmhzWWtkUk1XeENjMkV3YzFsSFoxVjBWVVpNYTBsUlRFcHJSR3RqVEV0Q1FUSXpRbHBR
VnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PbrUsGoxj3bE
'/*!*/;
# at 206715
#260921 13:54:50 server id 1  end_log_pos 206746 CRC32 0xdc14798a 	Xid = 22655
COMMIT/*!*/;
# at 206746
#260921 13:54:51 server id 1  end_log_pos 206825 CRC32 0xaea0c6f4 	Anonymous_GTID	last_committed=375	sequence_number=376	rbr_only=yes	original_committed_timestamp=1789973691433940	immediate_commit_timestamp=1789973691433940	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973691433940 (2026-09-21 13:54:51.433940 SE Asia Standard Time)
# immediate_commit_timestamp=1789973691433940 (2026-09-21 13:54:51.433940 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973691433940*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 206825
#260921 13:54:51 server id 1  end_log_pos 206915 CRC32 0xb45f17b6 	Query	thread_id=272	exec_time=0	error_code=0
SET TIMESTAMP=1789973691/*!*/;
BEGIN
/*!*/;
# at 206915
#260921 13:54:51 server id 1  end_log_pos 206989 CRC32 0x9ab51307 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 206989
#260921 13:54:51 server id 1  end_log_pos 207805 CRC32 0x141c7896 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
u9SwahMBAAAASgAAAI0oAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AcTtZo=
u9Swah8BAAAAMAMAAL0rAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT261LBqAigAOGxpNEROVFd5VDNjd3JucUJXUWlUVHF6ajhKcmNp
MUprWWxYaXIzVwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVdu
aHNZa2RSTVd4Q2MyRXdjMWxIWjFWMFZVWk1hMGxSVEVwclJHdGpURXRDUVRJelFscFFWeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PbvUsGqWeBwU
'/*!*/;
# at 207805
#260921 13:54:51 server id 1  end_log_pos 207836 CRC32 0xe13a2959 	Xid = 22712
COMMIT/*!*/;
# at 207836
#260921 13:54:52 server id 1  end_log_pos 207915 CRC32 0xc22a0d83 	Anonymous_GTID	last_committed=376	sequence_number=377	rbr_only=yes	original_committed_timestamp=1789973692033993	immediate_commit_timestamp=1789973692033993	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973692033993 (2026-09-21 13:54:52.033993 SE Asia Standard Time)
# immediate_commit_timestamp=1789973692033993 (2026-09-21 13:54:52.033993 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973692033993*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 207915
#260921 13:54:52 server id 1  end_log_pos 208005 CRC32 0xbef39b21 	Query	thread_id=273	exec_time=0	error_code=0
SET TIMESTAMP=1789973692/*!*/;
BEGIN
/*!*/;
# at 208005
#260921 13:54:52 server id 1  end_log_pos 208079 CRC32 0x14f6d186 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 208079
#260921 13:54:52 server id 1  end_log_pos 209007 CRC32 0xad5a2f86 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
vNSwahMBAAAASgAAAM8sAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IbR9hQ=
vNSwah8BAAAAoAMAAG8wAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09u9SwagIoADhsaTRETlRXeVQzY3dybnFCV1FpVFRxemo4SnJjaTFK
a1lsWGlyM1cJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbmhz
WWtkUk1XeENjMkV3YzFsSFoxVjBWVVpNYTBsUlRFcHJSR3RqVEV0Q1FUSXpRbHBRVnlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFs
SWp0OWZRPT281LBqhi9arQ==
'/*!*/;
# at 209007
#260921 13:54:52 server id 1  end_log_pos 209038 CRC32 0x155bf32d 	Xid = 22721
COMMIT/*!*/;
# at 209038
#260921 13:54:59 server id 1  end_log_pos 209117 CRC32 0xcbbb53c4 	Anonymous_GTID	last_committed=377	sequence_number=378	rbr_only=yes	original_committed_timestamp=1789973699383034	immediate_commit_timestamp=1789973699383034	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973699383034 (2026-09-21 13:54:59.383034 SE Asia Standard Time)
# immediate_commit_timestamp=1789973699383034 (2026-09-21 13:54:59.383034 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973699383034*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 209117
#260921 13:54:59 server id 1  end_log_pos 209207 CRC32 0xd00e084c 	Query	thread_id=274	exec_time=0	error_code=0
SET TIMESTAMP=1789973699/*!*/;
BEGIN
/*!*/;
# at 209207
#260921 13:54:59 server id 1  end_log_pos 209281 CRC32 0x3c9a50b5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 209281
#260921 13:54:59 server id 1  end_log_pos 210209 CRC32 0xb9bec413 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
w9SwahMBAAAASgAAAIExAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LVQmjw=
w9Swah8BAAAAoAMAACE1AwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09vNSwagIoADhsaTRETlRXeVQzY3dybnFCV1FpVFRxemo4SnJjaTFK
a1lsWGlyM1cJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbmhz
WWtkUk1XeENjMkV3YzFsSFoxVjBWVVpNYTBsUlRFcHJSR3RqVEV0Q1FUSXpRbHBRVnlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFs
SWp0OWZRPT3D1LBqE8S+uQ==
'/*!*/;
# at 210209
#260921 13:54:59 server id 1  end_log_pos 210240 CRC32 0x0c26d71d 	Xid = 22730
COMMIT/*!*/;
# at 210240
#260921 13:55:04 server id 1  end_log_pos 210319 CRC32 0xf9b1c4c2 	Anonymous_GTID	last_committed=378	sequence_number=379	rbr_only=yes	original_committed_timestamp=1789973704546998	immediate_commit_timestamp=1789973704546998	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973704546998 (2026-09-21 13:55:04.546998 SE Asia Standard Time)
# immediate_commit_timestamp=1789973704546998 (2026-09-21 13:55:04.546998 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973704546998*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 210319
#260921 13:55:04 server id 1  end_log_pos 210409 CRC32 0x7cfcccbb 	Query	thread_id=275	exec_time=0	error_code=0
SET TIMESTAMP=1789973704/*!*/;
BEGIN
/*!*/;
# at 210409
#260921 13:55:04 server id 1  end_log_pos 210483 CRC32 0x013a64b6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 210483
#260921 13:55:04 server id 1  end_log_pos 211411 CRC32 0x0a03cb83 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
yNSwahMBAAAASgAAADM2AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LZkOgE=
yNSwah8BAAAAoAMAANM5AwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09w9SwagIoADhsaTRETlRXeVQzY3dybnFCV1FpVFRxemo4SnJjaTFK
a1lsWGlyM1cJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbmhz
WWtkUk1XeENjMkV3YzFsSFoxVjBWVVpNYTBsUlRFcHJSR3RqVEV0Q1FUSXpRbHBRVnlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFs
SWp0OWZRPT3I1LBqg8sDCg==
'/*!*/;
# at 211411
#260921 13:55:04 server id 1  end_log_pos 211442 CRC32 0x4db5d054 	Xid = 22739
COMMIT/*!*/;
# at 211442
#260921 13:55:17 server id 1  end_log_pos 211521 CRC32 0x7060e8a7 	Anonymous_GTID	last_committed=379	sequence_number=380	rbr_only=yes	original_committed_timestamp=1789973717673468	immediate_commit_timestamp=1789973717673468	transaction_length=1338
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973717673468 (2026-09-21 13:55:17.673468 SE Asia Standard Time)
# immediate_commit_timestamp=1789973717673468 (2026-09-21 13:55:17.673468 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973717673468*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 211521
#260921 13:55:17 server id 1  end_log_pos 211611 CRC32 0xf1554980 	Query	thread_id=276	exec_time=0	error_code=0
SET TIMESTAMP=1789973717/*!*/;
BEGIN
/*!*/;
# at 211611
#260921 13:55:17 server id 1  end_log_pos 211685 CRC32 0x318e77ef 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 211685
#260921 13:55:17 server id 1  end_log_pos 212749 CRC32 0xfc57718e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
1dSwahMBAAAASgAAAOU6AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O93jjE=
1dSwah8BAAAAKAQAAA0/AwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09yNSwagIoADhsaTRETlRXeVQzY3dybnFCV1FpVFRxemo4SnJjaTFK
a1lsWGlyM1cJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbmhz
WWtkUk1XeENjMkV3YzFsSFoxVjBWVVpNYTBsUlRFcHJSR3RqVEV0Q1FUSXpRbHBRVnlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9p
Y205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhP
akU2ZTNNNk9Eb2lhVzUwWlc1a1pXUWlPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9E
QXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlPMzE51dSwao5xV/w=
'/*!*/;
# at 212749
#260921 13:55:17 server id 1  end_log_pos 212780 CRC32 0xc8a86101 	Xid = 22748
COMMIT/*!*/;
# at 212780
#260921 13:55:18 server id 1  end_log_pos 212859 CRC32 0x6692c9c4 	Anonymous_GTID	last_committed=380	sequence_number=381	rbr_only=yes	original_committed_timestamp=1789973718303868	immediate_commit_timestamp=1789973718303868	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973718303868 (2026-09-21 13:55:18.303868 SE Asia Standard Time)
# immediate_commit_timestamp=1789973718303868 (2026-09-21 13:55:18.303868 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973718303868*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 212859
#260921 13:55:18 server id 1  end_log_pos 212949 CRC32 0xd6120556 	Query	thread_id=277	exec_time=0	error_code=0
SET TIMESTAMP=1789973718/*!*/;
BEGIN
/*!*/;
# at 212949
#260921 13:55:18 server id 1  end_log_pos 213023 CRC32 0x7a52fcb6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 213023
#260921 13:55:18 server id 1  end_log_pos 214203 CRC32 0x56dc0cc3 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
1tSwahMBAAAASgAAAB9AAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Lb8Uno=
1tSwah8BAAAAnAQAALtEAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2mAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNt
UWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TXpv
aWRYSnNJanRoT2pFNmUzTTZPRG9pYVc1MFpXNWtaV1FpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1
TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzMxOdXUsGoCKAA4bGk0RE5UV3lU
M2N3cm5xQldRaVRUcXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0
alRFdENRVEl6UWxwUVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0
aE9qRTZlM002T0RvaWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2
T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zMTnW1LBqwwzcVg==
'/*!*/;
# at 214203
#260921 13:55:18 server id 1  end_log_pos 214234 CRC32 0x7441cf5c 	Xid = 22805
COMMIT/*!*/;
# at 214234
#260921 13:55:28 server id 1  end_log_pos 214313 CRC32 0x7c699ac9 	Anonymous_GTID	last_committed=381	sequence_number=382	rbr_only=yes	original_committed_timestamp=1789973728745747	immediate_commit_timestamp=1789973728745747	transaction_length=1922
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973728745747 (2026-09-21 13:55:28.745747 SE Asia Standard Time)
# immediate_commit_timestamp=1789973728745747 (2026-09-21 13:55:28.745747 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973728745747*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 214313
#260921 13:55:28 server id 1  end_log_pos 214403 CRC32 0x64d606f9 	Query	thread_id=278	exec_time=0	error_code=0
SET TIMESTAMP=1789973728/*!*/;
BEGIN
/*!*/;
# at 214403
#260921 13:55:28 server id 1  end_log_pos 214477 CRC32 0x63608699 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 214477
#260921 13:55:28 server id 1  end_log_pos 216125 CRC32 0xaf8fcb40 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4NSwahMBAAAASgAAAM1FAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JmGYGM=
4NSwah8BAAAAcAYAAD1MAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6
bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0Rv
aWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFw
Ymk5a1lYTm9ZbTloY21RaU8zMTnW1LBqAigAOGxpNEROVFd5VDNjd3JucUJXUWlUVHF6ajhKcmNp
MUprWWxYaXIzVwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNmwDAABZVG8yT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVdu
aHNZa2RSTVd4Q2MyRXdjMWxIWjFWMFZVWk1hMGxSVEVwclJHdGpURXRDUVRJelFscFFWeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1qcDdhVG93TzNNNk1UQTZJbDl2
YkdSZmFXNXdkWFFpTzJrNk1UdHpPalk2SW1WeWNtOXljeUk3ZlhNNk16b2libVYzSWp0aE9qQTZl
MzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRI
QTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJ
N2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9pYVc1MFpXNWtaV1Fp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzMxek9qRXdPaUpmYjJ4a1gybHVjSFYwSWp0aE9qRTZlM002TlRvaVpXMWhhV3dpTzNNNk1q
RTZJbk41WVdacGNYZHNaRzR3UUdkdFlXbHNMbU52YlNJN2ZYTTZOam9pWlhKeWIzSnpJanRQT2pN
eE9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNWbWxsZDBWeWNtOXlRbUZuSWpveE9udHpPamM2
SWdBcUFHSmhaM01pTzJFNk1UcDdjem8zT2lKa1pXWmhkV3gwSWp0UE9qSTVPaUpKYkd4MWJXbHVZ
WFJsWEZOMWNIQnZjblJjVFdWemMyRm5aVUpoWnlJNk1qcDdjem94TVRvaUFDb0FiV1Z6YzJGblpY
TWlPMkU2TVRwN2N6bzFPaUpsYldGcGJDSTdZVG94T250cE9qQTdjem8wTXpvaVZHaGxjMlVnWTNK
bFpHVnVkR2xoYkhNZ1pHOGdibTkwSUcxaGRHTm9JRzkxY2lCeVpXTnZjbVJ6TGlJN2ZYMXpPams2
SWdBcUFHWnZjbTFoZENJN2N6bzRPaUk2YldWemMyRm5aU0k3ZlgxOWZRPT3g1LBqQMuPrw==
'/*!*/;
# at 216125
#260921 13:55:28 server id 1  end_log_pos 216156 CRC32 0x0ab045da 	Xid = 22817
COMMIT/*!*/;
# at 216156
#260921 13:55:29 server id 1  end_log_pos 216235 CRC32 0xc65f26cb 	Anonymous_GTID	last_committed=382	sequence_number=383	rbr_only=yes	original_committed_timestamp=1789973729360790	immediate_commit_timestamp=1789973729360790	transaction_length=1922
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973729360790 (2026-09-21 13:55:29.360790 SE Asia Standard Time)
# immediate_commit_timestamp=1789973729360790 (2026-09-21 13:55:29.360790 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973729360790*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 216235
#260921 13:55:29 server id 1  end_log_pos 216325 CRC32 0x09113481 	Query	thread_id=279	exec_time=0	error_code=0
SET TIMESTAMP=1789973729/*!*/;
BEGIN
/*!*/;
# at 216325
#260921 13:55:29 server id 1  end_log_pos 216399 CRC32 0x04898e49 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 216399
#260921 13:55:29 server id 1  end_log_pos 218047 CRC32 0x530395db 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4dSwahMBAAAASgAAAE9NAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EmOiQQ=
4dSwah8BAAAAcAYAAL9TAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2bAMAAFlUbzJPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TWpwN2FUb3dPM002
TVRBNklsOXZiR1JmYVc1d2RYUWlPMms2TVR0ek9qWTZJbVZ5Y205eWN5STdmWE02TXpvaWJtVjNJ
anRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16
TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lK
eWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakU2ZTNNNk9Eb2lhVzUw
Wlc1a1pXUWlPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZ
WE5vWW05aGNtUWlPMzF6T2pFd09pSmZiMnhrWDJsdWNIVjBJanRoT2pFNmUzTTZOVG9pWlcxaGFX
d2lPM002TWpFNkluTjVZV1pwY1hkc1pHNHdRR2R0WVdsc0xtTnZiU0k3ZlhNNk5qb2laWEp5YjNK
eklqdFBPak14T2lKSmJHeDFiV2x1WVhSbFhGTjFjSEJ2Y25SY1ZtbGxkMFZ5Y205eVFtRm5Jam94
T250ek9qYzZJZ0FxQUdKaFozTWlPMkU2TVRwN2N6bzNPaUprWldaaGRXeDBJanRQT2pJNU9pSkpi
R3gxYldsdVlYUmxYRk4xY0hCdmNuUmNUV1Z6YzJGblpVSmhaeUk2TWpwN2N6b3hNVG9pQUNvQWJX
VnpjMkZuWlhNaU8yRTZNVHA3Y3pvMU9pSmxiV0ZwYkNJN1lUb3hPbnRwT2pBN2N6bzBNem9pVkdo
bGMyVWdZM0psWkdWdWRHbGhiSE1nWkc4Z2JtOTBJRzFoZEdOb0lHOTFjaUJ5WldOdmNtUnpMaUk3
Zlgxek9qazZJZ0FxQUdadmNtMWhkQ0k3Y3pvNE9pSTZiV1Z6YzJGblpTSTdmWDE5ZlE9PeDUsGoC
KAA4bGk0RE5UV3lUM2N3cm5xQldRaVRUcXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96
aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2
IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlU
bzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVa
TWEwbFJURXByUkd0alRFdENRVEl6UWxwUVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96
T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZk
WE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9E
QXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhN
Nk16b2lkWEpzSWp0aE9qRTZlM002T0RvaWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zMTnh1LBq25UDUw==
'/*!*/;
# at 218047
#260921 13:55:29 server id 1  end_log_pos 218078 CRC32 0x646c8bfd 	Xid = 22874
COMMIT/*!*/;
# at 218078
#260921 13:55:38 server id 1  end_log_pos 218157 CRC32 0x1a9dc82c 	Anonymous_GTID	last_committed=383	sequence_number=384	rbr_only=yes	original_committed_timestamp=1789973738389746	immediate_commit_timestamp=1789973738389746	transaction_length=1922
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973738389746 (2026-09-21 13:55:38.389746 SE Asia Standard Time)
# immediate_commit_timestamp=1789973738389746 (2026-09-21 13:55:38.389746 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973738389746*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 218157
#260921 13:55:38 server id 1  end_log_pos 218247 CRC32 0x8bc4b14e 	Query	thread_id=280	exec_time=0	error_code=0
SET TIMESTAMP=1789973738/*!*/;
BEGIN
/*!*/;
# at 218247
#260921 13:55:38 server id 1  end_log_pos 218321 CRC32 0x9e9aed83 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 218321
#260921 13:55:38 server id 1  end_log_pos 219969 CRC32 0x1f90bd90 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6tSwahMBAAAASgAAANFUAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IPtmp4=
6tSwah8BAAAAcAYAAEFbAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6
bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0Rv
aWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFw
Ymk5a1lYTm9ZbTloY21RaU8zMTnh1LBqAigAOGxpNEROVFd5VDNjd3JucUJXUWlUVHF6ajhKcmNp
MUprWWxYaXIzVwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNmwDAABZVG8yT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVdu
aHNZa2RSTVd4Q2MyRXdjMWxIWjFWMFZVWk1hMGxSVEVwclJHdGpURXRDUVRJelFscFFWeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1qcDdhVG93TzNNNk1UQTZJbDl2
YkdSZmFXNXdkWFFpTzJrNk1UdHpPalk2SW1WeWNtOXljeUk3ZlhNNk16b2libVYzSWp0aE9qQTZl
MzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRI
QTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJ
N2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9pYVc1MFpXNWtaV1Fp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzMxek9qRXdPaUpmYjJ4a1gybHVjSFYwSWp0aE9qRTZlM002TlRvaVpXMWhhV3dpTzNNNk1q
RTZJbk41WVdacGNYZHNaRzR3UUdkdFlXbHNMbU52YlNJN2ZYTTZOam9pWlhKeWIzSnpJanRQT2pN
eE9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNWbWxsZDBWeWNtOXlRbUZuSWpveE9udHpPamM2
SWdBcUFHSmhaM01pTzJFNk1UcDdjem8zT2lKa1pXWmhkV3gwSWp0UE9qSTVPaUpKYkd4MWJXbHVZ
WFJsWEZOMWNIQnZjblJjVFdWemMyRm5aVUpoWnlJNk1qcDdjem94TVRvaUFDb0FiV1Z6YzJGblpY
TWlPMkU2TVRwN2N6bzFPaUpsYldGcGJDSTdZVG94T250cE9qQTdjem8wTXpvaVZHaGxjMlVnWTNK
bFpHVnVkR2xoYkhNZ1pHOGdibTkwSUcxaGRHTm9JRzkxY2lCeVpXTnZjbVJ6TGlJN2ZYMXpPams2
SWdBcUFHWnZjbTFoZENJN2N6bzRPaUk2YldWemMyRm5aU0k3ZlgxOWZRPT3q1LBqkL2QHw==
'/*!*/;
# at 219969
#260921 13:55:38 server id 1  end_log_pos 220000 CRC32 0x7e251b3d 	Xid = 22886
COMMIT/*!*/;
# at 220000
#260921 13:55:39 server id 1  end_log_pos 220079 CRC32 0x8145a3bf 	Anonymous_GTID	last_committed=384	sequence_number=385	rbr_only=yes	original_committed_timestamp=1789973739136570	immediate_commit_timestamp=1789973739136570	transaction_length=1922
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973739136570 (2026-09-21 13:55:39.136570 SE Asia Standard Time)
# immediate_commit_timestamp=1789973739136570 (2026-09-21 13:55:39.136570 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973739136570*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 220079
#260921 13:55:39 server id 1  end_log_pos 220169 CRC32 0x35a57a42 	Query	thread_id=281	exec_time=0	error_code=0
SET TIMESTAMP=1789973739/*!*/;
BEGIN
/*!*/;
# at 220169
#260921 13:55:39 server id 1  end_log_pos 220243 CRC32 0xf973e553 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 220243
#260921 13:55:39 server id 1  end_log_pos 221891 CRC32 0xab74333c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
69SwahMBAAAASgAAAFNcAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FPlc/k=
69Swah8BAAAAcAYAAMNiAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2bAMAAFlUbzJPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TWpwN2FUb3dPM002
TVRBNklsOXZiR1JmYVc1d2RYUWlPMms2TVR0ek9qWTZJbVZ5Y205eWN5STdmWE02TXpvaWJtVjNJ
anRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16
TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lK
eWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakU2ZTNNNk9Eb2lhVzUw
Wlc1a1pXUWlPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZ
WE5vWW05aGNtUWlPMzF6T2pFd09pSmZiMnhrWDJsdWNIVjBJanRoT2pFNmUzTTZOVG9pWlcxaGFX
d2lPM002TWpFNkluTjVZV1pwY1hkc1pHNHdRR2R0WVdsc0xtTnZiU0k3ZlhNNk5qb2laWEp5YjNK
eklqdFBPak14T2lKSmJHeDFiV2x1WVhSbFhGTjFjSEJ2Y25SY1ZtbGxkMFZ5Y205eVFtRm5Jam94
T250ek9qYzZJZ0FxQUdKaFozTWlPMkU2TVRwN2N6bzNPaUprWldaaGRXeDBJanRQT2pJNU9pSkpi
R3gxYldsdVlYUmxYRk4xY0hCdmNuUmNUV1Z6YzJGblpVSmhaeUk2TWpwN2N6b3hNVG9pQUNvQWJX
VnpjMkZuWlhNaU8yRTZNVHA3Y3pvMU9pSmxiV0ZwYkNJN1lUb3hPbnRwT2pBN2N6bzBNem9pVkdo
bGMyVWdZM0psWkdWdWRHbGhiSE1nWkc4Z2JtOTBJRzFoZEdOb0lHOTFjaUJ5WldOdmNtUnpMaUk3
Zlgxek9qazZJZ0FxQUdadmNtMWhkQ0k3Y3pvNE9pSTZiV1Z6YzJGblpTSTdmWDE5ZlE9PerUsGoC
KAA4bGk0RE5UV3lUM2N3cm5xQldRaVRUcXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96
aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2
IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlU
bzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVa
TWEwbFJURXByUkd0alRFdENRVEl6UWxwUVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96
T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZk
WE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9E
QXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhN
Nk16b2lkWEpzSWp0aE9qRTZlM002T0RvaWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zMTnr1LBqPDN0qw==
'/*!*/;
# at 221891
#260921 13:55:39 server id 1  end_log_pos 221922 CRC32 0x127cc395 	Xid = 22943
COMMIT/*!*/;
# at 221922
#260921 13:55:51 server id 1  end_log_pos 222001 CRC32 0xf1a2dfb1 	Anonymous_GTID	last_committed=385	sequence_number=386	rbr_only=yes	original_committed_timestamp=1789973751184208	immediate_commit_timestamp=1789973751184208	transaction_length=1922
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973751184208 (2026-09-21 13:55:51.184208 SE Asia Standard Time)
# immediate_commit_timestamp=1789973751184208 (2026-09-21 13:55:51.184208 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973751184208*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 222001
#260921 13:55:51 server id 1  end_log_pos 222091 CRC32 0x79b21377 	Query	thread_id=282	exec_time=0	error_code=0
SET TIMESTAMP=1789973751/*!*/;
BEGIN
/*!*/;
# at 222091
#260921 13:55:51 server id 1  end_log_pos 222165 CRC32 0x7da3110f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 222165
#260921 13:55:51 server id 1  end_log_pos 223813 CRC32 0x572630ac 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
99SwahMBAAAASgAAANVjAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4A8Ro30=
99Swah8BAAAAcAYAAEVqAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6
bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0Rv
aWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFw
Ymk5a1lYTm9ZbTloY21RaU8zMTnr1LBqAigAOGxpNEROVFd5VDNjd3JucUJXUWlUVHF6ajhKcmNp
MUprWWxYaXIzVwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNmwDAABZVG8yT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVdu
aHNZa2RSTVd4Q2MyRXdjMWxIWjFWMFZVWk1hMGxSVEVwclJHdGpURXRDUVRJelFscFFWeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1qcDdhVG93TzNNNk1UQTZJbDl2
YkdSZmFXNXdkWFFpTzJrNk1UdHpPalk2SW1WeWNtOXljeUk3ZlhNNk16b2libVYzSWp0aE9qQTZl
MzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRI
QTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJ
N2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9pYVc1MFpXNWtaV1Fp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzMxek9qRXdPaUpmYjJ4a1gybHVjSFYwSWp0aE9qRTZlM002TlRvaVpXMWhhV3dpTzNNNk1q
RTZJbk41WVdacGNYZHNaRzR3UUdkdFlXbHNMbU52YlNJN2ZYTTZOam9pWlhKeWIzSnpJanRQT2pN
eE9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNWbWxsZDBWeWNtOXlRbUZuSWpveE9udHpPamM2
SWdBcUFHSmhaM01pTzJFNk1UcDdjem8zT2lKa1pXWmhkV3gwSWp0UE9qSTVPaUpKYkd4MWJXbHVZ
WFJsWEZOMWNIQnZjblJjVFdWemMyRm5aVUpoWnlJNk1qcDdjem94TVRvaUFDb0FiV1Z6YzJGblpY
TWlPMkU2TVRwN2N6bzFPaUpsYldGcGJDSTdZVG94T250cE9qQTdjem8wTXpvaVZHaGxjMlVnWTNK
bFpHVnVkR2xoYkhNZ1pHOGdibTkwSUcxaGRHTm9JRzkxY2lCeVpXTnZjbVJ6TGlJN2ZYMXpPams2
SWdBcUFHWnZjbTFoZENJN2N6bzRPaUk2YldWemMyRm5aU0k3ZlgxOWZRPT331LBqrDAmVw==
'/*!*/;
# at 223813
#260921 13:55:51 server id 1  end_log_pos 223844 CRC32 0xcffeffb1 	Xid = 22955
COMMIT/*!*/;
# at 223844
#260921 13:55:51 server id 1  end_log_pos 223923 CRC32 0x22ae9689 	Anonymous_GTID	last_committed=386	sequence_number=387	rbr_only=yes	original_committed_timestamp=1789973751830452	immediate_commit_timestamp=1789973751830452	transaction_length=1922
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973751830452 (2026-09-21 13:55:51.830452 SE Asia Standard Time)
# immediate_commit_timestamp=1789973751830452 (2026-09-21 13:55:51.830452 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973751830452*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 223923
#260921 13:55:51 server id 1  end_log_pos 224013 CRC32 0x8ec11365 	Query	thread_id=283	exec_time=0	error_code=0
SET TIMESTAMP=1789973751/*!*/;
BEGIN
/*!*/;
# at 224013
#260921 13:55:51 server id 1  end_log_pos 224087 CRC32 0x432c21b4 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 224087
#260921 13:55:51 server id 1  end_log_pos 225735 CRC32 0xd194ffa9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
99SwahMBAAAASgAAAFdrAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LQhLEM=
99Swah8BAAAAcAYAAMdxAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2bAMAAFlUbzJPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TWpwN2FUb3dPM002
TVRBNklsOXZiR1JmYVc1d2RYUWlPMms2TVR0ek9qWTZJbVZ5Y205eWN5STdmWE02TXpvaWJtVjNJ
anRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16
TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lK
eWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakU2ZTNNNk9Eb2lhVzUw
Wlc1a1pXUWlPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZ
WE5vWW05aGNtUWlPMzF6T2pFd09pSmZiMnhrWDJsdWNIVjBJanRoT2pFNmUzTTZOVG9pWlcxaGFX
d2lPM002TWpFNkluTjVZV1pwY1hkc1pHNHdRR2R0WVdsc0xtTnZiU0k3ZlhNNk5qb2laWEp5YjNK
eklqdFBPak14T2lKSmJHeDFiV2x1WVhSbFhGTjFjSEJ2Y25SY1ZtbGxkMFZ5Y205eVFtRm5Jam94
T250ek9qYzZJZ0FxQUdKaFozTWlPMkU2TVRwN2N6bzNPaUprWldaaGRXeDBJanRQT2pJNU9pSkpi
R3gxYldsdVlYUmxYRk4xY0hCdmNuUmNUV1Z6YzJGblpVSmhaeUk2TWpwN2N6b3hNVG9pQUNvQWJX
VnpjMkZuWlhNaU8yRTZNVHA3Y3pvMU9pSmxiV0ZwYkNJN1lUb3hPbnRwT2pBN2N6bzBNem9pVkdo
bGMyVWdZM0psWkdWdWRHbGhiSE1nWkc4Z2JtOTBJRzFoZEdOb0lHOTFjaUJ5WldOdmNtUnpMaUk3
Zlgxek9qazZJZ0FxQUdadmNtMWhkQ0k3Y3pvNE9pSTZiV1Z6YzJGblpTSTdmWDE5ZlE9PffUsGoC
KAA4bGk0RE5UV3lUM2N3cm5xQldRaVRUcXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96
aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2
IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlU
bzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVa
TWEwbFJURXByUkd0alRFdENRVEl6UWxwUVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96
T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZk
WE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9E
QXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhN
Nk16b2lkWEpzSWp0aE9qRTZlM002T0RvaWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zMTn31LBqqf+U0Q==
'/*!*/;
# at 225735
#260921 13:55:51 server id 1  end_log_pos 225766 CRC32 0x0e901dc6 	Xid = 23012
COMMIT/*!*/;
# at 225766
#260921 13:57:41 server id 1  end_log_pos 225845 CRC32 0xfbf167ca 	Anonymous_GTID	last_committed=387	sequence_number=388	rbr_only=yes	original_committed_timestamp=1789973861877583	immediate_commit_timestamp=1789973861877583	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789973861877583 (2026-09-21 13:57:41.877583 SE Asia Standard Time)
# immediate_commit_timestamp=1789973861877583 (2026-09-21 13:57:41.877583 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789973861877583*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 225845
#260921 13:57:41 server id 1  end_log_pos 225935 CRC32 0xd7f8a91d 	Query	thread_id=284	exec_time=0	error_code=0
SET TIMESTAMP=1789973861/*!*/;
BEGIN
/*!*/;
# at 225935
#260921 13:57:41 server id 1  end_log_pos 226009 CRC32 0x5e94c4ba 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 226009
#260921 13:57:41 server id 1  end_log_pos 227153 CRC32 0xf1217bdc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ZdWwahMBAAAASgAAANlyAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LrElF4=
ZdWwah8BAAAAeAQAAFF3AwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6
bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0Rv
aWFXNTBaVzVrWldRaU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFw
Ymk5a1lYTm9ZbTloY21RaU8zMTn31LBqAigAOGxpNEROVFd5VDNjd3JucUJXUWlUVHF6ajhKcmNp
MUprWWxYaXIzVwkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVdu
aHNZa2RSTVd4Q2MyRXdjMWxIWjFWMFZVWk1hMGxSVEVwclJHdGpURXRDUVRJelFscFFWeUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5Y3pvek9pSjFjbXdpTzJFNk1UcDdjem80T2lKcGJuUmxibVJsWkNJN2N6b3pOem9pYUhS
MGNEb3ZMekV5Tnk0d0xqQXVNVG80TURBd0wyRmtiV2x1TDJSaGMyaGliMkZ5WkNJN2ZYMD1l1bBq
3Hsh8Q==
'/*!*/;
# at 227153
#260921 13:57:41 server id 1  end_log_pos 227184 CRC32 0x98fd24f4 	Xid = 23069
COMMIT/*!*/;
# at 227184
#260921 14:13:41 server id 1  end_log_pos 227263 CRC32 0x5661e105 	Anonymous_GTID	last_committed=388	sequence_number=389	rbr_only=yes	original_committed_timestamp=1789974821697375	immediate_commit_timestamp=1789974821697375	transaction_length=1402
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789974821697375 (2026-09-21 14:13:41.697375 SE Asia Standard Time)
# immediate_commit_timestamp=1789974821697375 (2026-09-21 14:13:41.697375 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789974821697375*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 227263
#260921 14:13:41 server id 1  end_log_pos 227353 CRC32 0xdde55c73 	Query	thread_id=285	exec_time=0	error_code=0
SET TIMESTAMP=1789974821/*!*/;
BEGIN
/*!*/;
# at 227353
#260921 14:13:41 server id 1  end_log_pos 227427 CRC32 0xa52b7e44 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 227427
#260921 14:13:41 server id 1  end_log_pos 228555 CRC32 0x1e91726a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
JdmwahMBAAAASgAAAGN4AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4ER+K6U=
Jdmwah8BAAAAaAQAAMt8AwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2dAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDljem96T2lKMWNtd2lPMkU2TVRwN2N6bzRPaUpwYm5SbGJtUmxaQ0k3Y3pv
ek56b2lhSFIwY0Rvdkx6RXlOeTR3TGpBdU1UbzRNREF3TDJGa2JXbHVMMlJoYzJoaWIyRnlaQ0k3
ZlgwPWXVsGoCKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRUcXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2dAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pV25oc1lrZFJNV3hDYzJFd2Mx
bEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxwUVZ5STdjem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpm
Y0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VN
QzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem96T2lKMWNt
d2lPMkU2TVRwN2N6bzRPaUpwYm5SbGJtUmxaQ0k3Y3pvek56b2lhSFIwY0Rvdkx6RXlOeTR3TGpB
dU1UbzRNREF3TDJGa2JXbHVMMlJoYzJoaWIyRnlaQ0k3ZlgwPSXZsGpqcpEe
'/*!*/;
# at 228555
#260921 14:13:41 server id 1  end_log_pos 228586 CRC32 0xe12b5c8e 	Xid = 23126
COMMIT/*!*/;
# at 228586
#260921 14:13:44 server id 1  end_log_pos 228665 CRC32 0x646adf52 	Anonymous_GTID	last_committed=389	sequence_number=390	rbr_only=yes	original_committed_timestamp=1789974824387627	immediate_commit_timestamp=1789974824387627	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789974824387627 (2026-09-21 14:13:44.387627 SE Asia Standard Time)
# immediate_commit_timestamp=1789974824387627 (2026-09-21 14:13:44.387627 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789974824387627*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 228665
#260921 14:13:44 server id 1  end_log_pos 228755 CRC32 0xc9d9f8e9 	Query	thread_id=286	exec_time=0	error_code=0
SET TIMESTAMP=1789974824/*!*/;
BEGIN
/*!*/;
# at 228755
#260921 14:13:44 server id 1  end_log_pos 228829 CRC32 0x08792062 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 228829
#260921 14:13:44 server id 1  end_log_pos 229973 CRC32 0x25700edd 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
KNmwahMBAAAASgAAAN19AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GIgeQg=
KNmwah8BAAAAeAQAAFWCAwAAAFMAAAAAAAEAAgAG//8CKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRU
cXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2dAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV25oc1lrZFJNV3hDYzJFd2MxbEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxw
UVZ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDljem96T2lKMWNtd2lPMkU2TVRwN2N6bzRPaUpwYm5SbGJtUmxaQ0k3Y3pv
ek56b2lhSFIwY0Rvdkx6RXlOeTR3TGpBdU1UbzRNREF3TDJGa2JXbHVMMlJoYzJoaWIyRnlaQ0k3
ZlgwPSXZsGoCKAA4bGk0RE5UV3lUM2N3cm5xQldRaVRUcXpqOEpyY2kxSmtZbFhpcjNXCTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pV25oc1lrZFJNV3hDYzJFd2Mx
bEhaMVYwVlVaTWEwbFJURXByUkd0alRFdENRVEl6UWxwUVZ5STdjem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpm
Y0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VN
QzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2Iy
ZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qRTZlM002T0RvaWFXNTBaVzVrWldRaU8zTTZNemM2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zMTko2bBq
3Q5wJQ==
'/*!*/;
# at 229973
#260921 14:13:44 server id 1  end_log_pos 230004 CRC32 0xfb14441a 	Xid = 23183
COMMIT/*!*/;
# at 230004
#260921 14:14:09 server id 1  end_log_pos 230083 CRC32 0xe17e60d7 	Anonymous_GTID	last_committed=390	sequence_number=391	rbr_only=yes	original_committed_timestamp=1789974849158624	immediate_commit_timestamp=1789974849158624	transaction_length=862
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789974849158624 (2026-09-21 14:14:09.158624 SE Asia Standard Time)
# immediate_commit_timestamp=1789974849158624 (2026-09-21 14:14:09.158624 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789974849158624*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 230083
#260921 14:14:09 server id 1  end_log_pos 230164 CRC32 0xe6ef82f2 	Query	thread_id=287	exec_time=0	error_code=0
SET TIMESTAMP=1789974849/*!*/;
BEGIN
/*!*/;
# at 230164
#260921 14:14:09 server id 1  end_log_pos 230238 CRC32 0x415e5010 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 230238
#260921 14:14:09 server id 1  end_log_pos 230835 CRC32 0xf524f128 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
QdmwahMBAAAASgAAAF6DAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BBQXkE=
QdmwaiABAAAAVQIAALOFAwAAAFMAAAAAAAEAAgAG/wIoADhsaTRETlRXeVQzY3dybnFCV1FpVFRx
emo4SnJjaTFKa1lsWGlyM1cJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lXbmhzWWtkUk1XeENjMkV3YzFsSFoxVjBWVVpNYTBsUlRFcHJSR3RqVEV0Q1FUSXpRbHBR
VnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8z
TTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pv
MU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pFNmUzTTZPRG9p
YVc1MFpXNWtaV1FpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBi
aTlrWVhOb1ltOWhjbVFpTzMxOSjZsGoo8ST1
'/*!*/;
# at 230835
#260921 14:14:09 server id 1  end_log_pos 230866 CRC32 0x7a07916b 	Xid = 23195
COMMIT/*!*/;
# at 230866
#260921 14:14:09 server id 1  end_log_pos 230945 CRC32 0x33e8e2b8 	Anonymous_GTID	last_committed=391	sequence_number=392	rbr_only=yes	original_committed_timestamp=1789974849234866	immediate_commit_timestamp=1789974849234866	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789974849234866 (2026-09-21 14:14:09.234866 SE Asia Standard Time)
# immediate_commit_timestamp=1789974849234866 (2026-09-21 14:14:09.234866 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789974849234866*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 230945
#260921 14:14:09 server id 1  end_log_pos 231026 CRC32 0x483e902f 	Query	thread_id=287	exec_time=0	error_code=0
SET TIMESTAMP=1789974849/*!*/;
BEGIN
/*!*/;
# at 231026
#260921 14:14:09 server id 1  end_log_pos 231100 CRC32 0xc70164df 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 231100
#260921 14:14:09 server id 1  end_log_pos 231709 CRC32 0x26b31b66 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
QdmwahMBAAAASgAAALyGAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N9kAcc=
Qdmwah4BAAAAYQIAAB2JAwAAAFMAAAAAAAEAAgAG/wAoAHFaSW9RMjExTWgxTVdrOUR4SHRtNm1I
Y0NySzZleVFINkZNY3UzYVALAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaU5sWnBkekpGYm1aWVRVMTVNRTlFT0ZaNFVqZGlUVXBpU1RoNWFVRXdTVEk1
WlRCdVVIUTRiQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TVR0OUHZsGpmG7Mm
'/*!*/;
# at 231709
#260921 14:14:09 server id 1  end_log_pos 231740 CRC32 0x3085526e 	Xid = 23201
COMMIT/*!*/;
# at 231740
#260921 14:14:10 server id 1  end_log_pos 231819 CRC32 0xaafb1a8a 	Anonymous_GTID	last_committed=392	sequence_number=393	rbr_only=yes	original_committed_timestamp=1789974850009274	immediate_commit_timestamp=1789974850009274	transaction_length=1478
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789974850009274 (2026-09-21 14:14:10.009274 SE Asia Standard Time)
# immediate_commit_timestamp=1789974850009274 (2026-09-21 14:14:10.009274 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789974850009274*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 231819
#260921 14:14:10 server id 1  end_log_pos 231909 CRC32 0xd8b31ef7 	Query	thread_id=288	exec_time=0	error_code=0
SET TIMESTAMP=1789974850/*!*/;
BEGIN
/*!*/;
# at 231909
#260921 14:14:10 server id 1  end_log_pos 231983 CRC32 0x2d06a1e0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 231983
#260921 14:14:10 server id 1  end_log_pos 233187 CRC32 0x8dab4319 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
QtmwahMBAAAASgAAAC+KAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OChBi0=
Qtmwah8BAAAAtAQAAOOOAwAAAFMAAAAAAAEAAgAG//8AKABxWklvUTIxMU1oMU1XazlEeEh0bTZt
SGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJ
NVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1UdDlB2bBqACgAcVpJb1EyMTFNaDFNV2s5RHhI
dG02bUhjQ3JLNmV5UUg2Rk1jdTNhUAsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2nAEAAFlUbzFPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTmxacGR6SkZibVpZVFUxNU1FOUVPRlo0VWpkaVRVcGlTVGg1YVVF
d1NUSTVaVEJ1VUhRNGJDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TXpvaWRYSnNJanRoT2pBNmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0y
WVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1UdDlC
2bBqGUOrjQ==
'/*!*/;
# at 233187
#260921 14:14:10 server id 1  end_log_pos 233218 CRC32 0x8b65b272 	Xid = 23387
COMMIT/*!*/;
# at 233218
#260921 14:18:40 server id 1  end_log_pos 233297 CRC32 0x2d5a2138 	Anonymous_GTID	last_committed=393	sequence_number=394	rbr_only=yes	original_committed_timestamp=1789975120244733	immediate_commit_timestamp=1789975120244733	transaction_length=1478
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975120244733 (2026-09-21 14:18:40.244733 SE Asia Standard Time)
# immediate_commit_timestamp=1789975120244733 (2026-09-21 14:18:40.244733 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975120244733*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 233297
#260921 14:18:40 server id 1  end_log_pos 233387 CRC32 0x4da1fa99 	Query	thread_id=289	exec_time=0	error_code=0
SET TIMESTAMP=1789975120/*!*/;
BEGIN
/*!*/;
# at 233387
#260921 14:18:40 server id 1  end_log_pos 233461 CRC32 0x1ced0168 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 233461
#260921 14:18:40 server id 1  end_log_pos 234665 CRC32 0xc5980711 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
UNqwahMBAAAASgAAAPWPAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GgB7Rw=
UNqwah8BAAAAtAQAAKmUAwAAAFMAAAAAAAEAAgAG//8AKABxWklvUTIxMU1oMU1XazlEeEh0bTZt
SGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJ
NVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TVR0OULZsGoA
KABxWklvUTIxMU1oMU1XazlEeEh0bTZtSGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81Mzcu
MzaIAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5
RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJNVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJk
cGJpSTdmWE02TXpvaWRYSnNJanRoT2pBNmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0y
WVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1UdDlQ
2rBqEQeYxQ==
'/*!*/;
# at 234665
#260921 14:18:40 server id 1  end_log_pos 234696 CRC32 0x94644bd4 	Xid = 23447
COMMIT/*!*/;
# at 234696
#260921 14:19:09 server id 1  end_log_pos 234775 CRC32 0xdf708081 	Anonymous_GTID	last_committed=394	sequence_number=395	rbr_only=yes	original_committed_timestamp=1789975149116008	immediate_commit_timestamp=1789975149116008	transaction_length=1946
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975149116008 (2026-09-21 14:19:09.116008 SE Asia Standard Time)
# immediate_commit_timestamp=1789975149116008 (2026-09-21 14:19:09.116008 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975149116008*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 234775
#260921 14:19:09 server id 1  end_log_pos 234865 CRC32 0x45f64f7c 	Query	thread_id=290	exec_time=0	error_code=0
SET TIMESTAMP=1789975149/*!*/;
BEGIN
/*!*/;
# at 234865
#260921 14:19:09 server id 1  end_log_pos 234939 CRC32 0xe3e7d4b7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 234939
#260921 14:19:09 server id 1  end_log_pos 236611 CRC32 0xe3604f28 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
bdqwahMBAAAASgAAALuVAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LfU5+M=
bdqwah8BAAAAiAYAAEOcAwAAAFMAAAAAAAEAAgAG//8AKABxWklvUTIxMU1oMU1XazlEeEh0bTZt
SGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJ
NVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1UdDlQ2rBqACgAcVpJb1EyMTFNaDFNV2s5RHhI
dG02bUhjQ3JLNmV5UUg2Rk1jdTNhUAsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2cAMAAFlUbzNPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTmxacGR6SkZibVpZVFUxNU1FOUVPRlo0VWpkaVRVcGlTVGg1YVVF
d1NUSTVaVEJ1VUhRNGJDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TWpwN2FUb3dPM002TVRBNklsOXZiR1JmYVc1d2RYUWlPMms2TVR0ek9qWTZJbVZ5Y205eWN5STdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TVR0ek9qRXdPaUpmYjJ4a1gybHVjSFYwSWp0aE9q
RTZlM002TlRvaVpXMWhhV3dpTzNNNk1qRTZJbk41WVdacGNYZHNaRzR3UUdkdFlXbHNMbU52YlNJ
N2ZYTTZOam9pWlhKeWIzSnpJanRQT2pNeE9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNWbWxs
ZDBWeWNtOXlRbUZuSWpveE9udHpPamM2SWdBcUFHSmhaM01pTzJFNk1UcDdjem8zT2lKa1pXWmhk
V3gwSWp0UE9qSTVPaUpKYkd4MWJXbHVZWFJsWEZOMWNIQnZjblJjVFdWemMyRm5aVUpoWnlJNk1q
cDdjem94TVRvaUFDb0FiV1Z6YzJGblpYTWlPMkU2TVRwN2N6bzFPaUpsYldGcGJDSTdZVG94T250
cE9qQTdjem8wTXpvaVZHaGxjMlVnWTNKbFpHVnVkR2xoYkhNZ1pHOGdibTkwSUcxaGRHTm9JRzkx
Y2lCeVpXTnZjbVJ6TGlJN2ZYMXpPams2SWdBcUFHWnZjbTFoZENJN2N6bzRPaUk2YldWemMyRm5a
U0k3ZlgxOWZRPT1t2rBqKE9g4w==
'/*!*/;
# at 236611
#260921 14:19:09 server id 1  end_log_pos 236642 CRC32 0x34f2dd8a 	Xid = 23462
COMMIT/*!*/;
# at 236642
#260921 14:19:09 server id 1  end_log_pos 236721 CRC32 0x93a66c35 	Anonymous_GTID	last_committed=395	sequence_number=396	rbr_only=yes	original_committed_timestamp=1789975149767234	immediate_commit_timestamp=1789975149767234	transaction_length=1946
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975149767234 (2026-09-21 14:19:09.767234 SE Asia Standard Time)
# immediate_commit_timestamp=1789975149767234 (2026-09-21 14:19:09.767234 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975149767234*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236721
#260921 14:19:09 server id 1  end_log_pos 236811 CRC32 0xf032aa74 	Query	thread_id=291	exec_time=0	error_code=0
SET TIMESTAMP=1789975149/*!*/;
BEGIN
/*!*/;
# at 236811
#260921 14:19:09 server id 1  end_log_pos 236885 CRC32 0x452cf8fb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 236885
#260921 14:19:09 server id 1  end_log_pos 238557 CRC32 0xabbb3b39 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
bdqwahMBAAAASgAAAFWdAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Pv4LEU=
bdqwah8BAAAAiAYAAN2jAwAAAFMAAAAAAAEAAgAG//8AKABxWklvUTIxMU1oMU1XazlEeEh0bTZt
SGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZwAwAAWVRvM09udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJ
NVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNanA3
YVRvd08zTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yazZNVHR6T2pZNkltVnljbTl5Y3lJN2ZYTTZN
em9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNt
d2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJ
N2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6
T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNa
alU0WldFMFpUTXdPVGc1WkNJN2FUb3hNVHR6T2pFd09pSmZiMnhrWDJsdWNIVjBJanRoT2pFNmUz
TTZOVG9pWlcxaGFXd2lPM002TWpFNkluTjVZV1pwY1hkc1pHNHdRR2R0WVdsc0xtTnZiU0k3ZlhN
Nk5qb2laWEp5YjNKeklqdFBPak14T2lKSmJHeDFiV2x1WVhSbFhGTjFjSEJ2Y25SY1ZtbGxkMFZ5
Y205eVFtRm5Jam94T250ek9qYzZJZ0FxQUdKaFozTWlPMkU2TVRwN2N6bzNPaUprWldaaGRXeDBJ
anRQT2pJNU9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNUV1Z6YzJGblpVSmhaeUk2TWpwN2N6
b3hNVG9pQUNvQWJXVnpjMkZuWlhNaU8yRTZNVHA3Y3pvMU9pSmxiV0ZwYkNJN1lUb3hPbnRwT2pB
N2N6bzBNem9pVkdobGMyVWdZM0psWkdWdWRHbGhiSE1nWkc4Z2JtOTBJRzFoZEdOb0lHOTFjaUJ5
WldOdmNtUnpMaUk3Zlgxek9qazZJZ0FxQUdadmNtMWhkQ0k3Y3pvNE9pSTZiV1Z6YzJGblpTSTdm
WDE5ZlE9PW3asGoAKABxWklvUTIxMU1oMU1XazlEeEh0bTZtSGNDcks2ZXlRSDZGTWN1M2FQCwAA
AAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0
KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4w
IFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lObFpwZHpK
RmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJNVpUQnVVSFE0YkNJN2N6bzJPaUpm
Wm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZl
MzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRI
QTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJ
N2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pBNmUzMXpPalV3T2lKc2IyZHBibDkz
WldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVa
Q0k3YVRveE1UdDlt2rBqOTu7qw==
'/*!*/;
# at 238557
#260921 14:19:09 server id 1  end_log_pos 238588 CRC32 0x9776af89 	Xid = 23522
COMMIT/*!*/;
# at 238588
#260921 14:19:27 server id 1  end_log_pos 238667 CRC32 0x66bee8f2 	Anonymous_GTID	last_committed=396	sequence_number=397	rbr_only=yes	original_committed_timestamp=1789975167876080	immediate_commit_timestamp=1789975167876080	transaction_length=1946
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975167876080 (2026-09-21 14:19:27.876080 SE Asia Standard Time)
# immediate_commit_timestamp=1789975167876080 (2026-09-21 14:19:27.876080 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975167876080*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 238667
#260921 14:19:27 server id 1  end_log_pos 238757 CRC32 0x13b9f6ac 	Query	thread_id=292	exec_time=0	error_code=0
SET TIMESTAMP=1789975167/*!*/;
BEGIN
/*!*/;
# at 238757
#260921 14:19:27 server id 1  end_log_pos 238831 CRC32 0x739c8046 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 238831
#260921 14:19:27 server id 1  end_log_pos 240503 CRC32 0x86dac929 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
f9qwahMBAAAASgAAAO+kAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EaAnHM=
f9qwah8BAAAAiAYAAHerAwAAAFMAAAAAAAEAAgAG//8AKABxWklvUTIxMU1oMU1XazlEeEh0bTZt
SGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJ
NVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1UdDlt2rBqACgAcVpJb1EyMTFNaDFNV2s5RHhI
dG02bUhjQ3JLNmV5UUg2Rk1jdTNhUAsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2cAMAAFlUbzNPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pTmxacGR6SkZibVpZVFUxNU1FOUVPRlo0VWpkaVRVcGlTVGg1YVVF
d1NUSTVaVEJ1VUhRNGJDSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TWpwN2FUb3dPM002TVRBNklsOXZiR1JmYVc1d2RYUWlPMms2TVR0ek9qWTZJbVZ5Y205eWN5STdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TVR0ek9qRXdPaUpmYjJ4a1gybHVjSFYwSWp0aE9q
RTZlM002TlRvaVpXMWhhV3dpTzNNNk1qRTZJbk41WVdacGNYZHNaRzR3UUdkdFlXbHNMbU52YlNJ
N2ZYTTZOam9pWlhKeWIzSnpJanRQT2pNeE9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNWbWxs
ZDBWeWNtOXlRbUZuSWpveE9udHpPamM2SWdBcUFHSmhaM01pTzJFNk1UcDdjem8zT2lKa1pXWmhk
V3gwSWp0UE9qSTVPaUpKYkd4MWJXbHVZWFJsWEZOMWNIQnZjblJjVFdWemMyRm5aVUpoWnlJNk1q
cDdjem94TVRvaUFDb0FiV1Z6YzJGblpYTWlPMkU2TVRwN2N6bzFPaUpsYldGcGJDSTdZVG94T250
cE9qQTdjem8wTXpvaVZHaGxjMlVnWTNKbFpHVnVkR2xoYkhNZ1pHOGdibTkwSUcxaGRHTm9JRzkx
Y2lCeVpXTnZjbVJ6TGlJN2ZYMXpPams2SWdBcUFHWnZjbTFoZENJN2N6bzRPaUk2YldWemMyRm5a
U0k3ZlgxOWZRPT1/2rBqKcnahg==
'/*!*/;
# at 240503
#260921 14:19:27 server id 1  end_log_pos 240534 CRC32 0xe2c78249 	Xid = 23537
COMMIT/*!*/;
# at 240534
#260921 14:19:28 server id 1  end_log_pos 240613 CRC32 0xa92d819b 	Anonymous_GTID	last_committed=397	sequence_number=398	rbr_only=yes	original_committed_timestamp=1789975168553263	immediate_commit_timestamp=1789975168553263	transaction_length=1946
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975168553263 (2026-09-21 14:19:28.553263 SE Asia Standard Time)
# immediate_commit_timestamp=1789975168553263 (2026-09-21 14:19:28.553263 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975168553263*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 240613
#260921 14:19:28 server id 1  end_log_pos 240703 CRC32 0xe4bfdfbf 	Query	thread_id=293	exec_time=0	error_code=0
SET TIMESTAMP=1789975168/*!*/;
BEGIN
/*!*/;
# at 240703
#260921 14:19:28 server id 1  end_log_pos 240777 CRC32 0x3e7d0bd3 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 240777
#260921 14:19:28 server id 1  end_log_pos 242449 CRC32 0xac2bde25 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
gNqwahMBAAAASgAAAImsAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NMLfT4=
gNqwah8BAAAAiAYAABGzAwAAAFMAAAAAAAEAAgAG//8AKABxWklvUTIxMU1oMU1XazlEeEh0bTZt
SGNDcks2ZXlRSDZGTWN1M2FQCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZwAwAAWVRvM09udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lObFpwZHpKRmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJ
NVpUQnVVSFE0YkNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNanA3
YVRvd08zTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yazZNVHR6T2pZNkltVnljbTl5Y3lJN2ZYTTZN
em9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNt
d2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJ
N2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6
T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNa
alU0WldFMFpUTXdPVGc1WkNJN2FUb3hNVHR6T2pFd09pSmZiMnhrWDJsdWNIVjBJanRoT2pFNmUz
TTZOVG9pWlcxaGFXd2lPM002TWpFNkluTjVZV1pwY1hkc1pHNHdRR2R0WVdsc0xtTnZiU0k3ZlhN
Nk5qb2laWEp5YjNKeklqdFBPak14T2lKSmJHeDFiV2x1WVhSbFhGTjFjSEJ2Y25SY1ZtbGxkMFZ5
Y205eVFtRm5Jam94T250ek9qYzZJZ0FxQUdKaFozTWlPMkU2TVRwN2N6bzNPaUprWldaaGRXeDBJ
anRQT2pJNU9pSkpiR3gxYldsdVlYUmxYRk4xY0hCdmNuUmNUV1Z6YzJGblpVSmhaeUk2TWpwN2N6
b3hNVG9pQUNvQWJXVnpjMkZuWlhNaU8yRTZNVHA3Y3pvMU9pSmxiV0ZwYkNJN1lUb3hPbnRwT2pB
N2N6bzBNem9pVkdobGMyVWdZM0psWkdWdWRHbGhiSE1nWkc4Z2JtOTBJRzFoZEdOb0lHOTFjaUJ5
WldOdmNtUnpMaUk3Zlgxek9qazZJZ0FxQUdadmNtMWhkQ0k3Y3pvNE9pSTZiV1Z6YzJGblpTSTdm
WDE5ZlE9PX/asGoAKABxWklvUTIxMU1oMU1XazlEeEh0bTZtSGNDcks2ZXlRSDZGTWN1M2FQCwAA
AAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0
KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4w
IFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lObFpwZHpK
RmJtWllUVTE1TUU5RU9GWjRVamRpVFVwaVNUaDVhVUV3U1RJNVpUQnVVSFE0YkNJN2N6bzJPaUpm
Wm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZl
MzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRI
QTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJ
N2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pBNmUzMXpPalV3T2lKc2IyZHBibDkz
WldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVa
Q0k3YVRveE1UdDmA2rBqJd4rrA==
'/*!*/;
# at 242449
#260921 14:19:28 server id 1  end_log_pos 242480 CRC32 0xe05ce022 	Xid = 23597
COMMIT/*!*/;
# at 242480
#260921 14:19:50 server id 1  end_log_pos 242559 CRC32 0xab8e3a52 	Anonymous_GTID	last_committed=398	sequence_number=399	rbr_only=yes	original_committed_timestamp=1789975190738183	immediate_commit_timestamp=1789975190738183	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975190738183 (2026-09-21 14:19:50.738183 SE Asia Standard Time)
# immediate_commit_timestamp=1789975190738183 (2026-09-21 14:19:50.738183 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975190738183*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 242559
#260921 14:19:50 server id 1  end_log_pos 242640 CRC32 0x3ea623ba 	Query	thread_id=294	exec_time=0	error_code=0
SET TIMESTAMP=1789975190/*!*/;
BEGIN
/*!*/;
# at 242640
#260921 14:19:50 server id 1  end_log_pos 242714 CRC32 0xd1b5f070 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 242714
#260921 14:19:50 server id 1  end_log_pos 243323 CRC32 0x187095c8 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
ltqwahMBAAAASgAAABq0AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HDwtdE=
ltqwaiABAAAAYQIAAHu2AwAAAFMAAAAAAAEAAgAG/wAoAHFaSW9RMjExTWgxTVdrOUR4SHRtNm1I
Y0NySzZleVFINkZNY3UzYVALAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaU5sWnBkekpGYm1aWVRVMTVNRTlFT0ZaNFVqZGlUVXBpU1RoNWFVRXdTVEk1
WlRCdVVIUTRiQ0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TVR0OYDasGrIlXAY
'/*!*/;
# at 243323
#260921 14:19:50 server id 1  end_log_pos 243354 CRC32 0x7b8fd7d3 	Xid = 23609
COMMIT/*!*/;
# at 243354
#260921 14:19:50 server id 1  end_log_pos 243433 CRC32 0xfad56131 	Anonymous_GTID	last_committed=399	sequence_number=400	rbr_only=yes	original_committed_timestamp=1789975190825898	immediate_commit_timestamp=1789975190825898	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975190825898 (2026-09-21 14:19:50.825898 SE Asia Standard Time)
# immediate_commit_timestamp=1789975190825898 (2026-09-21 14:19:50.825898 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975190825898*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 243433
#260921 14:19:50 server id 1  end_log_pos 243514 CRC32 0x1b552b6c 	Query	thread_id=294	exec_time=0	error_code=0
SET TIMESTAMP=1789975190/*!*/;
BEGIN
/*!*/;
# at 243514
#260921 14:19:50 server id 1  end_log_pos 243588 CRC32 0xd30c90bb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 243588
#260921 14:19:50 server id 1  end_log_pos 244197 CRC32 0x4324a122 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
ltqwahMBAAAASgAAAIS3AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LuQDNM=
ltqwah4BAAAAYQIAAOW5AwAAAFMAAAAAAAEAAgAG/wAoAGZMUktOd2lGU0Q0aURDYlVXQVRnMHFh
OHdyTzltTmV5RWU4VFVmTkIEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVRuVjRTWEpPY1Vnd1RHTjRXVFF5TVZNMFZVdDZPVFpvVTFOSlozVjZWSE5N
YUZKcFZFaHBieUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPZbasGoioSRD
'/*!*/;
# at 244197
#260921 14:19:50 server id 1  end_log_pos 244228 CRC32 0x0900e1a1 	Xid = 23615
COMMIT/*!*/;
# at 244228
#260921 14:19:51 server id 1  end_log_pos 244307 CRC32 0xbd9fccbe 	Anonymous_GTID	last_committed=400	sequence_number=401	rbr_only=yes	original_committed_timestamp=1789975191678825	immediate_commit_timestamp=1789975191678825	transaction_length=1478
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975191678825 (2026-09-21 14:19:51.678825 SE Asia Standard Time)
# immediate_commit_timestamp=1789975191678825 (2026-09-21 14:19:51.678825 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975191678825*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 244307
#260921 14:19:51 server id 1  end_log_pos 244397 CRC32 0xe6be977c 	Query	thread_id=295	exec_time=0	error_code=0
SET TIMESTAMP=1789975191/*!*/;
BEGIN
/*!*/;
# at 244397
#260921 14:19:51 server id 1  end_log_pos 244471 CRC32 0x4a99fa09 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 244471
#260921 14:19:51 server id 1  end_log_pos 245675 CRC32 0x30f6d23e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
l9qwahMBAAAASgAAAPe6AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4An6mUo=
l9qwah8BAAAAtAQAAKu/AwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2W2rBqACgAZkxSS053aUZTRDRpRENiVVdB
VGcwcWE4d3JPOW1OZXlFZThUVWZOQgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2nAEAAFlUbzFPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pVG5WNFNYSk9jVWd3VEdONFdUUXlNVk0wVlV0Nk9UWm9VMU5KWjNW
NlZITk1hRkpwVkVocGJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJG
eVpDSTdmWE02TXpvaWRYSnNJanRoT2pBNmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0y
WVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2X
2rBqPtL2MA==
'/*!*/;
# at 245675
#260921 14:19:51 server id 1  end_log_pos 245706 CRC32 0xcf3b4ad0 	Xid = 23801
COMMIT/*!*/;
# at 245706
#260921 14:19:56 server id 1  end_log_pos 245785 CRC32 0x0ba225bc 	Anonymous_GTID	last_committed=401	sequence_number=402	rbr_only=yes	original_committed_timestamp=1789975196227918	immediate_commit_timestamp=1789975196227918	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975196227918 (2026-09-21 14:19:56.227918 SE Asia Standard Time)
# immediate_commit_timestamp=1789975196227918 (2026-09-21 14:19:56.227918 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975196227918*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 245785
#260921 14:19:56 server id 1  end_log_pos 245875 CRC32 0x8d0509ab 	Query	thread_id=296	exec_time=0	error_code=0
SET TIMESTAMP=1789975196/*!*/;
BEGIN
/*!*/;
# at 245875
#260921 14:19:56 server id 1  end_log_pos 245949 CRC32 0xb6f1d203 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 245949
#260921 14:19:56 server id 1  end_log_pos 247173 CRC32 0x55cb4ad5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
nNqwahMBAAAASgAAAL3AAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4APS8bY=
nNqwah8BAAAAyAQAAIXFAwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPZfasGoA
KABmTFJLTndpRlNENGlEQ2JVV0FUZzBxYTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RR
eU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhOTWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPZzasGrVSstV
'/*!*/;
# at 247173
#260921 14:19:56 server id 1  end_log_pos 247204 CRC32 0x4f50d3a9 	Xid = 24170
COMMIT/*!*/;
# at 247204
#260921 14:19:57 server id 1  end_log_pos 247283 CRC32 0x490bdbdf 	Anonymous_GTID	last_committed=402	sequence_number=403	rbr_only=yes	original_committed_timestamp=1789975197563290	immediate_commit_timestamp=1789975197563290	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975197563290 (2026-09-21 14:19:57.563290 SE Asia Standard Time)
# immediate_commit_timestamp=1789975197563290 (2026-09-21 14:19:57.563290 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975197563290*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 247283
#260921 14:19:57 server id 1  end_log_pos 247373 CRC32 0xc2f01c0b 	Query	thread_id=297	exec_time=0	error_code=0
SET TIMESTAMP=1789975197/*!*/;
BEGIN
/*!*/;
# at 247373
#260921 14:19:57 server id 1  end_log_pos 247447 CRC32 0xf552f570 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 247447
#260921 14:19:57 server id 1  end_log_pos 248667 CRC32 0x6c48bef8 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ndqwahMBAAAASgAAAJfGAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HD1UvU=
ndqwah8BAAAAxAQAAFvLAwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPZzasGoA
KABmTFJLTndpRlNENGlEQ2JVV0FUZzBxYTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81Mzcu
MzaYAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RR
eU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhOTWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5MWMyVnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdS
dGFXNHVkWE5sY25NdWFXNWtaWGdpTzMxek9qTTZJblZ5YkNJN1lUb3dPbnQ5Y3pvMU1Eb2liRzlu
YVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpN
RGs0T1dRaU8yazZORHQ5ndqwavi+SGw=
'/*!*/;
# at 248667
#260921 14:19:57 server id 1  end_log_pos 248698 CRC32 0x3ec222d1 	Xid = 24293
COMMIT/*!*/;
# at 248698
#260921 14:21:23 server id 1  end_log_pos 248777 CRC32 0xd1d1c244 	Anonymous_GTID	last_committed=403	sequence_number=404	rbr_only=yes	original_committed_timestamp=1789975283482870	immediate_commit_timestamp=1789975283482870	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975283482870 (2026-09-21 14:21:23.482870 SE Asia Standard Time)
# immediate_commit_timestamp=1789975283482870 (2026-09-21 14:21:23.482870 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975283482870*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 248777
#260921 14:21:23 server id 1  end_log_pos 248867 CRC32 0x8db11448 	Query	thread_id=298	exec_time=0	error_code=0
SET TIMESTAMP=1789975283/*!*/;
BEGIN
/*!*/;
# at 248867
#260921 14:21:23 server id 1  end_log_pos 248941 CRC32 0x331aba13 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 248941
#260921 14:21:23 server id 1  end_log_pos 250125 CRC32 0xd7122ad0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
89qwahMBAAAASgAAAG3MAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BO6GjM=
89qwah8BAAAAoAQAAA3RAwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5MWMy
VnljeUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hOem9pWVdSdGFXNHVkWE5sY25NdWFXNWtaWGdpTzMx
ek9qTTZJblZ5YkNJN1lUb3dPbnQ5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5ndqwagAoAGZM
UktOd2lGU0Q0aURDYlVXQVRnMHFhOHdyTzltTmV5RWU4VFVmTkIEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNngB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVRuVjRTWEpPY1Vnd1RHTjRXVFF5TVZN
MFZVdDZPVFpvVTFOSlozVjZWSE5NYUZKcFZFaHBieUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJanQ5Y3pvek9pSjFjbXdpTzJF
Nk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT0989qwatAqEtc=
'/*!*/;
# at 250125
#260921 14:21:23 server id 1  end_log_pos 250156 CRC32 0x5759568d 	Xid = 24353
COMMIT/*!*/;
# at 250156
#260921 14:21:27 server id 1  end_log_pos 250235 CRC32 0x6613b3c4 	Anonymous_GTID	last_committed=404	sequence_number=405	rbr_only=yes	original_committed_timestamp=1789975287573059	immediate_commit_timestamp=1789975287573059	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975287573059 (2026-09-21 14:21:27.573059 SE Asia Standard Time)
# immediate_commit_timestamp=1789975287573059 (2026-09-21 14:21:27.573059 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975287573059*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 250235
#260921 14:21:27 server id 1  end_log_pos 250325 CRC32 0x49e817e6 	Query	thread_id=299	exec_time=0	error_code=0
SET TIMESTAMP=1789975287/*!*/;
BEGIN
/*!*/;
# at 250325
#260921 14:21:27 server id 1  end_log_pos 250399 CRC32 0x7135d20b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 250399
#260921 14:21:27 server id 1  end_log_pos 251567 CRC32 0x617c261f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
99qwahMBAAAASgAAAB/SAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AvSNXE=
99qwah8BAAAAkAQAAK/WAwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ4AQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6b3pPaUoxY213aU8yRTZNRHA3ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PfPasGoAKABmTFJLTndpRlNENGlEQ2JVV0FUZzBxYTh3ck85bU5leUVl
OFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBX
aW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUv
MTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1E
b2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhOTWFGSnBWRWhwYnlJ
N2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYz
SWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pBNmUzMXpPalV3T2lK
c2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0Uw
WlRNd09UZzVaQ0k3YVRvME8zMD332rBqHyZ8YQ==
'/*!*/;
# at 251567
#260921 14:21:27 server id 1  end_log_pos 251598 CRC32 0x5e541b29 	Xid = 24413
COMMIT/*!*/;
# at 251598
#260921 14:24:09 server id 1  end_log_pos 251677 CRC32 0x240d2f35 	Anonymous_GTID	last_committed=405	sequence_number=406	rbr_only=yes	original_committed_timestamp=1789975449726358	immediate_commit_timestamp=1789975449726358	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975449726358 (2026-09-21 14:24:09.726358 SE Asia Standard Time)
# immediate_commit_timestamp=1789975449726358 (2026-09-21 14:24:09.726358 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975449726358*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 251677
#260921 14:24:09 server id 1  end_log_pos 251767 CRC32 0x36fd6b92 	Query	thread_id=300	exec_time=0	error_code=0
SET TIMESTAMP=1789975449/*!*/;
BEGIN
/*!*/;
# at 251767
#260921 14:24:09 server id 1  end_log_pos 251841 CRC32 0x1f280d1b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 251841
#260921 14:24:09 server id 1  end_log_pos 253025 CRC32 0x765b7019 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
mduwahMBAAAASgAAAMHXAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BsNKB8=
mduwah8BAAAAoAQAAGHcAwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD332rBqACgAZkxSS053aUZTRDRpRENiVVdB
VGcwcWE4d3JPOW1OZXlFZThUVWZOQgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzFPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pVG5WNFNYSk9jVWd3VEdONFdUUXlNVk0wVlV0Nk9UWm9VMU5KWjNW
NlZITk1hRkpwVkVocGJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0
aE9qQTZlMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3
WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9mduwahlwW3Y=
'/*!*/;
# at 253025
#260921 14:24:09 server id 1  end_log_pos 253056 CRC32 0x968169b2 	Xid = 24782
COMMIT/*!*/;
# at 253056
#260921 14:24:15 server id 1  end_log_pos 253135 CRC32 0x94d4486d 	Anonymous_GTID	last_committed=406	sequence_number=407	rbr_only=yes	original_committed_timestamp=1789975455824262	immediate_commit_timestamp=1789975455824262	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975455824262 (2026-09-21 14:24:15.824262 SE Asia Standard Time)
# immediate_commit_timestamp=1789975455824262 (2026-09-21 14:24:15.824262 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975455824262*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 253135
#260921 14:24:15 server id 1  end_log_pos 253225 CRC32 0x7cae1be5 	Query	thread_id=301	exec_time=0	error_code=0
SET TIMESTAMP=1789975455/*!*/;
BEGIN
/*!*/;
# at 253225
#260921 14:24:15 server id 1  end_log_pos 253299 CRC32 0xe4cced36 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 253299
#260921 14:24:15 server id 1  end_log_pos 254483 CRC32 0x352b6684 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
n9uwahMBAAAASgAAAHPdAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DbtzOQ=
n9uwah8BAAAAoAQAABPiAwAAAFMAAAAAAAEAAgAG//8AKABmTFJLTndpRlNENGlEQ2JVV0FUZzBx
YTh3ck85bU5leUVlOFRVZk5CBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUblY0U1hKT2NVZ3dUR040V1RReU1WTTBWVXQ2T1Rab1UxTkpaM1Y2VkhO
TWFGSnBWRWhwYnlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TXpvaWRYSnNJanRoT2pB
NmUzMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRvME8zMD2Z27BqACgAZkxSS053aUZTRDRpRENiVVdB
VGcwcWE4d3JPOW1OZXlFZThUVWZOQgQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzFPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pVG5WNFNYSk9jVWd3VEdONFdUUXlNVk0wVlV0Nk9UWm9VMU5KWjNW
NlZITk1hRkpwVkVocGJ5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJp
OXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk16b2lkWEpzSWp0
aE9qQTZlMzF6T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3
WmpBeE5HTTNaalU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9n9uwaoRmKzU=
'/*!*/;
# at 254483
#260921 14:24:15 server id 1  end_log_pos 254514 CRC32 0xa9e53302 	Xid = 24908
COMMIT/*!*/;
# at 254514
#260921 14:25:11 server id 1  end_log_pos 254593 CRC32 0x3c32c57d 	Anonymous_GTID	last_committed=407	sequence_number=408	rbr_only=yes	original_committed_timestamp=1789975511958814	immediate_commit_timestamp=1789975511958814	transaction_length=714
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975511958814 (2026-09-21 14:25:11.958814 SE Asia Standard Time)
# immediate_commit_timestamp=1789975511958814 (2026-09-21 14:25:11.958814 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975511958814*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 254593
#260921 14:25:11 server id 1  end_log_pos 254685 CRC32 0x248473d9 	Query	thread_id=302	exec_time=0	error_code=0
SET TIMESTAMP=1789975511/*!*/;
BEGIN
/*!*/;
# at 254685
#260921 14:25:11 server id 1  end_log_pos 254773 CRC32 0x9f3813bc 	Table_map: `pln_up_imy`.`users` mapped to number 91
# at 254773
#260921 14:25:11 server id 1  end_log_pos 255197 CRC32 0xb0c8e194 	Update_rows: table id 91 flags: STMT_END_F

BINLOG '
19uwahMBAAAAWAAAADXjAwAAAFsAAAAAAAMACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHgvBM4nw==
19uwah8BAAAAqAEAAN3kAwAAAFsAAAAAAAEAAgAM/////8AABAAAAAAAAAAFAEFkbWluDwBhZG1p
bkBnbWFpbC5jb20NAEFkbWluaXN0cmF0b3Jqpu8iPAAkMnkkMTIkT2N3UVlua0NzVEpvQVZ5SENH
VUFITzgvTm9kaWNDZGJObk1NU1Z1Z1JvMEhUdVlWaC9JRGk8AFppdDVjTlRkSGh0Mzd6UUhhenhk
VnhndWRxY0J5bHdoUXphWHVHWkZaWjNza212ckttWWZqM3R1WW8wYWqm7yJqqJFFAQAAAAAAAADA
AAQAAAAAAAAABQBBZG1pbg8AYWRtaW5AZ21haWwuY29tDQBBZG1pbmlzdHJhdG9yaqbvIjwAJDJ5
JDEyJE9jd1FZbmtDc1RKb0FWeUhDR1VBSE84L05vZGljQ2RiTm5NTVNWdWdSbzBIVHVZVmgvSURp
PABVME5uNVo2Q3pka2dBQVE0U1dlZlNXY0puSHMyRFBWdThteVN1bm5HM1ZWVW01NjVGMUhaaXpU
NEpFQWxqpu8iaqiRRQEAAAAAAAAAlOHIsA==
'/*!*/;
# at 255197
#260921 14:25:11 server id 1  end_log_pos 255228 CRC32 0x9881e302 	Xid = 24920
COMMIT/*!*/;
# at 255228
#260921 14:25:11 server id 1  end_log_pos 255307 CRC32 0xde977788 	Anonymous_GTID	last_committed=408	sequence_number=409	rbr_only=yes	original_committed_timestamp=1789975511966639	immediate_commit_timestamp=1789975511966639	transaction_length=874
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975511966639 (2026-09-21 14:25:11.966639 SE Asia Standard Time)
# immediate_commit_timestamp=1789975511966639 (2026-09-21 14:25:11.966639 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975511966639*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 255307
#260921 14:25:11 server id 1  end_log_pos 255388 CRC32 0x7d51b536 	Query	thread_id=302	exec_time=0	error_code=0
SET TIMESTAMP=1789975511/*!*/;
BEGIN
/*!*/;
# at 255388
#260921 14:25:11 server id 1  end_log_pos 255462 CRC32 0x55481967 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 255462
#260921 14:25:11 server id 1  end_log_pos 256071 CRC32 0x1918ea63 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
19uwahMBAAAASgAAAOblAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GcZSFU=
19uwaiABAAAAYQIAAEfoAwAAAFMAAAAAAAEAAgAG/wAoAGZMUktOd2lGU0Q0aURDYlVXQVRnMHFh
OHdyTzltTmV5RWU4VFVmTkIEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVRuVjRTWEpPY1Vnd1RHTjRXVFF5TVZNMFZVdDZPVFpvVTFOSlozVjZWSE5N
YUZKcFZFaHBieUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPZ/bsGpj6hgZ
'/*!*/;
# at 256071
#260921 14:25:11 server id 1  end_log_pos 256102 CRC32 0xbb42540f 	Xid = 24923
COMMIT/*!*/;
# at 256102
#260921 14:25:11 server id 1  end_log_pos 256181 CRC32 0x3b413dd9 	Anonymous_GTID	last_committed=409	sequence_number=410	rbr_only=yes	original_committed_timestamp=1789975511986993	immediate_commit_timestamp=1789975511986993	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975511986993 (2026-09-21 14:25:11.986993 SE Asia Standard Time)
# immediate_commit_timestamp=1789975511986993 (2026-09-21 14:25:11.986993 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975511986993*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 256181
#260921 14:25:11 server id 1  end_log_pos 256262 CRC32 0xdd472112 	Query	thread_id=302	exec_time=0	error_code=0
SET TIMESTAMP=1789975511/*!*/;
BEGIN
/*!*/;
# at 256262
#260921 14:25:11 server id 1  end_log_pos 256336 CRC32 0x8d5c4f13 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 256336
#260921 14:25:11 server id 1  end_log_pos 256705 CRC32 0x8a791c3d 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
19uwahMBAAAASgAAAFDpAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BNPXI0=
19uwah4BAAAAcQEAAMHqAwAAAFMAAAAAAAEAAgAG/wIoAHhnbHl5TzZ0SXBTQ0RTS0l0YmFBZXBq
MVVPSU1iNXZ5M1BtUk1kY0QJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lVRGhXWWxVemRVUkRhWEpTZVc1NFdWQjJWWGxRZVVsbVkyMWlOVTAyWkRaTFVXOWFiRkZX
UmlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PdfbsGo9HHmK
'/*!*/;
# at 256705
#260921 14:25:11 server id 1  end_log_pos 256736 CRC32 0xb4a20aa5 	Xid = 24929
COMMIT/*!*/;
# at 256736
#260921 14:25:12 server id 1  end_log_pos 256815 CRC32 0x30d6e75f 	Anonymous_GTID	last_committed=410	sequence_number=411	rbr_only=yes	original_committed_timestamp=1789975512591463	immediate_commit_timestamp=1789975512591463	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975512591463 (2026-09-21 14:25:12.591463 SE Asia Standard Time)
# immediate_commit_timestamp=1789975512591463 (2026-09-21 14:25:12.591463 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975512591463*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 256815
#260921 14:25:12 server id 1  end_log_pos 256905 CRC32 0xbc77f041 	Query	thread_id=303	exec_time=0	error_code=0
SET TIMESTAMP=1789975512/*!*/;
BEGIN
/*!*/;
# at 256905
#260921 14:25:12 server id 1  end_log_pos 256979 CRC32 0x8f1a7211 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 256979
#260921 14:25:12 server id 1  end_log_pos 257795 CRC32 0x4fae33ed 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
2NuwahMBAAAASgAAANPrAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BFyGo8=
2Nuwah8BAAAAMAMAAAPvAwAAAFMAAAAAAAEAAgAG//8CKAB4Z2x5eU82dElwU0NEU0tJdGJhQWVw
ajFVT0lNYjV2eTNQbVJNZGNECTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVURoV1lsVXpkVVJEYVhKU2VXNTRXVkIyVlhsUWVVbG1ZMjFpTlUwMlpEWkxVVzlhYkZG
V1JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT3X27BqAigAeGdseXlPNnRJcFNDRFNLSXRiYUFlcGoxVU9JTWI1
dnkzUG1STWRjRAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVVE
aFdZbFV6ZFVSRGFYSlNlVzU0V1ZCMlZYbFFlVWxtWTIxaU5VMDJaRFpMVVc5YWJGRldSaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PdjbsGrtM65P
'/*!*/;
# at 257795
#260921 14:25:12 server id 1  end_log_pos 257826 CRC32 0x387ffd18 	Xid = 24986
COMMIT/*!*/;
# at 257826
#260921 14:25:17 server id 1  end_log_pos 257905 CRC32 0x521a4c1c 	Anonymous_GTID	last_committed=411	sequence_number=412	rbr_only=yes	original_committed_timestamp=1789975517281730	immediate_commit_timestamp=1789975517281730	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975517281730 (2026-09-21 14:25:17.281730 SE Asia Standard Time)
# immediate_commit_timestamp=1789975517281730 (2026-09-21 14:25:17.281730 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975517281730*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 257905
#260921 14:25:17 server id 1  end_log_pos 257995 CRC32 0xf778c1ea 	Query	thread_id=304	exec_time=0	error_code=0
SET TIMESTAMP=1789975517/*!*/;
BEGIN
/*!*/;
# at 257995
#260921 14:25:17 server id 1  end_log_pos 258069 CRC32 0x8c2f5db1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 258069
#260921 14:25:17 server id 1  end_log_pos 258997 CRC32 0x5bed0a84 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3duwahMBAAAASgAAABXwAwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LFdL4w=
3duwah8BAAAAoAMAALXzAwAAAFMAAAAAAAEAAgAG//8CKAB4Z2x5eU82dElwU0NEU0tJdGJhQWVw
ajFVT0lNYjV2eTNQbVJNZGNECTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVURoV1lsVXpkVVJEYVhKU2VXNTRXVkIyVlhsUWVVbG1ZMjFpTlUwMlpEWkxVVzlhYkZG
V1JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT092NuwagIoAHhnbHl5TzZ0SXBTQ0RTS0l0YmFBZXBqMVVPSU1iNXZ5
M1BtUk1kY0QJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lVRGhX
WWxVemRVUkRhWEpTZVc1NFdWQjJWWGxRZVVsbVkyMWlOVTAyWkRaTFVXOWFiRkZXUmlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFs
SWp0OWZRPT3d27BqhArtWw==
'/*!*/;
# at 258997
#260921 14:25:17 server id 1  end_log_pos 259028 CRC32 0x1253cd7a 	Xid = 24995
COMMIT/*!*/;
# at 259028
#260921 14:25:20 server id 1  end_log_pos 259107 CRC32 0x2b27c337 	Anonymous_GTID	last_committed=412	sequence_number=413	rbr_only=yes	original_committed_timestamp=1789975520808407	immediate_commit_timestamp=1789975520808407	transaction_length=1202
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975520808407 (2026-09-21 14:25:20.808407 SE Asia Standard Time)
# immediate_commit_timestamp=1789975520808407 (2026-09-21 14:25:20.808407 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975520808407*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 259107
#260921 14:25:20 server id 1  end_log_pos 259197 CRC32 0xf9585113 	Query	thread_id=305	exec_time=0	error_code=0
SET TIMESTAMP=1789975520/*!*/;
BEGIN
/*!*/;
# at 259197
#260921 14:25:20 server id 1  end_log_pos 259271 CRC32 0xc580b56f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 259271
#260921 14:25:20 server id 1  end_log_pos 260199 CRC32 0x859a6d52 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4NuwahMBAAAASgAAAMf0AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4G+1gMU=
4Nuwah8BAAAAoAMAAGf4AwAAAFMAAAAAAAEAAgAG//8CKAB4Z2x5eU82dElwU0NEU0tJdGJhQWVw
ajFVT0lNYjV2eTNQbVJNZGNECTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVURoV1lsVXpkVVJEYVhKU2VXNTRXVkIyVlhsUWVVbG1ZMjFpTlUwMlpEWkxVVzlhYkZG
V1JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT093duwagIoAHhnbHl5TzZ0SXBTQ0RTS0l0YmFBZXBqMVVPSU1iNXZ5
M1BtUk1kY0QJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lVRGhX
WWxVemRVUkRhWEpTZVc1NFdWQjJWWGxRZVVsbVkyMWlOVTAyWkRaTFVXOWFiRkZXUmlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFs
SWp0OWZRPT3g27BqUm2ahQ==
'/*!*/;
# at 260199
#260921 14:25:20 server id 1  end_log_pos 260230 CRC32 0xc50d3434 	Xid = 25004
COMMIT/*!*/;
# at 260230
#260921 14:28:07 server id 1  end_log_pos 260309 CRC32 0xccd7aa85 	Anonymous_GTID	last_committed=413	sequence_number=414	rbr_only=yes	original_committed_timestamp=1789975687626314	immediate_commit_timestamp=1789975687626314	transaction_length=1266
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789975687626314 (2026-09-21 14:28:07.626314 SE Asia Standard Time)
# immediate_commit_timestamp=1789975687626314 (2026-09-21 14:28:07.626314 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789975687626314*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 260309
#260921 14:28:07 server id 1  end_log_pos 260399 CRC32 0xd24dd430 	Query	thread_id=306	exec_time=0	error_code=0
SET TIMESTAMP=1789975687/*!*/;
BEGIN
/*!*/;
# at 260399
#260921 14:28:07 server id 1  end_log_pos 260473 CRC32 0x14c4c0bb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 260473
#260921 14:28:07 server id 1  end_log_pos 261465 CRC32 0x876db7f0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
h9ywahMBAAAASgAAAHn5AwAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LvAxBQ=
h9ywah8BAAAA4AMAAFn9AwAAAFMAAAAAAAEAAgAG//8CKAB4Z2x5eU82dElwU0NEU0tJdGJhQWVw
ajFVT0lNYjV2eTNQbVJNZGNECTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pVURoV1lsVXpkVVJEYVhKU2VXNTRXVkIyVlhsUWVVbG1ZMjFpTlUwMlpEWkxVVzlhYkZG
V1JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT094NuwagIoAHhnbHl5TzZ0SXBTQ0RTS0l0YmFBZXBqMVVPSU1iNXZ5
M1BtUk1kY0QJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzZQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lVRGhX
WWxVemRVUkRhWEpTZVc1NFdWQjJWWGxRZVVsbVkyMWlOVTAyWkRaTFVXOWFiRkZXUmlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZOVFE2SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxXdGhiV2t2YzNSeWRXdDBkWEl0
YjNKbllXNXBjMkZ6YVNJN2N6bzFPaUp5YjNWMFpTSTdjem94T1RvaWMzUnlkV3QwZFhJdGIzSm5Z
VzVwYzJGemFTSTdmWDA9h9ywavC3bYc=
'/*!*/;
# at 261465
#260921 14:28:07 server id 1  end_log_pos 261496 CRC32 0x582b97d9 	Xid = 25061
COMMIT/*!*/;
# at 261496
#260921 14:42:18 server id 1  end_log_pos 261519 CRC32 0xe50768ad 	Stop
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
