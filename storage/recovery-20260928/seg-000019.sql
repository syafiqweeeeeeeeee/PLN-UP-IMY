# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#260918 10:06:35 server id 1  end_log_pos 126 CRC32 0xe65850db 	Start: binlog v 4, server v 8.0.30 created 260918 10:06:35 at startup
ROLLBACK/*!*/;
BINLOG '
u6qsag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAC7qqxqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAAdtQWOY=
'/*!*/;
# at 126
#260918 10:06:35 server id 1  end_log_pos 157 CRC32 0x9cf04b97 	Previous-GTIDs
# [empty]
# at 157
#260918 10:09:47 server id 1  end_log_pos 236 CRC32 0x9c058dc3 	Anonymous_GTID	last_committed=0	sequence_number=1	rbr_only=yes	original_committed_timestamp=1789700987601703	immediate_commit_timestamp=1789700987601703	transaction_length=746
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789700987601703 (2026-09-18 10:09:47.601703 SE Asia Standard Time)
# immediate_commit_timestamp=1789700987601703 (2026-09-18 10:09:47.601703 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789700987601703*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236
#260918 10:09:47 server id 1  end_log_pos 317 CRC32 0x97fd846a 	Query	thread_id=8	exec_time=0	error_code=0
SET TIMESTAMP=1789700987/*!*/;
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
#260918 10:09:47 server id 1  end_log_pos 391 CRC32 0x7c4fb029 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 391
#260918 10:09:47 server id 1  end_log_pos 872 CRC32 0x24458108 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
e6usahMBAAAASgAAAIcBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CmwT3w=
e6usah4BAAAA4QEAAGgDAAAAAFMAAAAAAAEAAgAG/wIoAGhUaVBpajltUWhiS1pWWVg3aDJKcUw5
c3hVaVl1UktrMUdpNEMwZU4JMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2laVFEyVDNoa1QyeGFTRTVHVW0wNFltUXpTVWxOU3psSU1IZFFTakpYTlU1bGMyOUNXR3BQ
VWlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElq
dDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWZRPT17q6xqCIFFJA==
'/*!*/;
# at 872
#260918 10:09:47 server id 1  end_log_pos 903 CRC32 0x05e76984 	Xid = 59
COMMIT/*!*/;
# at 903
#260918 10:09:55 server id 1  end_log_pos 982 CRC32 0xf4115111 	Anonymous_GTID	last_committed=1	sequence_number=2	rbr_only=yes	original_committed_timestamp=1789700995111023	immediate_commit_timestamp=1789700995111023	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789700995111023 (2026-09-18 10:09:55.111023 SE Asia Standard Time)
# immediate_commit_timestamp=1789700995111023 (2026-09-18 10:09:55.111023 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789700995111023*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 982
#260918 10:09:55 server id 1  end_log_pos 1072 CRC32 0x68e23ec9 	Query	thread_id=9	exec_time=0	error_code=0
SET TIMESTAMP=1789700995/*!*/;
BEGIN
/*!*/;
# at 1072
#260918 10:09:55 server id 1  end_log_pos 1146 CRC32 0xbd839999 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 1146
#260918 10:09:55 server id 1  end_log_pos 2090 CRC32 0x84414ff1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
g6usahMBAAAASgAAAHoEAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JmZg70=
g6usah8BAAAAsAMAACoIAAAAAFMAAAAAAAEAAgAG//8CKABoVGlQaWo5bVFoYktaVllYN2gySnFM
OXN4VWlZdVJLazFHaTRDMGVOCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pWlRRMlQzaGtUMnhhU0U1R1VtMDRZbVF6U1VsTlN6bElNSGRRU2pKWE5VNWxjMjlDV0dw
UFVpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT09e6usagIoAGhUaVBpajltUWhiS1pWWVg3aDJKcUw5c3hVaVl1Uktr
MUdpNEMwZU4JMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2laVFEy
VDNoa1QyeGFTRTVHVW0wNFltUXpTVWxOU3psSU1IZFFTakpYTlU1bGMyOUNXR3BQVWlJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lK
c2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6
T2pNNkltNWxkeUk3WVRvd09udDlmWDA9g6usavFPQYQ=
'/*!*/;
# at 2090
#260918 10:09:55 server id 1  end_log_pos 2121 CRC32 0x07489bfe 	Xid = 116
COMMIT/*!*/;
# at 2121
#260918 10:10:32 server id 1  end_log_pos 2200 CRC32 0x9d4484d6 	Anonymous_GTID	last_committed=2	sequence_number=3	rbr_only=yes	original_committed_timestamp=1789701032569314	immediate_commit_timestamp=1789701032569314	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701032569314 (2026-09-18 10:10:32.569314 SE Asia Standard Time)
# immediate_commit_timestamp=1789701032569314 (2026-09-18 10:10:32.569314 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701032569314*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2200
#260918 10:10:32 server id 1  end_log_pos 2281 CRC32 0xf132d314 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789701032/*!*/;
BEGIN
/*!*/;
# at 2281
#260918 10:10:32 server id 1  end_log_pos 2355 CRC32 0xc1073122 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 2355
#260918 10:10:32 server id 1  end_log_pos 2852 CRC32 0x220ec7bf 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
qKusahMBAAAASgAAADMJAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CIxB8E=
qKusaiABAAAA8QEAACQLAAAAAFMAAAAAAAEAAgAG/wIoAGhUaVBpajltUWhiS1pWWVg3aDJKcUw5
c3hVaVl1UktrMUdpNEMwZU4JMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2laVFEyVDNoa1QyeGFTRTVHVW0wNFltUXpTVWxOU3psSU1IZFFTakpYTlU1bGMyOUNXR3BQ
VWlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9g6usar/HDiI=
'/*!*/;
# at 2852
#260918 10:10:32 server id 1  end_log_pos 2883 CRC32 0xde6b9af8 	Xid = 128
COMMIT/*!*/;
# at 2883
#260918 10:10:32 server id 1  end_log_pos 2962 CRC32 0xed91beeb 	Anonymous_GTID	last_committed=3	sequence_number=4	rbr_only=yes	original_committed_timestamp=1789701032733043	immediate_commit_timestamp=1789701032733043	transaction_length=589
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701032733043 (2026-09-18 10:10:32.733043 SE Asia Standard Time)
# immediate_commit_timestamp=1789701032733043 (2026-09-18 10:10:32.733043 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701032733043*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2962
#260918 10:10:32 server id 1  end_log_pos 3051 CRC32 0x1708d40b 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789701032/*!*/;
SET @@session.time_zone='SYSTEM'/*!*/;
BEGIN
/*!*/;
# at 3051
#260918 10:10:32 server id 1  end_log_pos 3149 CRC32 0xe1c646e6 	Table_map: `pln_up_imy`.`activity_logs` mapped to number 92
# at 3149
#260918 10:10:32 server id 1  end_log_pos 3441 CRC32 0x986a44c4 	Write_rows: table id 92 flags: STMT_END_F

BINLOG '
qKusahMBAAAAYgAAAE0MAAAAAFwAAAAAAAEACnBsbl91cF9pbXkADWFjdGl2aXR5X2xvZ3MADQgI
Dw8PD/wPCA8PERER/AP8A/wD/AMC/AO0ANAHAACOHwEB4AIB4OZGxuE=
qKusah4BAAAAJAEAAHENAAAAAFwAAAAAAAEAAgAN//8AAE0AAAAAAAAACgAAAAAAAAANAHN5YWZp
cSB3aWxkYW4NAEFkbWluaXN0cmF0b3ILAGF1dGVudGlrYXNpBQBsb2dpbh4AbWVsYWt1a2FuIGxv
Z2luIGtlIHBhbmVsIGFkbWluDwBBcHBcTW9kZWxzXFVzZXIKAAAAAAAAAAkxMjcuMC4wLjFvAE1v
emlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4z
NiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNmqsSThq
rEk4xERqmA==
'/*!*/;
# at 3441
#260918 10:10:32 server id 1  end_log_pos 3472 CRC32 0x28184362 	Xid = 131
COMMIT/*!*/;
# at 3472
#260918 10:10:32 server id 1  end_log_pos 3551 CRC32 0xf2b06e5b 	Anonymous_GTID	last_committed=4	sequence_number=5	rbr_only=yes	original_committed_timestamp=1789701032885725	immediate_commit_timestamp=1789701032885725	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701032885725 (2026-09-18 10:10:32.885725 SE Asia Standard Time)
# immediate_commit_timestamp=1789701032885725 (2026-09-18 10:10:32.885725 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701032885725*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3551
#260918 10:10:32 server id 1  end_log_pos 3632 CRC32 0x464864e2 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789701032/*!*/;
BEGIN
/*!*/;
# at 3632
#260918 10:10:32 server id 1  end_log_pos 3706 CRC32 0xd0118d06 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 3706
#260918 10:10:32 server id 1  end_log_pos 4295 CRC32 0x41cb18b6 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
qKusahMBAAAASgAAAHoOAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AaNEdA=
qKusah4BAAAATQIAAMcQAAAAAFMAAAAAAAEAAgAG/wAoADQ3NURySmltNUJaaVZWTVRKUDZQTlJz
T0VGblVjSXBoWkZOUE1JTzYKAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVpXeFZVbEUwWkdGUFNsQm1SbGhVY21kd1dubGtaR3BPWWt4RlEyNVJXVkZI
Y2xoNE1qRmlPQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pFd08zMD2oq6xqthjLQQ==
'/*!*/;
# at 4295
#260918 10:10:32 server id 1  end_log_pos 4326 CRC32 0x585e61fd 	Xid = 137
COMMIT/*!*/;
# at 4326
#260918 10:10:35 server id 1  end_log_pos 4405 CRC32 0xc8afa2b4 	Anonymous_GTID	last_committed=5	sequence_number=6	rbr_only=yes	original_committed_timestamp=1789701035956058	immediate_commit_timestamp=1789701035956058	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701035956058 (2026-09-18 10:10:35.956058 SE Asia Standard Time)
# immediate_commit_timestamp=1789701035956058 (2026-09-18 10:10:35.956058 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701035956058*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4405
#260918 10:10:35 server id 1  end_log_pos 4495 CRC32 0xac37b7d3 	Query	thread_id=11	exec_time=0	error_code=0
SET TIMESTAMP=1789701035/*!*/;
BEGIN
/*!*/;
# at 4495
#260918 10:10:35 server id 1  end_log_pos 4569 CRC32 0xeced2772 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 4569
#260918 10:10:35 server id 1  end_log_pos 5733 CRC32 0x622177d6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
q6usahMBAAAASgAAANkRAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HIn7ew=
q6usah8BAAAAjAQAAGUWAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qRXdPMzA9qKusagAoADQ3NURySmltNUJaaVZWTVRKUDZQTlJzT0VGblVjSXBoWkZOUE1J
TzYKAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVpX
eFZVbEUwWkdGUFNsQm1SbGhVY21kd1dubGtaR3BPWWt4RlEyNVJXVkZIY2xoNE1qRmlPQ0k3Y3pv
NU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlP
M002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUz
TTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPakV3TzMwPaurrGrWdyFi
'/*!*/;
# at 5733
#260918 10:10:35 server id 1  end_log_pos 5764 CRC32 0x236d8648 	Xid = 326
COMMIT/*!*/;
# at 5764
#260918 10:10:44 server id 1  end_log_pos 5843 CRC32 0xb9982d8c 	Anonymous_GTID	last_committed=6	sequence_number=7	rbr_only=yes	original_committed_timestamp=1789701044164703	immediate_commit_timestamp=1789701044164703	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701044164703 (2026-09-18 10:10:44.164703 SE Asia Standard Time)
# immediate_commit_timestamp=1789701044164703 (2026-09-18 10:10:44.164703 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701044164703*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5843
#260918 10:10:44 server id 1  end_log_pos 5933 CRC32 0x113a0508 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1789701044/*!*/;
BEGIN
/*!*/;
# at 5933
#260918 10:10:44 server id 1  end_log_pos 6007 CRC32 0x1224888d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 6007
#260918 10:10:44 server id 1  end_log_pos 7187 CRC32 0xa9944c40 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
tKusahMBAAAASgAAAHcXAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4I2IJBI=
tKusah8BAAAAnAQAABMcAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFd08zMD2rq6xqACgANDc1RHJKaW01QlppVlZNVEpQ
NlBOUnNPRUZuVWNJcGhaRk5QTUlPNgoAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2hAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pWld4VlVsRTBaR0ZQU2xCbVJsaFVjbWR3V25sa1pHcE9Za3hGUTI1
UldWRkhjbGg0TWpGaU9DSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTkxYzJWeWN5STdj
em8xT2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0dWRYTmxjbk11YVc1a1pYZ2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1EdDm0q6xqQEyUqQ==
'/*!*/;
# at 7187
#260918 10:10:44 server id 1  end_log_pos 7218 CRC32 0xde88b714 	Xid = 449
COMMIT/*!*/;
# at 7218
#260918 10:10:46 server id 1  end_log_pos 7297 CRC32 0x25cdea45 	Anonymous_GTID	last_committed=7	sequence_number=8	rbr_only=yes	original_committed_timestamp=1789701046142147	immediate_commit_timestamp=1789701046142147	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701046142147 (2026-09-18 10:10:46.142147 SE Asia Standard Time)
# immediate_commit_timestamp=1789701046142147 (2026-09-18 10:10:46.142147 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701046142147*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 7297
#260918 10:10:46 server id 1  end_log_pos 7387 CRC32 0x8efb5c6c 	Query	thread_id=13	exec_time=0	error_code=0
SET TIMESTAMP=1789701046/*!*/;
BEGIN
/*!*/;
# at 7387
#260918 10:10:46 server id 1  end_log_pos 7461 CRC32 0x8be243c1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 7461
#260918 10:10:46 server id 1  end_log_pos 8637 CRC32 0xa3d0d4aa 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
tqusahMBAAAASgAAACUdAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4MFD4os=
tqusah8BAAAAmAQAAL0hAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ObSrrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ObarrGqq1NCj
'/*!*/;
# at 8637
#260918 10:10:46 server id 1  end_log_pos 8668 CRC32 0x618b3b0c 	Xid = 818
COMMIT/*!*/;
# at 8668
#260918 10:10:50 server id 1  end_log_pos 8747 CRC32 0x1aa1c394 	Anonymous_GTID	last_committed=8	sequence_number=9	rbr_only=yes	original_committed_timestamp=1789701050253449	immediate_commit_timestamp=1789701050253449	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701050253449 (2026-09-18 10:10:50.253449 SE Asia Standard Time)
# immediate_commit_timestamp=1789701050253449 (2026-09-18 10:10:50.253449 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701050253449*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 8747
#260918 10:10:50 server id 1  end_log_pos 8837 CRC32 0xcb266729 	Query	thread_id=14	exec_time=0	error_code=0
SET TIMESTAMP=1789701050/*!*/;
BEGIN
/*!*/;
# at 8837
#260918 10:10:50 server id 1  end_log_pos 8911 CRC32 0x01423e1d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 8911
#260918 10:10:50 server id 1  end_log_pos 10087 CRC32 0x136d257c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
uqusahMBAAAASgAAAM8iAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4B0+QgE=
uqusah8BAAAAmAQAAGcnAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ObarrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ObqrrGp8JW0T
'/*!*/;
# at 10087
#260918 10:10:50 server id 1  end_log_pos 10118 CRC32 0xf0f1f28d 	Xid = 935
COMMIT/*!*/;
# at 10118
#260918 10:11:06 server id 1  end_log_pos 10197 CRC32 0x03364a91 	Anonymous_GTID	last_committed=9	sequence_number=10	rbr_only=yes	original_committed_timestamp=1789701066980478	immediate_commit_timestamp=1789701066980478	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701066980478 (2026-09-18 10:11:06.980478 SE Asia Standard Time)
# immediate_commit_timestamp=1789701066980478 (2026-09-18 10:11:06.980478 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701066980478*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 10197
#260918 10:11:06 server id 1  end_log_pos 10287 CRC32 0xaa138a8a 	Query	thread_id=15	exec_time=0	error_code=0
SET TIMESTAMP=1789701066/*!*/;
BEGIN
/*!*/;
# at 10287
#260918 10:11:06 server id 1  end_log_pos 10361 CRC32 0xc045e65c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 10361
#260918 10:11:06 server id 1  end_log_pos 11537 CRC32 0xbcf3cfa1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
yqusahMBAAAASgAAAHkoAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FzmRcA=
yqusah8BAAAAmAQAABEtAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ObqrrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OcqrrGqhz/O8
'/*!*/;
# at 11537
#260918 10:11:06 server id 1  end_log_pos 11568 CRC32 0x848b9791 	Xid = 1058
COMMIT/*!*/;
# at 11568
#260918 10:11:12 server id 1  end_log_pos 11647 CRC32 0xc1f21d93 	Anonymous_GTID	last_committed=10	sequence_number=11	rbr_only=yes	original_committed_timestamp=1789701072433367	immediate_commit_timestamp=1789701072433367	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701072433367 (2026-09-18 10:11:12.433367 SE Asia Standard Time)
# immediate_commit_timestamp=1789701072433367 (2026-09-18 10:11:12.433367 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701072433367*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 11647
#260918 10:11:12 server id 1  end_log_pos 11737 CRC32 0x95e238d0 	Query	thread_id=16	exec_time=0	error_code=0
SET TIMESTAMP=1789701072/*!*/;
BEGIN
/*!*/;
# at 11737
#260918 10:11:12 server id 1  end_log_pos 11811 CRC32 0x36bf3338 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 11811
#260918 10:11:12 server id 1  end_log_pos 12987 CRC32 0xb3f697e8 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
0KusahMBAAAASgAAACMuAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DgzvzY=
0Kusah8BAAAAmAQAALsyAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OcqrrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OdCrrGrol/az
'/*!*/;
# at 12987
#260918 10:11:12 server id 1  end_log_pos 13018 CRC32 0x845dd178 	Xid = 1181
COMMIT/*!*/;
# at 13018
#260918 10:11:57 server id 1  end_log_pos 13097 CRC32 0x77d8be63 	Anonymous_GTID	last_committed=11	sequence_number=12	rbr_only=yes	original_committed_timestamp=1789701117456834	immediate_commit_timestamp=1789701117456834	transaction_length=410
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701117456834 (2026-09-18 10:11:57.456834 SE Asia Standard Time)
# immediate_commit_timestamp=1789701117456834 (2026-09-18 10:11:57.456834 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701117456834*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13097
#260918 10:11:57 server id 1  end_log_pos 13178 CRC32 0x8c97807b 	Query	thread_id=17	exec_time=0	error_code=0
SET TIMESTAMP=1789701117/*!*/;
BEGIN
/*!*/;
# at 13178
#260918 10:11:57 server id 1  end_log_pos 13243 CRC32 0xe9395d8b 	Table_map: `pln_up_imy`.`cache` mapped to number 101
# at 13243
#260918 10:11:57 server id 1  end_log_pos 13397 CRC32 0xe10fa9ec 	Update_rows: table id 101 flags: STMT_END_F

BINLOG '
/ausahMBAAAAQQAAALszAAAAAGUAAAAAAAEACnBsbl91cF9pbXkABWNhY2hlAAMP/AMD/AMDAAEB
AAIB4ItdOek=
/ausah8BAAAAmgAAAFU0AAAAAGUAAAAAAAEAAgAD//8AJABsYXJhdmVsLWNhY2hlLW90cF9wYXNz
d29yZF9jaGFuZ2VfMTANAABzOjY6IjY5MjQyOCI7MqWragAkAGxhcmF2ZWwtY2FjaGUtb3RwX3Bh
c3N3b3JkX2NoYW5nZV8xMA0AAHM6NjoiNTQzNTMzIjspraxq7KkP4Q==
'/*!*/;
# at 13397
#260918 10:11:57 server id 1  end_log_pos 13428 CRC32 0xfa0145d8 	Xid = 1205
COMMIT/*!*/;
# at 13428
#260918 10:12:18 server id 1  end_log_pos 13507 CRC32 0xf8cf5b85 	Anonymous_GTID	last_committed=12	sequence_number=13	rbr_only=yes	original_committed_timestamp=1789701138173704	immediate_commit_timestamp=1789701138173704	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701138173704 (2026-09-18 10:12:18.173704 SE Asia Standard Time)
# immediate_commit_timestamp=1789701138173704 (2026-09-18 10:12:18.173704 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701138173704*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13507
#260918 10:12:18 server id 1  end_log_pos 13597 CRC32 0xdd396276 	Query	thread_id=17	exec_time=0	error_code=0
SET TIMESTAMP=1789701138/*!*/;
BEGIN
/*!*/;
# at 13597
#260918 10:12:18 server id 1  end_log_pos 13671 CRC32 0xaba4835d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 13671
#260918 10:12:18 server id 1  end_log_pos 14847 CRC32 0x652af591 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
EqysahMBAAAASgAAAGc1AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4F2DpKs=
Eqysah8BAAAAmAQAAP85AAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OdCrrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ORKsrGqR9Spl
'/*!*/;
# at 14847
#260918 10:12:18 server id 1  end_log_pos 14878 CRC32 0x8de04ff5 	Xid = 1208
COMMIT/*!*/;
# at 14878
#260918 10:12:48 server id 1  end_log_pos 14957 CRC32 0xeeb4a6e6 	Anonymous_GTID	last_committed=13	sequence_number=14	rbr_only=yes	original_committed_timestamp=1789701168675720	immediate_commit_timestamp=1789701168675720	transaction_length=1394
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701168675720 (2026-09-18 10:12:48.675720 SE Asia Standard Time)
# immediate_commit_timestamp=1789701168675720 (2026-09-18 10:12:48.675720 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701168675720*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 14957
#260918 10:12:48 server id 1  end_log_pos 15038 CRC32 0xdb0ed1d2 	Query	thread_id=18	exec_time=0	error_code=0
SET TIMESTAMP=1789701168/*!*/;
BEGIN
/*!*/;
# at 15038
#260918 10:12:48 server id 1  end_log_pos 15112 CRC32 0xfe1d4335 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 15112
#260918 10:12:48 server id 1  end_log_pos 16241 CRC32 0xc029df90 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
MKysahMBAAAASgAAAAg7AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DVDHf4=
MKysaiABAAAAaQQAAHE/AAAAAFMAAAAAAAEAAgAG/wIoADZ6UW0wNTJyR2Eybjd2VmNyZ2NBY2Zj
T0RrekNsOURodlpwenhXTlkPMTEyLjIxNS4xNzEuMjMxhwBNb3ppbGxhLzUuMCAoaVBob25lOyBD
UFUgaVBob25lIE9TIDE4XzcgbGlrZSBNYWMgT1MgWCkgQXBwbGVXZWJLaXQvNjA1LjEuMTUgKEtI
VE1MLCBsaWtlIEdlY2tvKSBWZXJzaW9uLzI2LjUgTW9iaWxlLzE1RTE0OCBTYWZhcmkvNjA0LjE0
AQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2liRkJEVkVOQ1RIRmtlWFI0VWpKVVpI
bFJRa2RRY3psclIzcFFXa3BFVm1WSlRXSXlUbkV3U0NJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpw
N2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZORGc2SW1oMGRIQnpPaTh2WTJ4dmMyRmli
R1V0WVd4cFpXNWhkR1V0WTI5dVkyVmhiQzV1WjNKdmF5MW1jbVZsTG1SbGRpSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWZRPT2YkatqACgAUkRaZWkzSnR1Wks0aGk3YkVCaVBPWG1x
WXlSa1ZhbG9teThtQWxEYgoAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3Mg
TlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNr
bykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2kAEAAFlUbzBPbnR6T2pZNklsOTBiMnRs
YmlJN2N6bzBNRG9pYURBd1ZIZE1iMHBOUVdWT1pHTnhNM2RhZVdjME5GRkpiVFJqZGpSc05ERkpS
WEJxV2taTk9DSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lK
MWNtd2lPM002TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5
Y3k4eE1DOWxaR2wwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakUyT2lKaFpHMXBiaTUxYzJWeWN5NWxa
R2wwSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1H
WXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRBN2ZRPT0GpKtqkN8pwA==
'/*!*/;
# at 16241
#260918 10:12:48 server id 1  end_log_pos 16272 CRC32 0x0ac9ac17 	Xid = 1217
COMMIT/*!*/;
# at 16272
#260918 10:12:48 server id 1  end_log_pos 16351 CRC32 0xd61a1588 	Anonymous_GTID	last_committed=14	sequence_number=15	rbr_only=yes	original_committed_timestamp=1789701168839937	immediate_commit_timestamp=1789701168839937	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701168839937 (2026-09-18 10:12:48.839937 SE Asia Standard Time)
# immediate_commit_timestamp=1789701168839937 (2026-09-18 10:12:48.839937 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701168839937*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 16351
#260918 10:12:48 server id 1  end_log_pos 16441 CRC32 0x6240e154 	Query	thread_id=18	exec_time=0	error_code=0
SET TIMESTAMP=1789701168/*!*/;
BEGIN
/*!*/;
# at 16441
#260918 10:12:48 server id 1  end_log_pos 16515 CRC32 0x3531a724 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 16515
#260918 10:12:48 server id 1  end_log_pos 17691 CRC32 0x08b2d36f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
MKysahMBAAAASgAAAINAAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CSnMTU=
MKysah8BAAAAmAQAABtFAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0ORKsrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OTCsrGpv07II
'/*!*/;
# at 17691
#260918 10:12:48 server id 1  end_log_pos 17722 CRC32 0x603cc326 	Xid = 1238
COMMIT/*!*/;
# at 17722
#260918 10:13:00 server id 1  end_log_pos 17801 CRC32 0xa0ba92d8 	Anonymous_GTID	last_committed=15	sequence_number=16	rbr_only=yes	original_committed_timestamp=1789701180614862	immediate_commit_timestamp=1789701180614862	transaction_length=350
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701180614862 (2026-09-18 10:13:00.614862 SE Asia Standard Time)
# immediate_commit_timestamp=1789701180614862 (2026-09-18 10:13:00.614862 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701180614862*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 17801
#260918 10:13:00 server id 1  end_log_pos 17882 CRC32 0x8bd9b506 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1789701180/*!*/;
BEGIN
/*!*/;
# at 17882
#260918 10:13:00 server id 1  end_log_pos 17947 CRC32 0x5eb52d63 	Table_map: `pln_up_imy`.`cache` mapped to number 101
# at 17947
#260918 10:13:00 server id 1  end_log_pos 18041 CRC32 0x16f0728c 	Delete_rows: table id 101 flags: STMT_END_F

BINLOG '
PKysahMBAAAAQQAAABtGAAAAAGUAAAAAAAEACnBsbl91cF9pbXkABWNhY2hlAAMP/AMD/AMDAAEB
AAIB4GMttV4=
PKysaiABAAAAXgAAAHlGAAAAAGUAAAAAAAEAAgAD/wAkAGxhcmF2ZWwtY2FjaGUtb3RwX3Bhc3N3
b3JkX2NoYW5nZV8xMA0AAHM6NjoiNTQzNTMzIjspraxqjHLwFg==
'/*!*/;
# at 18041
#260918 10:13:00 server id 1  end_log_pos 18072 CRC32 0x7f9536a9 	Xid = 1274
COMMIT/*!*/;
# at 18072
#260918 10:13:00 server id 1  end_log_pos 18151 CRC32 0xd2b083e5 	Anonymous_GTID	last_committed=16	sequence_number=17	rbr_only=yes	original_committed_timestamp=1789701180653412	immediate_commit_timestamp=1789701180653412	transaction_length=732
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701180653412 (2026-09-18 10:13:00.653412 SE Asia Standard Time)
# immediate_commit_timestamp=1789701180653412 (2026-09-18 10:13:00.653412 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701180653412*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 18151
#260918 10:13:00 server id 1  end_log_pos 18251 CRC32 0xe946bd35 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1789701180/*!*/;
BEGIN
/*!*/;
# at 18251
#260918 10:13:00 server id 1  end_log_pos 18339 CRC32 0x30d15977 	Table_map: `pln_up_imy`.`users` mapped to number 91
# at 18339
#260918 10:13:00 server id 1  end_log_pos 18773 CRC32 0xd309eefb 	Update_rows: table id 91 flags: STMT_END_F

BINLOG '
PKysahMBAAAAWAAAAKNHAAAAAFsAAAAAAAMACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHgd1nRMA==
PKysah8BAAAAsgEAAFVJAAAAAFsAAAAAAAEAAgAM/////xABCgAAAAAAAAANAHN5YWZpcSB3aWxk
YW4VAHN5YWZpcXdsZG4wQGdtYWlsLmNvbQ0AQWRtaW5pc3RyYXRvcjwAJDJ5JDEyJFFqWDlhRE9y
OEt6VWxxS0lvbHF6TGU1cjdYZkVSV2kyNlNRMDhrMll4ZklKcGhkVW9vVUN1DDA4Nzc0MDk0Mzg4
MCoARGVzYSBTbGVtYW4gQmxvayBLZXNhbWJpDQpLZWNhbWF0YW4gU2xpeWVnaqs7a2qrO2sBAAAA
AAAAABABCgAAAAAAAAANAHN5YWZpcSB3aWxkYW4VAHN5YWZpcXdsZG4wQGdtYWlsLmNvbQ0AQWRt
aW5pc3RyYXRvcjwAJDJ5JDEyJFM1WTdyeHBzWGdISkpFVEdIZUhlUHV6a2c4ZU9XYWtDakc4SS56
eEFFdnV4LmJpRjk0ZjNTDDA4Nzc0MDk0Mzg4MCoARGVzYSBTbGVtYW4gQmxvayBLZXNhbWJpDQpL
ZWNhbWF0YW4gU2xpeWVnaqs7a2qsScwBAAAAAAAAAPvuCdM=
'/*!*/;
# at 18773
#260918 10:13:00 server id 1  end_log_pos 18804 CRC32 0x777b1b63 	Xid = 1277
COMMIT/*!*/;
# at 18804
#260918 10:13:00 server id 1  end_log_pos 18883 CRC32 0x58ba19ad 	Anonymous_GTID	last_committed=17	sequence_number=18	rbr_only=yes	original_committed_timestamp=1789701180688263	immediate_commit_timestamp=1789701180688263	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701180688263 (2026-09-18 10:13:00.688263 SE Asia Standard Time)
# immediate_commit_timestamp=1789701180688263 (2026-09-18 10:13:00.688263 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701180688263*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 18883
#260918 10:13:00 server id 1  end_log_pos 18973 CRC32 0x8005fb57 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1789701180/*!*/;
BEGIN
/*!*/;
# at 18973
#260918 10:13:00 server id 1  end_log_pos 19047 CRC32 0x4498b558 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 19047
#260918 10:13:00 server id 1  end_log_pos 20223 CRC32 0x6d47c6ab 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
PKysahMBAAAASgAAAGdKAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Fi1mEQ=
PKysah8BAAAAmAQAAP9OAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OTCsrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OTysrGqrxkdt
'/*!*/;
# at 20223
#260918 10:13:00 server id 1  end_log_pos 20254 CRC32 0xc5e29cc0 	Xid = 1283
COMMIT/*!*/;
# at 20254
#260918 10:13:03 server id 1  end_log_pos 20333 CRC32 0x5c20b58f 	Anonymous_GTID	last_committed=18	sequence_number=19	rbr_only=yes	original_committed_timestamp=1789701183394987	immediate_commit_timestamp=1789701183394987	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701183394987 (2026-09-18 10:13:03.394987 SE Asia Standard Time)
# immediate_commit_timestamp=1789701183394987 (2026-09-18 10:13:03.394987 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701183394987*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 20333
#260918 10:13:03 server id 1  end_log_pos 20423 CRC32 0x7ccec30a 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1789701183/*!*/;
BEGIN
/*!*/;
# at 20423
#260918 10:13:03 server id 1  end_log_pos 20497 CRC32 0x470b74dc 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 20497
#260918 10:13:03 server id 1  end_log_pos 21677 CRC32 0xf902759a 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
P6ysahMBAAAASgAAABFQAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Nx0C0c=
P6ysah8BAAAAnAQAAK1UAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFP
aUp5YjNWMFpTSTdjem94TnpvaVlXUnRhVzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OTysrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3k4eE1DSTdj
em8xT2lKeWIzVjBaU0k3Y3pveE5qb2lZV1J0YVc0dWRYTmxjbk11YzJodmR5STdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFd08zMD0/rKxqmnUC+Q==
'/*!*/;
# at 21677
#260918 10:13:03 server id 1  end_log_pos 21708 CRC32 0x0054d9a6 	Xid = 1394
COMMIT/*!*/;
# at 21708
#260918 10:13:27 server id 1  end_log_pos 21787 CRC32 0x185be3d8 	Anonymous_GTID	last_committed=19	sequence_number=20	rbr_only=yes	original_committed_timestamp=1789701207476557	immediate_commit_timestamp=1789701207476557	transaction_length=1478
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701207476557 (2026-09-18 10:13:27.476557 SE Asia Standard Time)
# immediate_commit_timestamp=1789701207476557 (2026-09-18 10:13:27.476557 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701207476557*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 21787
#260918 10:13:27 server id 1  end_log_pos 21877 CRC32 0x41f2b6c0 	Query	thread_id=21	exec_time=0	error_code=0
SET TIMESTAMP=1789701207/*!*/;
BEGIN
/*!*/;
# at 21877
#260918 10:13:27 server id 1  end_log_pos 21951 CRC32 0x9e53a6cd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 21951
#260918 10:13:27 server id 1  end_log_pos 23155 CRC32 0xda970eb6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
V6ysahMBAAAASgAAAL9VAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4M2mU54=
V6ysah8BAAAAtAQAAHNaAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3k4eE1DSTdj
em8xT2lKeWIzVjBaU0k3Y3pveE5qb2lZV1J0YVc0dWRYTmxjbk11YzJodmR5STdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFd08zMD0/rKxqACgANDc1RHJKaW01QlppVlZNVEpQ
NlBOUnNPRUZuVWNJcGhaRk5QTUlPNgoAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2nAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pWld4VlVsRTBaR0ZQU2xCbVJsaFVjbWR3V25sa1pHcE9Za3hGUTI1
UldWRkhjbGg0TWpGaU9DSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloWTNScGRtbDBl
UzFzYjJkeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aFkzUnBkbWwwZVMxc2Iy
ZHpMbWx1WkdWNElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURw
N2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZr
WkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRBN2ZRPT1X
rKxqtg6X2g==
'/*!*/;
# at 23155
#260918 10:13:27 server id 1  end_log_pos 23186 CRC32 0x3c4ac663 	Xid = 1517
COMMIT/*!*/;
# at 23186
#260918 10:19:45 server id 1  end_log_pos 23265 CRC32 0xae523244 	Anonymous_GTID	last_committed=20	sequence_number=21	rbr_only=yes	original_committed_timestamp=1789701585799475	immediate_commit_timestamp=1789701585799475	transaction_length=1442
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701585799475 (2026-09-18 10:19:45.799475 SE Asia Standard Time)
# immediate_commit_timestamp=1789701585799475 (2026-09-18 10:19:45.799475 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701585799475*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23265
#260918 10:19:45 server id 1  end_log_pos 23355 CRC32 0x8028099d 	Query	thread_id=22	exec_time=0	error_code=0
SET TIMESTAMP=1789701585/*!*/;
BEGIN
/*!*/;
# at 23355
#260918 10:19:45 server id 1  end_log_pos 23429 CRC32 0x8a405215 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 23429
#260918 10:19:45 server id 1  end_log_pos 24597 CRC32 0x8867caa0 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
0a2sahMBAAAASgAAAIVbAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BVSQIo=
0a2sah8BAAAAkAQAABVgAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhZM1JwZG1sMGVTMXNi
MmR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoWTNScGRtbDBlUzFzYjJkekxt
bHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZNVEE3ZlE9PVesrGoA
KAA0NzVEckppbTVCWmlWVk1USlA2UE5Sc09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81Mzcu
MzZkAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxo
VWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZGSGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1p
TzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdN
Q0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1q
cDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5
bmFXNWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6
TURrNE9XUWlPMms2TVRBN2ZRPT3RraxqoMpniA==
'/*!*/;
# at 24597
#260918 10:19:45 server id 1  end_log_pos 24628 CRC32 0xbdcf698d 	Xid = 1577
COMMIT/*!*/;
# at 24628
#260918 10:19:52 server id 1  end_log_pos 24707 CRC32 0x8053e0ff 	Anonymous_GTID	last_committed=21	sequence_number=22	rbr_only=yes	original_committed_timestamp=1789701592638809	immediate_commit_timestamp=1789701592638809	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701592638809 (2026-09-18 10:19:52.638809 SE Asia Standard Time)
# immediate_commit_timestamp=1789701592638809 (2026-09-18 10:19:52.638809 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701592638809*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24707
#260918 10:19:52 server id 1  end_log_pos 24797 CRC32 0xe2a3576a 	Query	thread_id=23	exec_time=0	error_code=0
SET TIMESTAMP=1789701592/*!*/;
BEGIN
/*!*/;
# at 24797
#260918 10:19:52 server id 1  end_log_pos 24871 CRC32 0xd5f9b9a1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 24871
#260918 10:19:52 server id 1  end_log_pos 26015 CRC32 0xef29e35f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
2K2sahMBAAAASgAAACdhAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KG5+dU=
2K2sah8BAAAAeAQAAJ9lAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRBN2ZRPT3Rraxq
ACgANDc1RHJKaW01QlppVlZNVEpQNlBOUnNPRUZuVWNJcGhaRk5QTUlPNgoAAAAAAAAACTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pWld4VlVsRTBaR0ZQU2xCbVJs
aFVjbWR3V25sa1pHcE9Za3hGUTI1UldWRkhjbGg0TWpGaU9DSTdjem81T2lKZmNISmxkbWx2ZFhN
aU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16WTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3
TUM5c1lYbGhibUZ1TDJSaFpuUmhjaUk3Y3pvMU9pSnliM1YwWlNJN2N6b3hORG9pYkdGNVlXNWhi
aTVrWVdaMFlYSWlPMzF6T2pZNklsOW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09u
dDljem96T2lKdVpYY2lPMkU2TURwN2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdS
a1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1EdDnYraxq
X+Mp7w==
'/*!*/;
# at 26015
#260918 10:19:52 server id 1  end_log_pos 26046 CRC32 0x2398f58e 	Xid = 1637
COMMIT/*!*/;
# at 26046
#260918 10:20:11 server id 1  end_log_pos 26125 CRC32 0x675fb60d 	Anonymous_GTID	last_committed=22	sequence_number=23	rbr_only=yes	original_committed_timestamp=1789701611589161	immediate_commit_timestamp=1789701611589161	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789701611589161 (2026-09-18 10:20:11.589161 SE Asia Standard Time)
# immediate_commit_timestamp=1789701611589161 (2026-09-18 10:20:11.589161 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789701611589161*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 26125
#260918 10:20:11 server id 1  end_log_pos 26215 CRC32 0x72c781cf 	Query	thread_id=24	exec_time=0	error_code=0
SET TIMESTAMP=1789701611/*!*/;
BEGIN
/*!*/;
# at 26215
#260918 10:20:11 server id 1  end_log_pos 26289 CRC32 0xeec4f473 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 26289
#260918 10:20:11 server id 1  end_log_pos 27469 CRC32 0xf6a65e13 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
662sahMBAAAASgAAALFmAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HP0xO4=
662sah8BAAAAnAQAAE1rAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpZNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlzWVhsaGJtRnVMMlJoWm5SaGNpSTdj
em8xT2lKeWIzVjBaU0k3Y3pveE5Eb2liR0Y1WVc1aGJpNWtZV1owWVhJaU8zMXpPalk2SWw5bWJH
RnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TUR0OditrGoAKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFTMXJZ
VzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1EdDnrraxqE16m9g==
'/*!*/;
# at 27469
#260918 10:20:11 server id 1  end_log_pos 27500 CRC32 0x338d801d 	Xid = 1697
COMMIT/*!*/;
# at 27500
#260918 10:30:02 server id 1  end_log_pos 27579 CRC32 0x73b82e71 	Anonymous_GTID	last_committed=23	sequence_number=24	rbr_only=yes	original_committed_timestamp=1789702202897161	immediate_commit_timestamp=1789702202897161	transaction_length=1422
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789702202897161 (2026-09-18 10:30:02.897161 SE Asia Standard Time)
# immediate_commit_timestamp=1789702202897161 (2026-09-18 10:30:02.897161 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789702202897161*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27579
#260918 10:30:02 server id 1  end_log_pos 27669 CRC32 0x49a8da51 	Query	thread_id=25	exec_time=0	error_code=0
SET TIMESTAMP=1789702202/*!*/;
BEGIN
/*!*/;
# at 27669
#260918 10:30:02 server id 1  end_log_pos 27743 CRC32 0xf7e5374d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 27743
#260918 10:30:02 server id 1  end_log_pos 28891 CRC32 0x23f3fedb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
OrCsahMBAAAASgAAAF9sAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E035fc=
OrCsah8BAAAAfAQAANtwAAAAAFMAAAAAAAEAAgAG//8AKAA0NzVEckppbTVCWmlWVk1USlA2UE5S
c09FRm5VY0lwaFpGTlBNSU82CgAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2laV3hWVWxFMFpHRlBTbEJtUmxoVWNtZHdXbmxrWkdwT1lreEZRMjVSV1ZG
SGNsaDRNakZpT0NJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlyYjI1MFlXc3ZhSFZpZFc1bmFTMXJZ
VzFwSWp0ek9qVTZJbkp2ZFhSbElqdHpPakV5T2lKb2RXSjFibWRwTFd0aGJXa2lPMzF6T2pZNkls
OW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURw
N2ZYMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdSa1l6SmlNbVk1TkRBeE5UZ3daakF4
TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1EdDnrraxqACgANDc1RHJKaW01QlppVlZNVEpQ
NlBOUnNPRUZuVWNJcGhaRk5QTUlPNgoAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2ZAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pWld4VlVsRTBaR0ZQU2xCbVJsaFVjbWR3V25sa1pHcE9Za3hGUTI1
UldWRkhjbGg0TWpGaU9DSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdj
em8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1E
cDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk1UQTdmUT09
OrCsatv+8yM=
'/*!*/;
# at 28891
#260918 10:30:02 server id 1  end_log_pos 28922 CRC32 0xb8208864 	Xid = 1757
COMMIT/*!*/;
# at 28922
#260919 10:51:20 server id 1  end_log_pos 28945 CRC32 0x2fc3c2d1 	Stop
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
