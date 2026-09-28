# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#260922  8:18:12 server id 1  end_log_pos 126 CRC32 0x5e7bbb5f 	Start: binlog v 4, server v 8.0.30 created 260922  8:18:12 at startup
ROLLBACK/*!*/;
BINLOG '
VNexag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAABU17FqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAAV+7e14=
'/*!*/;
# at 126
#260922  8:18:12 server id 1  end_log_pos 157 CRC32 0x5f0c897c 	Previous-GTIDs
# [empty]
# at 157
#260922  8:26:57 server id 1  end_log_pos 236 CRC32 0xecd16ea0 	Anonymous_GTID	last_committed=0	sequence_number=1	rbr_only=yes	original_committed_timestamp=1790040417770277	immediate_commit_timestamp=1790040417770277	transaction_length=746
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040417770277 (2026-09-22 08:26:57.770277 SE Asia Standard Time)
# immediate_commit_timestamp=1790040417770277 (2026-09-22 08:26:57.770277 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040417770277*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236
#260922  8:26:57 server id 1  end_log_pos 317 CRC32 0xe1e77e03 	Query	thread_id=8	exec_time=0	error_code=0
SET TIMESTAMP=1790040417/*!*/;
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
#260922  8:26:57 server id 1  end_log_pos 391 CRC32 0x6c072240 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 391
#260922  8:26:57 server id 1  end_log_pos 872 CRC32 0x3b6828b2 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
YdmxahMBAAAASgAAAIcBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EAiB2w=
Ydmxah4BAAAA4QEAAGgDAAAAAFMAAAAAAAEAAgAG/wIoADRvU09tOG9OTUdweDFQZkpjbmZ3TVNY
T1ZmeUo1akJiQ2dnTUQwQzUJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2laR0Z3TUdaWFpqTnNhVUpqYTBGSGVVdFllRFExVFhObWJ6TldjVlptY1RRNU9WWXdSMjFK
UnlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElq
dDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1W
M0lqdGhPakE2ZTMxOWZRPT1h2bFqsihoOw==
'/*!*/;
# at 872
#260922  8:26:57 server id 1  end_log_pos 903 CRC32 0x9a348b70 	Xid = 59
COMMIT/*!*/;
# at 903
#260922  8:27:03 server id 1  end_log_pos 982 CRC32 0x85d99c3d 	Anonymous_GTID	last_committed=1	sequence_number=2	rbr_only=yes	original_committed_timestamp=1790040423971532	immediate_commit_timestamp=1790040423971532	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040423971532 (2026-09-22 08:27:03.971532 SE Asia Standard Time)
# immediate_commit_timestamp=1790040423971532 (2026-09-22 08:27:03.971532 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040423971532*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 982
#260922  8:27:03 server id 1  end_log_pos 1072 CRC32 0xb4d446e4 	Query	thread_id=9	exec_time=0	error_code=0
SET TIMESTAMP=1790040423/*!*/;
BEGIN
/*!*/;
# at 1072
#260922  8:27:03 server id 1  end_log_pos 1146 CRC32 0x39a30da9 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 1146
#260922  8:27:03 server id 1  end_log_pos 2090 CRC32 0x2db1caa6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Z9mxahMBAAAASgAAAHoEAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KkNozk=
Z9mxah8BAAAAsAMAACoIAAAAAFMAAAAAAAEAAgAG//8CKAA0b1NPbThvTk1HcHgxUGZKY25md01T
WE9WZnlKNWpCYkNnZ01EMEM1CTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pWkdGd01HWlhaak5zYVVKamEwRkhlVXRZZURRMVRYTm1iek5XY1ZabWNUUTVPVll3UjIx
SlJ5STdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJ
anQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJt
VjNJanRoT2pBNmUzMTlmUT09YdmxagIoADRvU09tOG9OTUdweDFQZkpjbmZ3TVNYT1ZmeUo1akJi
Q2dnTUQwQzUJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2laR0Z3
TUdaWFpqTnNhVUpqYTBGSGVVdFllRFExVFhObWJ6TldjVlptY1RRNU9WWXdSMjFKUnlJN2N6bzVP
aUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1q
Y3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lK
c2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6
T2pNNkltNWxkeUk3WVRvd09udDlmWDA9Z9mxaqbKsS0=
'/*!*/;
# at 2090
#260922  8:27:03 server id 1  end_log_pos 2121 CRC32 0x3848f4c6 	Xid = 116
COMMIT/*!*/;
# at 2121
#260922  8:27:34 server id 1  end_log_pos 2200 CRC32 0x11cc968f 	Anonymous_GTID	last_committed=2	sequence_number=3	rbr_only=yes	original_committed_timestamp=1790040454904615	immediate_commit_timestamp=1790040454904615	transaction_length=1384
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040454904615 (2026-09-22 08:27:34.904615 SE Asia Standard Time)
# immediate_commit_timestamp=1790040454904615 (2026-09-22 08:27:34.904615 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040454904615*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2200
#260922  8:27:34 server id 1  end_log_pos 2281 CRC32 0x1435046b 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1790040454/*!*/;
BEGIN
/*!*/;
# at 2281
#260922  8:27:34 server id 1  end_log_pos 2355 CRC32 0x0e8afd7e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 2355
#260922  8:27:34 server id 1  end_log_pos 3474 CRC32 0x46b65217 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
htmxahMBAAAASgAAADMJAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4H79ig4=
htmxaiABAAAAXwQAAJINAAAAAFMAAAAAAAEAAgAG/wAoAGV5WjRhTnVtZU5lWGFZRDgxWXdNTmdy
WHNudnNVckRFVGI3V0t0SXcEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8xT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVQySjZRa2d3YmtWc1NXTm5hVmRyVjJKbE0zWmljbk53YzNOcE1YSmlWa1JN
Y3pOSk5HRnphaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZNem9pZFhKc0lqdGhPakE2
ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhO
R00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPU3QsGoCKAB4Z2x5eU82dElwU0NEU0tJdGJh
QWVwajFVT0lNYjV2eTNQbVJNZGNECTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQg
MTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykg
Q2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2UAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJ
N2N6bzBNRG9pVURoV1lsVXpkVVJEYVhKU2VXNTRXVkIyVlhsUWVVbG1ZMjFpTlUwMlpEWkxVVzlh
YkZGV1JpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZN
em9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNt
d2lPM002TlRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldr
dmMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdjem8xT2lKeWIzVjBaU0k3Y3pveE9Ub2ljM1J5
ZFd0MGRYSXRiM0puWVc1cGMyRnphU0k3ZlgwPYfcsGoXUrZG
'/*!*/;
# at 3474
#260922  8:27:34 server id 1  end_log_pos 3505 CRC32 0x8e9da8fa 	Xid = 125
COMMIT/*!*/;
# at 3505
#260922  8:27:38 server id 1  end_log_pos 3584 CRC32 0x0ad2eba6 	Anonymous_GTID	last_committed=3	sequence_number=4	rbr_only=yes	original_committed_timestamp=1790040458961247	immediate_commit_timestamp=1790040458961247	transaction_length=1718
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040458961247 (2026-09-22 08:27:38.961247 SE Asia Standard Time)
# immediate_commit_timestamp=1790040458961247 (2026-09-22 08:27:38.961247 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040458961247*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3584
#260922  8:27:38 server id 1  end_log_pos 3674 CRC32 0x0e930f82 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1790040458/*!*/;
BEGIN
/*!*/;
# at 3674
#260922  8:27:38 server id 1  end_log_pos 3748 CRC32 0xbfd0bddb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 3748
#260922  8:27:38 server id 1  end_log_pos 5192 CRC32 0xd61722c5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
itmxahMBAAAASgAAAKQOAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Nu90L8=
itmxah8BAAAApAUAAEgUAAAAAFMAAAAAAAEAAgAG//8CKAA0b1NPbThvTk1HcHgxUGZKY25md01T
WE9WZnlKNWpCYkNnZ01EMEM1CTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2IAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pWkdGd01HWlhaak5zYVVKamEwRkhlVXRZZURRMVRYTm1iek5XY1ZabWNUUTVPVll3UjIx
SlJ5STdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBa
U0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lq
dGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlgwPWfZsWoCKAA0b1NPbThvTk1HcHgxUGZK
Y25md01TWE9WZnlKNWpCYkNnZ01EMEM1CTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3Mg
TlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNr
bykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2BAMAAFlUbzFPbnR6T2pZNklsOTBiMnRs
YmlJN2N6bzBNRG9pWkdGd01HWlhaak5zYVVKamEwRkhlVXRZZURRMVRYTm1iek5XY1ZabWNUUTVP
Vll3UjIxSlJ5STdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16
TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lK
eWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9p
YjJ4a0lqdGhPakk2ZTJrNk1EdHpPakV3T2lKZmIyeGtYMmx1Y0hWMElqdHBPakU3Y3pvMk9pSmxj
bkp2Y25NaU8zMXpPak02SW01bGR5STdZVG93T250OWZYTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8y
RTZNVHA3Y3pvMU9pSmxiV0ZwYkNJN2N6b3lNVG9pYzNsaFptbHhkMnhrYmpCQVoyMWhhV3d1WTI5
dElqdDljem8yT2lKbGNuSnZjbk1pTzA4Nk16RTZJa2xzYkhWdGFXNWhkR1ZjVTNWd2NHOXlkRnhX
YVdWM1JYSnliM0pDWVdjaU9qRTZlM002TnpvaUFDb0FZbUZuY3lJN1lUb3hPbnR6T2pjNkltUmxa
bUYxYkhRaU8wODZNams2SWtsc2JIVnRhVzVoZEdWY1UzVndjRzl5ZEZ4TlpYTnpZV2RsUW1Gbklq
b3lPbnR6T2pFeE9pSUFLZ0J0WlhOellXZGxjeUk3WVRveE9udHpPalU2SW1WdFlXbHNJanRoT2pF
NmUyazZNRHR6T2pRek9pSlVhR1Z6WlNCamNtVmtaVzUwYVdGc2N5QmtieUJ1YjNRZ2JXRjBZMmdn
YjNWeUlISmxZMjl5WkhNdUlqdDlmWE02T1RvaUFDb0FabTl5YldGMElqdHpPamc2SWpwdFpYTnpZ
V2RsSWp0OWZYMTmK2bFqxSIX1g==
'/*!*/;
# at 5192
#260922  8:27:38 server id 1  end_log_pos 5223 CRC32 0xa897d0b6 	Xid = 131
COMMIT/*!*/;
# at 5223
#260922  8:27:39 server id 1  end_log_pos 5302 CRC32 0x74ee437c 	Anonymous_GTID	last_committed=4	sequence_number=5	rbr_only=yes	original_committed_timestamp=1790040459788519	immediate_commit_timestamp=1790040459788519	transaction_length=1718
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040459788519 (2026-09-22 08:27:39.788519 SE Asia Standard Time)
# immediate_commit_timestamp=1790040459788519 (2026-09-22 08:27:39.788519 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040459788519*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5302
#260922  8:27:39 server id 1  end_log_pos 5392 CRC32 0x6cd12928 	Query	thread_id=11	exec_time=0	error_code=0
SET TIMESTAMP=1790040459/*!*/;
BEGIN
/*!*/;
# at 5392
#260922  8:27:39 server id 1  end_log_pos 5466 CRC32 0x353e86b5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 5466
#260922  8:27:39 server id 1  end_log_pos 6910 CRC32 0xab4e98ec 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
i9mxahMBAAAASgAAAFoVAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LWGPjU=
i9mxah8BAAAApAUAAP4aAAAAAFMAAAAAAAEAAgAG//8CKAA0b1NPbThvTk1HcHgxUGZKY25md01T
WE9WZnlKNWpCYkNnZ01EMEM1CTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2BAMAAFlUbzFPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pWkdGd01HWlhaak5zYVVKamEwRkhlVXRZZURRMVRYTm1iek5XY1ZabWNUUTVPVll3UjIx
SlJ5STdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBa
U0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lq
dGhPakk2ZTJrNk1EdHpPakV3T2lKZmIyeGtYMmx1Y0hWMElqdHBPakU3Y3pvMk9pSmxjbkp2Y25N
aU8zMXpPak02SW01bGR5STdZVG93T250OWZYTTZNVEE2SWw5dmJHUmZhVzV3ZFhRaU8yRTZNVHA3
Y3pvMU9pSmxiV0ZwYkNJN2N6b3lNVG9pYzNsaFptbHhkMnhrYmpCQVoyMWhhV3d1WTI5dElqdDlj
em8yT2lKbGNuSnZjbk1pTzA4Nk16RTZJa2xzYkhWdGFXNWhkR1ZjVTNWd2NHOXlkRnhXYVdWM1JY
SnliM0pDWVdjaU9qRTZlM002TnpvaUFDb0FZbUZuY3lJN1lUb3hPbnR6T2pjNkltUmxabUYxYkhR
aU8wODZNams2SWtsc2JIVnRhVzVoZEdWY1UzVndjRzl5ZEZ4TlpYTnpZV2RsUW1Gbklqb3lPbnR6
T2pFeE9pSUFLZ0J0WlhOellXZGxjeUk3WVRveE9udHpPalU2SW1WdFlXbHNJanRoT2pFNmUyazZN
RHR6T2pRek9pSlVhR1Z6WlNCamNtVmtaVzUwYVdGc2N5QmtieUJ1YjNRZ2JXRjBZMmdnYjNWeUlI
SmxZMjl5WkhNdUlqdDlmWE02T1RvaUFDb0FabTl5YldGMElqdHpPamc2SWpwdFpYTnpZV2RsSWp0
OWZYMTmK2bFqAigANG9TT204b05NR3B4MVBmSmNuZndNU1hPVmZ5SjVqQmJDZ2dNRDBDNQkxMjcu
MC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2Vi
S2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUz
Ny4zNiABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVpHRndNR1pYWmpOc2FVSmph
MEZIZVV0WWVEUTFUWE5tYnpOV2NWWm1jVFE1T1ZZd1IyMUpSeUk3Y3pvNU9pSmZjSEpsZG1sdmRY
TWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RB
d01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02
TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZ
VG93T250OWZYMD2L2bFq7JhOqw==
'/*!*/;
# at 6910
#260922  8:27:39 server id 1  end_log_pos 6941 CRC32 0x85de36cd 	Xid = 188
COMMIT/*!*/;
# at 6941
#260922  8:28:07 server id 1  end_log_pos 7020 CRC32 0x6f2ce06f 	Anonymous_GTID	last_committed=5	sequence_number=6	rbr_only=yes	original_committed_timestamp=1790040487241244	immediate_commit_timestamp=1790040487241244	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040487241244 (2026-09-22 08:28:07.241244 SE Asia Standard Time)
# immediate_commit_timestamp=1790040487241244 (2026-09-22 08:28:07.241244 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040487241244*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 7020
#260922  8:28:07 server id 1  end_log_pos 7101 CRC32 0x1b257b93 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1790040487/*!*/;
BEGIN
/*!*/;
# at 7101
#260922  8:28:07 server id 1  end_log_pos 7175 CRC32 0x59daa793 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 7175
#260922  8:28:07 server id 1  end_log_pos 7672 CRC32 0x558b2f1a 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
p9mxahMBAAAASgAAAAccAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JOn2lk=
p9mxaiABAAAA8QEAAPgdAAAAAFMAAAAAAAEAAgAG/wIoADRvU09tOG9OTUdweDFQZkpjbmZ3TVNY
T1ZmeUo1akJiQ2dnTUQwQzUJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2laR0Z3TUdaWFpqTnNhVUpqYTBGSGVVdFllRFExVFhObWJ6TldjVlptY1RRNU9WWXdSMjFK
UnlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9i9mxahovi1U=
'/*!*/;
# at 7672
#260922  8:28:07 server id 1  end_log_pos 7703 CRC32 0x7df62b4a 	Xid = 200
COMMIT/*!*/;
# at 7703
#260922  8:28:10 server id 1  end_log_pos 7782 CRC32 0xe8a7d724 	Anonymous_GTID	last_committed=6	sequence_number=7	rbr_only=yes	original_committed_timestamp=1790040490935762	immediate_commit_timestamp=1790040490935762	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040490935762 (2026-09-22 08:28:10.935762 SE Asia Standard Time)
# immediate_commit_timestamp=1790040490935762 (2026-09-22 08:28:10.935762 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040490935762*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 7782
#260922  8:28:10 server id 1  end_log_pos 7863 CRC32 0x7cc1505e 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1790040490/*!*/;
BEGIN
/*!*/;
# at 7863
#260922  8:28:10 server id 1  end_log_pos 7937 CRC32 0x6db668af 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 7937
#260922  8:28:10 server id 1  end_log_pos 8526 CRC32 0xebf07704 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
qtmxahMBAAAASgAAAAEfAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K9otm0=
qtmxah4BAAAATQIAAE4hAAAAAFMAAAAAAAEAAgAG/wAoAHlCV0wxbEd5N01lWkg3R0wxNUdua2tU
STczdjFQbE5hMXJyQ3lyb2oEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVVUSk9VVlpxVjBveWNqaGlVRTkzTVdOb1QwUlpjVk5hYzNnM2NsbEJXVFkx
TUVsMVdVaHRiaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT2q2bFqBHfw6w==
'/*!*/;
# at 8526
#260922  8:28:10 server id 1  end_log_pos 8557 CRC32 0x6e87d587 	Xid = 206
COMMIT/*!*/;
# at 8557
#260922  8:28:13 server id 1  end_log_pos 8636 CRC32 0xd4f6fe0f 	Anonymous_GTID	last_committed=7	sequence_number=8	rbr_only=yes	original_committed_timestamp=1790040493479762	immediate_commit_timestamp=1790040493479762	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040493479762 (2026-09-22 08:28:13.479762 SE Asia Standard Time)
# immediate_commit_timestamp=1790040493479762 (2026-09-22 08:28:13.479762 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040493479762*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 8636
#260922  8:28:13 server id 1  end_log_pos 8726 CRC32 0x7c479746 	Query	thread_id=13	exec_time=0	error_code=0
SET TIMESTAMP=1790040493/*!*/;
BEGIN
/*!*/;
# at 8726
#260922  8:28:13 server id 1  end_log_pos 8800 CRC32 0x9eef5cbc 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 8800
#260922  8:28:13 server id 1  end_log_pos 9964 CRC32 0x2c40e181 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
rdmxahMBAAAASgAAAGAiAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Lxc754=
rdmxah8BAAAAjAQAAOwmAAAAAFMAAAAAAAEAAgAG//8AKAB5QldMMWxHeTdNZVpIN0dMMTVHbmtr
VEk3M3YxUGxOYTFyckN5cm9qBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lVVEpPVVZacVYwb3ljamhpVUU5M01XTm9UMFJaY1ZOYWMzZzNjbGxCV1RZ
MU1FbDFXVWh0YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09qtmxagAoAHlCV0wxbEd5N01lWkg3R0wxNUdua2tUSTczdjFQbE5hMXJyQ3ly
b2oEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVVU
Sk9VVlpxVjBveWNqaGlVRTkzTVdOb1QwUlpjVk5hYzNnM2NsbEJXVFkxTUVsMVdVaHRiaUk3Y3pv
NU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlP
M002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUz
TTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9Pa3ZsWqB4UAs
'/*!*/;
# at 9964
#260922  8:28:13 server id 1  end_log_pos 9995 CRC32 0x212d489d 	Xid = 392
COMMIT/*!*/;
# at 9995
#260922  8:29:06 server id 1  end_log_pos 10074 CRC32 0x970bc8fe 	Anonymous_GTID	last_committed=8	sequence_number=9	rbr_only=yes	original_committed_timestamp=1790040546544165	immediate_commit_timestamp=1790040546544165	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040546544165 (2026-09-22 08:29:06.544165 SE Asia Standard Time)
# immediate_commit_timestamp=1790040546544165 (2026-09-22 08:29:06.544165 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040546544165*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 10074
#260922  8:29:06 server id 1  end_log_pos 10164 CRC32 0xd98177df 	Query	thread_id=14	exec_time=0	error_code=0
SET TIMESTAMP=1790040546/*!*/;
BEGIN
/*!*/;
# at 10164
#260922  8:29:06 server id 1  end_log_pos 10238 CRC32 0x17886d51 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 10238
#260922  8:29:06 server id 1  end_log_pos 11382 CRC32 0x49ab4206 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
4tmxahMBAAAASgAAAP4nAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FFtiBc=
4tmxah8BAAAAeAQAAHYsAAAAAFMAAAAAAAEAAgAG//8AKAB5QldMMWxHeTdNZVpIN0dMMTVHbmtr
VEk3M3YxUGxOYTFyckN5cm9qBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lVVEpPVVZacVYwb3ljamhpVUU5M01XTm9UMFJaY1ZOYWMzZzNjbGxCV1RZ
MU1FbDFXVWh0YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT2t2bFqACgAeUJXTDFsR3k3TWVaSDdHTDE1
R25ra1RJNzN2MVBsTmExcnJDeXJvagQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pVVRKT1VWWnFWMG95Y2poaVVFOTNNV05vVDBSWmNWTmFjM2czY2xs
QldUWTFNRWwxV1VodGJpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdj
em8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1E
cDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDni2bFq
BkKrSQ==
'/*!*/;
# at 11382
#260922  8:29:06 server id 1  end_log_pos 11413 CRC32 0x24789d8b 	Xid = 452
COMMIT/*!*/;
# at 11413
#260922  8:29:11 server id 1  end_log_pos 11492 CRC32 0x21a52308 	Anonymous_GTID	last_committed=9	sequence_number=10	rbr_only=yes	original_committed_timestamp=1790040551505695	immediate_commit_timestamp=1790040551505695	transaction_length=1398
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040551505695 (2026-09-22 08:29:11.505695 SE Asia Standard Time)
# immediate_commit_timestamp=1790040551505695 (2026-09-22 08:29:11.505695 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040551505695*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 11492
#260922  8:29:11 server id 1  end_log_pos 11582 CRC32 0x8e17a26b 	Query	thread_id=15	exec_time=0	error_code=0
SET TIMESTAMP=1790040551/*!*/;
BEGIN
/*!*/;
# at 11582
#260922  8:29:11 server id 1  end_log_pos 11656 CRC32 0x1a1e00df 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 11656
#260922  8:29:11 server id 1  end_log_pos 12780 CRC32 0xd67e107b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
59mxahMBAAAASgAAAIgtAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N8AHho=
59mxah8BAAAAZAQAAOwxAAAAAFMAAAAAAAEAAgAG//8AKAB5QldMMWxHeTdNZVpIN0dMMTVHbmtr
VEk3M3YxUGxOYTFyckN5cm9qBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lVVEpPVVZacVYwb3ljamhpVUU5M01XTm9UMFJaY1ZOYWMzZzNjbGxCV1RZ
MU1FbDFXVWh0YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OeLZsWoAKAB5
QldMMWxHeTdNZVpIN0dMMTVHbmtrVEk3M3YxUGxOYTFyckN5cm9qBAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lVVEpPVVZacVYwb3ljamhpVUU5M01X
Tm9UMFJaY1ZOYWMzZzNjbGxCV1RZMU1FbDFXVWh0YmlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlo
WkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lY
MlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09u
dDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURF
MFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT0959mxansQftY=
'/*!*/;
# at 12780
#260922  8:29:11 server id 1  end_log_pos 12811 CRC32 0x840a92bb 	Xid = 512
COMMIT/*!*/;
# at 12811
#260922  8:29:28 server id 1  end_log_pos 12890 CRC32 0x0e7fddfb 	Anonymous_GTID	last_committed=10	sequence_number=11	rbr_only=yes	original_committed_timestamp=1790040568937577	immediate_commit_timestamp=1790040568937577	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040568937577 (2026-09-22 08:29:28.937577 SE Asia Standard Time)
# immediate_commit_timestamp=1790040568937577 (2026-09-22 08:29:28.937577 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040568937577*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12890
#260922  8:29:28 server id 1  end_log_pos 12971 CRC32 0xf4e81077 	Query	thread_id=16	exec_time=0	error_code=0
SET TIMESTAMP=1790040568/*!*/;
BEGIN
/*!*/;
# at 12971
#260922  8:29:28 server id 1  end_log_pos 13045 CRC32 0x109ac35d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 13045
#260922  8:29:28 server id 1  end_log_pos 13634 CRC32 0x7c6f6a48 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
+NmxahMBAAAASgAAAPUyAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4F3DmhA=
+NmxaiABAAAATQIAAEI1AAAAAFMAAAAAAAEAAgAG/wAoAHlCV0wxbEd5N01lWkg3R0wxNUdua2tU
STczdjFQbE5hMXJyQ3lyb2oEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVVUSk9VVlpxVjBveWNqaGlVRTkzTVdOb1QwUlpjVk5hYzNnM2NsbEJXVFkx
TUVsMVdVaHRiaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT3n2bFqSGpvfA==
'/*!*/;
# at 13634
#260922  8:29:28 server id 1  end_log_pos 13665 CRC32 0xbe1fef47 	Xid = 524
COMMIT/*!*/;
# at 13665
#260922  8:29:29 server id 1  end_log_pos 13744 CRC32 0x219aaf87 	Anonymous_GTID	last_committed=11	sequence_number=12	rbr_only=yes	original_committed_timestamp=1790040569005395	immediate_commit_timestamp=1790040569005395	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040569005395 (2026-09-22 08:29:29.005395 SE Asia Standard Time)
# immediate_commit_timestamp=1790040569005395 (2026-09-22 08:29:29.005395 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040569005395*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13744
#260922  8:29:29 server id 1  end_log_pos 13825 CRC32 0x04d89d0c 	Query	thread_id=16	exec_time=0	error_code=0
SET TIMESTAMP=1790040569/*!*/;
BEGIN
/*!*/;
# at 13825
#260922  8:29:29 server id 1  end_log_pos 13899 CRC32 0xb816a0da 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 13899
#260922  8:29:29 server id 1  end_log_pos 14488 CRC32 0x9f9e228f 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
+dmxahMBAAAASgAAAEs2AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NqgFrg=
+dmxah4BAAAATQIAAJg4AAAAAFMAAAAAAAEAAgAG/wAoAFgzenlOMmRzYmxwQW1LejlTUGtyemJs
Tk5sb3B5UVZITW1tekV2SEYLAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWNXbzRZbEp5YkRSaFVsUlNlamxJYnpCeE1rRTFkbTEzYjJWUVJFZFNWMmsx
WWxvd1NYZFJlQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pFeE8zMD352bFqjyKenw==
'/*!*/;
# at 14488
#260922  8:29:29 server id 1  end_log_pos 14519 CRC32 0xa234d8a8 	Xid = 530
COMMIT/*!*/;
# at 14519
#260922  8:29:29 server id 1  end_log_pos 14598 CRC32 0x0cd5ff02 	Anonymous_GTID	last_committed=12	sequence_number=13	rbr_only=yes	original_committed_timestamp=1790040569774882	immediate_commit_timestamp=1790040569774882	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040569774882 (2026-09-22 08:29:29.774882 SE Asia Standard Time)
# immediate_commit_timestamp=1790040569774882 (2026-09-22 08:29:29.774882 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040569774882*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 14598
#260922  8:29:29 server id 1  end_log_pos 14688 CRC32 0x092ec3b4 	Query	thread_id=17	exec_time=0	error_code=0
SET TIMESTAMP=1790040569/*!*/;
BEGIN
/*!*/;
# at 14688
#260922  8:29:29 server id 1  end_log_pos 14762 CRC32 0xc0345baf 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 14762
#260922  8:29:29 server id 1  end_log_pos 15926 CRC32 0xca7558da 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
+dmxahMBAAAASgAAAKo5AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4K9bNMA=
+dmxah8BAAAAjAQAADY+AAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qRXhPMzA9+dmxagAoAFgzenlOMmRzYmxwQW1LejlTUGtyemJsTk5sb3B5UVZITW1tekV2
SEYLAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWNX
bzRZbEp5YkRSaFVsUlNlamxJYnpCeE1rRTFkbTEzYjJWUVJFZFNWMmsxWWxvd1NYZFJlQ0k3Y3pv
NU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlP
M002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUz
TTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPakV4TzMwPfnZsWraWHXK
'/*!*/;
# at 15926
#260922  8:29:29 server id 1  end_log_pos 15957 CRC32 0xff86c73d 	Xid = 716
COMMIT/*!*/;
# at 15957
#260922  8:35:49 server id 1  end_log_pos 16036 CRC32 0xfb943bae 	Anonymous_GTID	last_committed=13	sequence_number=14	rbr_only=yes	original_committed_timestamp=1790040949902472	immediate_commit_timestamp=1790040949902472	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040949902472 (2026-09-22 08:35:49.902472 SE Asia Standard Time)
# immediate_commit_timestamp=1790040949902472 (2026-09-22 08:35:49.902472 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040949902472*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 16036
#260922  8:35:49 server id 1  end_log_pos 16126 CRC32 0xea55a85c 	Query	thread_id=18	exec_time=0	error_code=0
SET TIMESTAMP=1790040949/*!*/;
BEGIN
/*!*/;
# at 16126
#260922  8:35:49 server id 1  end_log_pos 16200 CRC32 0x636635e8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 16200
#260922  8:35:49 server id 1  end_log_pos 17384 CRC32 0x59f2ca9d 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
dduxahMBAAAASgAAAEg/AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Og1ZmM=
dduxah8BAAAAoAQAAOhDAAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD352bFqACgAWDN6eU4yZHNibHBBbUt6OVNQ
a3J6YmxOTmxvcHlRVkhNbW16RXZIRgsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY1dvNFlsSnliRFJoVWxSU2VqbEliekJ4TWtFMWRtMTNiMlZRUkVk
U1YyazFZbG93U1hkUmVDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5q
b2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRv
d09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qRXhPMzA9dduxap3K8lk=
'/*!*/;
# at 17384
#260922  8:35:49 server id 1  end_log_pos 17415 CRC32 0xf38403e3 	Xid = 737
COMMIT/*!*/;
# at 17415
#260922  8:35:50 server id 1  end_log_pos 17494 CRC32 0x5a15dd5e 	Anonymous_GTID	last_committed=14	sequence_number=15	rbr_only=yes	original_committed_timestamp=1790040950657931	immediate_commit_timestamp=1790040950657931	transaction_length=1478
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040950657931 (2026-09-22 08:35:50.657931 SE Asia Standard Time)
# immediate_commit_timestamp=1790040950657931 (2026-09-22 08:35:50.657931 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040950657931*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 17494
#260922  8:35:50 server id 1  end_log_pos 17584 CRC32 0x8c1f8f2a 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1790040950/*!*/;
BEGIN
/*!*/;
# at 17584
#260922  8:35:50 server id 1  end_log_pos 17658 CRC32 0x6c78b803 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 17658
#260922  8:35:50 server id 1  end_log_pos 18862 CRC32 0xf06eda2b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
dtuxahMBAAAASgAAAPpEAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AO4eGw=
dtuxah8BAAAAtAQAAK5JAAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD1127FqACgAWDN6eU4yZHNibHBBbUt6OVNQ
a3J6YmxOTmxvcHlRVkhNbW16RXZIRgsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2nAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY1dvNFlsSnliRFJoVWxSU2VqbEliekJ4TWtFMWRtMTNiMlZRUkVk
U1YyazFZbG93U1hkUmVDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloWTNScGRtbDBl
UzFzYjJkeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aFkzUnBkbWwwZVMxc2Iy
ZHpMbWx1WkdWNElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURw
N2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZr
WkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT12
27FqK9pu8A==
'/*!*/;
# at 18862
#260922  8:35:50 server id 1  end_log_pos 18893 CRC32 0x61bfb4e4 	Xid = 758
COMMIT/*!*/;
# at 18893
#260922  8:36:03 server id 1  end_log_pos 18972 CRC32 0xcc5dd313 	Anonymous_GTID	last_committed=15	sequence_number=16	rbr_only=yes	original_committed_timestamp=1790040963408468	immediate_commit_timestamp=1790040963408468	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040963408468 (2026-09-22 08:36:03.408468 SE Asia Standard Time)
# immediate_commit_timestamp=1790040963408468 (2026-09-22 08:36:03.408468 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040963408468*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 18972
#260922  8:36:03 server id 1  end_log_pos 19062 CRC32 0xbdf35750 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1790040963/*!*/;
BEGIN
/*!*/;
# at 19062
#260922  8:36:03 server id 1  end_log_pos 19136 CRC32 0x12a99edd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 19136
#260922  8:36:03 server id 1  end_log_pos 20360 CRC32 0x7ee60499 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
g9uxahMBAAAASgAAAMBKAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4N2eqRI=
g9uxah8BAAAAyAQAAIhPAAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhZM1JwZG1sMGVTMXNi
MmR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoWTNScGRtbDBlUzFzYjJkekxt
bHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZNVEU3ZlE9PXbbsWoA
KABYM3p5TjJkc2JscEFtS3o5U1BrcnpibE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWps
SWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJrMVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1p
TzJFNk1qcDdjem96T2lKMWNtd2lPM002TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdN
QzloWkcxcGJpOWhZM1JwZG1sMGVTMXNiMmR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpH
MXBiaTVoWTNScGRtbDBlUzFzYjJkekxtbHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpw
N2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzlu
YVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpN
RGs0T1dRaU8yazZNVEU3ZlE9PYPbsWqZBOZ+
'/*!*/;
# at 20360
#260922  8:36:03 server id 1  end_log_pos 20391 CRC32 0x8c6c4221 	Xid = 779
COMMIT/*!*/;
# at 20391
#260922  8:36:14 server id 1  end_log_pos 20470 CRC32 0xffa7e581 	Anonymous_GTID	last_committed=16	sequence_number=17	rbr_only=yes	original_committed_timestamp=1790040974679958	immediate_commit_timestamp=1790040974679958	transaction_length=1478
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790040974679958 (2026-09-22 08:36:14.679958 SE Asia Standard Time)
# immediate_commit_timestamp=1790040974679958 (2026-09-22 08:36:14.679958 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790040974679958*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 20470
#260922  8:36:14 server id 1  end_log_pos 20560 CRC32 0x5d43f503 	Query	thread_id=22	exec_time=0	error_code=0
SET TIMESTAMP=1790040974/*!*/;
BEGIN
/*!*/;
# at 20560
#260922  8:36:14 server id 1  end_log_pos 20634 CRC32 0xbff89b4b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 20634
#260922  8:36:14 server id 1  end_log_pos 21838 CRC32 0x435e5232 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
jtuxahMBAAAASgAAAJpQAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Eub+L8=
jtuxah8BAAAAtAQAAE5VAAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhZM1JwZG1sMGVTMXNi
MmR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoWTNScGRtbDBlUzFzYjJkekxt
bHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZNVEU3ZlE9PYPbsWoA
KABYM3p5TjJkc2JscEFtS3o5U1BrcnpibE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81Mzcu
MzaIAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWps
SWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJrMVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1p
TzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdN
QzloWkcxcGJpOWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxt
UmhjMmhpYjJGeVpDSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pB
NmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpo
WkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD2O
27FqMlJeQw==
'/*!*/;
# at 21838
#260922  8:36:14 server id 1  end_log_pos 21869 CRC32 0x1ff49940 	Xid = 989
COMMIT/*!*/;
# at 21869
#260922  8:37:06 server id 1  end_log_pos 21948 CRC32 0x6c6ac973 	Anonymous_GTID	last_committed=17	sequence_number=18	rbr_only=yes	original_committed_timestamp=1790041026041602	immediate_commit_timestamp=1790041026041602	transaction_length=1422
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041026041602 (2026-09-22 08:37:06.041602 SE Asia Standard Time)
# immediate_commit_timestamp=1790041026041602 (2026-09-22 08:37:06.041602 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041026041602*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 21948
#260922  8:37:06 server id 1  end_log_pos 22038 CRC32 0x899b91ae 	Query	thread_id=23	exec_time=0	error_code=0
SET TIMESTAMP=1790041026/*!*/;
BEGIN
/*!*/;
# at 22038
#260922  8:37:06 server id 1  end_log_pos 22112 CRC32 0xa69859b5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 22112
#260922  8:37:06 server id 1  end_log_pos 23260 CRC32 0x28bad936 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
wtuxahMBAAAASgAAAGBWAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LVZmKY=
wtuxah8BAAAAfAQAANxaAAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD2O27FqACgAWDN6eU4yZHNibHBBbUt6OVNQ
a3J6YmxOTmxvcHlRVkhNbW16RXZIRgsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2ZAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pY1dvNFlsSnliRFJoVWxSU2VqbEliekJ4TWtFMWRtMTNiMlZRUkVk
U1YyazFZbG93U1hkUmVDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdj
em8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1E
cDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk1URTdmUT09
wtuxajbZuig=
'/*!*/;
# at 23260
#260922  8:37:06 server id 1  end_log_pos 23291 CRC32 0x1facb5d4 	Xid = 1049
COMMIT/*!*/;
# at 23291
#260922  8:37:09 server id 1  end_log_pos 23370 CRC32 0x7b406e16 	Anonymous_GTID	last_committed=18	sequence_number=19	rbr_only=yes	original_committed_timestamp=1790041029871272	immediate_commit_timestamp=1790041029871272	transaction_length=1402
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041029871272 (2026-09-22 08:37:09.871272 SE Asia Standard Time)
# immediate_commit_timestamp=1790041029871272 (2026-09-22 08:37:09.871272 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041029871272*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23370
#260922  8:37:09 server id 1  end_log_pos 23460 CRC32 0xb36a167a 	Query	thread_id=24	exec_time=0	error_code=0
SET TIMESTAMP=1790041029/*!*/;
BEGIN
/*!*/;
# at 23460
#260922  8:37:09 server id 1  end_log_pos 23534 CRC32 0x01684065 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 23534
#260922  8:37:09 server id 1  end_log_pos 24662 CRC32 0x276d3215 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
xduxahMBAAAASgAAAO5bAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GVAaAE=
xduxah8BAAAAaAQAAFZgAAAAAFMAAAAAAAEAAgAG//8AKABYM3p5TjJkc2JscEFtS3o5U1Brcnpi
bE5ObG9weVFWSE1tbXpFdkhGCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2ljV280WWxKeWJEUmhVbFJTZWpsSWJ6QnhNa0UxZG0xM2IyVlFSRWRTVjJr
MVlsb3dTWGRSZUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT3C27Fq
ACgAWDN6eU4yZHNibHBBbUt6OVNQa3J6YmxOTmxvcHlRVkhNbW16RXZIRgsAAAAAAAAACTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2dAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pY1dvNFlsSnliRFJoVWxSU2Vq
bEliekJ4TWtFMWRtMTNiMlZRUkVkU1YyazFZbG93U1hkUmVDSTdjem81T2lKZmNISmxkbWx2ZFhN
aU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3
TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZO
am9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lU
b3dPbnQ5ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RC
bU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPakV4TzMwPcXbsWoVMm0n
'/*!*/;
# at 24662
#260922  8:37:09 server id 1  end_log_pos 24693 CRC32 0xc685159b 	Xid = 1109
COMMIT/*!*/;
# at 24693
#260922  8:37:22 server id 1  end_log_pos 24772 CRC32 0x9b36f681 	Anonymous_GTID	last_committed=19	sequence_number=20	rbr_only=yes	original_committed_timestamp=1790041042939555	immediate_commit_timestamp=1790041042939555	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041042939555 (2026-09-22 08:37:22.939555 SE Asia Standard Time)
# immediate_commit_timestamp=1790041042939555 (2026-09-22 08:37:22.939555 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041042939555*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24772
#260922  8:37:22 server id 1  end_log_pos 24853 CRC32 0x99c50850 	Query	thread_id=25	exec_time=0	error_code=0
SET TIMESTAMP=1790041042/*!*/;
BEGIN
/*!*/;
# at 24853
#260922  8:37:22 server id 1  end_log_pos 24927 CRC32 0x1a4136ab 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 24927
#260922  8:37:22 server id 1  end_log_pos 25516 CRC32 0x7953697e 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
0tuxahMBAAAASgAAAF9hAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ks2QRo=
0tuxaiABAAAATQIAAKxjAAAAAFMAAAAAAAEAAgAG/wAoAFgzenlOMmRzYmxwQW1LejlTUGtyemJs
Tk5sb3B5UVZITW1tekV2SEYLAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWNXbzRZbEp5YkRSaFVsUlNlamxJYnpCeE1rRTFkbTEzYjJWUVJFZFNWMmsx
WWxvd1NYZFJlQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pFeE8zMD3F27FqfmlTeQ==
'/*!*/;
# at 25516
#260922  8:37:22 server id 1  end_log_pos 25547 CRC32 0x155737d7 	Xid = 1121
COMMIT/*!*/;
# at 25547
#260922  8:37:23 server id 1  end_log_pos 25626 CRC32 0xc3686b9b 	Anonymous_GTID	last_committed=20	sequence_number=21	rbr_only=yes	original_committed_timestamp=1790041043028160	immediate_commit_timestamp=1790041043028160	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041043028160 (2026-09-22 08:37:23.028160 SE Asia Standard Time)
# immediate_commit_timestamp=1790041043028160 (2026-09-22 08:37:23.028160 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041043028160*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25626
#260922  8:37:23 server id 1  end_log_pos 25707 CRC32 0xca1bc8a4 	Query	thread_id=25	exec_time=0	error_code=0
SET TIMESTAMP=1790041043/*!*/;
BEGIN
/*!*/;
# at 25707
#260922  8:37:23 server id 1  end_log_pos 25781 CRC32 0x002ea92f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 25781
#260922  8:37:23 server id 1  end_log_pos 26370 CRC32 0x812a69de 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
09uxahMBAAAASgAAALVkAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4C+pLgA=
09uxah4BAAAATQIAAAJnAAAAAFMAAAAAAAEAAgAG/wAoAElPSGRhcnhRbUhFelJyYlpqS3g3dkZE
cld4U0JxdVEyT0NUbEl0R3EEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVptUkVia3c1WldjMVptUmtRVlJVWkhSaFRsbzRlVW8xZVRWWGNtTXdOR00y
YlhSMFFXTXpNQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT3T27Fq3mkqgQ==
'/*!*/;
# at 26370
#260922  8:37:23 server id 1  end_log_pos 26401 CRC32 0xa094f5d7 	Xid = 1127
COMMIT/*!*/;
# at 26401
#260922  8:37:24 server id 1  end_log_pos 26480 CRC32 0x871cede4 	Anonymous_GTID	last_committed=21	sequence_number=22	rbr_only=yes	original_committed_timestamp=1790041044096645	immediate_commit_timestamp=1790041044096645	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041044096645 (2026-09-22 08:37:24.096645 SE Asia Standard Time)
# immediate_commit_timestamp=1790041044096645 (2026-09-22 08:37:24.096645 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041044096645*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 26480
#260922  8:37:24 server id 1  end_log_pos 26570 CRC32 0xf6ab0f8e 	Query	thread_id=26	exec_time=0	error_code=0
SET TIMESTAMP=1790041044/*!*/;
BEGIN
/*!*/;
# at 26570
#260922  8:37:24 server id 1  end_log_pos 26644 CRC32 0x97f14f36 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 26644
#260922  8:37:24 server id 1  end_log_pos 27808 CRC32 0x3673ed96 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
1NuxahMBAAAASgAAABRoAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DZP8Zc=
1Nuxah8BAAAAjAQAAKBsAAAAAFMAAAAAAAEAAgAG//8AKABJT0hkYXJ4UW1IRXpScmJaakt4N3ZG
RHJXeFNCcXVRMk9DVGxJdEdxBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2labVJFYmt3NVpXYzFabVJrUVZSVVpIUmhUbG80ZVVvMWVUVlhjbU13TkdN
MmJYUjBRV016TUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT0909uxagAoAElPSGRhcnhRbUhFelJyYlpqS3g3dkZEcld4U0JxdVEyT0NUbEl0
R3EEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVpt
UkVia3c1WldjMVptUmtRVlJVWkhSaFRsbzRlVW8xZVRWWGNtTXdOR00yYlhSMFFXTXpNQ0k3Y3pv
NU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlP
M002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUz
TTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9PdTbsWqW7XM2
'/*!*/;
# at 27808
#260922  8:37:24 server id 1  end_log_pos 27839 CRC32 0xf2574a22 	Xid = 1313
COMMIT/*!*/;
# at 27839
#260922  8:37:30 server id 1  end_log_pos 27918 CRC32 0x15f932bf 	Anonymous_GTID	last_committed=22	sequence_number=23	rbr_only=yes	original_committed_timestamp=1790041050007721	immediate_commit_timestamp=1790041050007721	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041050007721 (2026-09-22 08:37:30.007721 SE Asia Standard Time)
# immediate_commit_timestamp=1790041050007721 (2026-09-22 08:37:30.007721 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041050007721*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27918
#260922  8:37:30 server id 1  end_log_pos 28008 CRC32 0xf0c81c35 	Query	thread_id=27	exec_time=0	error_code=0
SET TIMESTAMP=1790041050/*!*/;
BEGIN
/*!*/;
# at 28008
#260922  8:37:30 server id 1  end_log_pos 28082 CRC32 0x4583ea8c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 28082
#260922  8:37:30 server id 1  end_log_pos 29266 CRC32 0x0fb7a322 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
2tuxahMBAAAASgAAALJtAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Izqg0U=
2tuxah8BAAAAoAQAAFJyAAAAAFMAAAAAAAEAAgAG//8AKABJT0hkYXJ4UW1IRXpScmJaakt4N3ZG
RHJXeFNCcXVRMk9DVGxJdEdxBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2labVJFYmt3NVpXYzFabVJrUVZSVVpIUmhUbG80ZVVvMWVUVlhjbU13TkdN
MmJYUjBRV016TUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3U27FqACgASU9IZGFyeFFtSEV6UnJiWmpL
eDd2RkRyV3hTQnF1UTJPQ1RsSXRHcQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pWm1SRWJrdzVaV2MxWm1Sa1FWUlVaSFJoVGxvNGVVbzFlVFZYY21N
d05HTTJiWFIwUVdNek1DSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5q
b2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRv
d09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT092tuxaiKjtw8=
'/*!*/;
# at 29266
#260922  8:37:30 server id 1  end_log_pos 29297 CRC32 0x5feff74c 	Xid = 1427
COMMIT/*!*/;
# at 29297
#260922  8:50:29 server id 1  end_log_pos 29376 CRC32 0x9bf7a397 	Anonymous_GTID	last_committed=23	sequence_number=24	rbr_only=yes	original_committed_timestamp=1790041829798230	immediate_commit_timestamp=1790041829798230	transaction_length=1474
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041829798230 (2026-09-22 08:50:29.798230 SE Asia Standard Time)
# immediate_commit_timestamp=1790041829798230 (2026-09-22 08:50:29.798230 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041829798230*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 29376
#260922  8:50:29 server id 1  end_log_pos 29466 CRC32 0xc2f0031c 	Query	thread_id=28	exec_time=0	error_code=0
SET TIMESTAMP=1790041829/*!*/;
BEGIN
/*!*/;
# at 29466
#260922  8:50:29 server id 1  end_log_pos 29540 CRC32 0x3e1b383d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 29540
#260922  8:50:29 server id 1  end_log_pos 30740 CRC32 0x08d74b53 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
5d6xahMBAAAASgAAAGRzAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4D04Gz4=
5d6xah8BAAAAsAQAABR4AAAAAFMAAAAAAAEAAgAG//8AKABJT0hkYXJ4UW1IRXpScmJaakt4N3ZG
RHJXeFNCcXVRMk9DVGxJdEdxBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2labVJFYmt3NVpXYzFabVJrUVZSVVpIUmhUbG80ZVVvMWVUVlhjbU13TkdN
MmJYUjBRV016TUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3a27FqACgASU9IZGFyeFFtSEV6UnJiWmpL
eDd2RkRyV3hTQnF1UTJPQ1RsSXRHcQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2mAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pWm1SRWJrdzVaV2MxWm1Sa1FWUlVaSFJoVGxvNGVVbzFlVFZYY21N
d05HTTJiWFIwUVdNek1DSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5ERTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTloWTNScGRtbDBl
UzFzYjJkeklqdHpPalU2SW5KdmRYUmxJanR6T2pJMU9pSmhaRzFwYmk1aFkzUnBkbWwwZVMxc2Iy
ZHpMbWx1WkdWNElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURw
N2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZr
WkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OeXesWpT
S9cI
'/*!*/;
# at 30740
#260922  8:50:29 server id 1  end_log_pos 30771 CRC32 0x7d604a78 	Xid = 1535
COMMIT/*!*/;
# at 30771
#260922  8:51:08 server id 1  end_log_pos 30850 CRC32 0xd99eb704 	Anonymous_GTID	last_committed=24	sequence_number=25	rbr_only=yes	original_committed_timestamp=1790041868019412	immediate_commit_timestamp=1790041868019412	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041868019412 (2026-09-22 08:51:08.019412 SE Asia Standard Time)
# immediate_commit_timestamp=1790041868019412 (2026-09-22 08:51:08.019412 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041868019412*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30850
#260922  8:51:08 server id 1  end_log_pos 30940 CRC32 0x0e850da3 	Query	thread_id=29	exec_time=0	error_code=0
SET TIMESTAMP=1790041868/*!*/;
BEGIN
/*!*/;
# at 30940
#260922  8:51:08 server id 1  end_log_pos 31014 CRC32 0xc6d7e3a4 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 31014
#260922  8:51:08 server id 1  end_log_pos 32230 CRC32 0xcfc1fdd1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
DN+xahMBAAAASgAAACZ5AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KTj18Y=
DN+xah8BAAAAwAQAAOZ9AAAAAFMAAAAAAAEAAgAG//8AKABJT0hkYXJ4UW1IRXpScmJaakt4N3ZG
RHJXeFNCcXVRMk9DVGxJdEdxBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2labVJFYmt3NVpXYzFabVJrUVZSVVpIUmhUbG80ZVVvMWVUVlhjbU13TkdN
MmJYUjBRV016TUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhZM1JwZG1sMGVTMXNi
MmR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoWTNScGRtbDBlUzFzYjJkekxt
bHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ55d6xagAoAElP
SGRhcnhRbUhFelJyYlpqS3g3dkZEcld4U0JxdVEyT0NUbEl0R3EEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVptUkVia3c1WldjMVptUmtRVlJVWkhS
aFRsbzRlVW8xZVRWWGNtTXdOR00yYlhSMFFXTXpNQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2
TWpwN2N6b3pPaUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWha
RzFwYmk5aFkzUnBkbWwwZVMxc2IyZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJp
NWhZM1JwZG1sMGVTMXNiMmR6TG1sdVpHVjRJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pv
ek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkM37Fq0f3Bzw==
'/*!*/;
# at 32230
#260922  8:51:08 server id 1  end_log_pos 32261 CRC32 0xdfdcfcb9 	Xid = 1643
COMMIT/*!*/;
# at 32261
#260922  8:51:16 server id 1  end_log_pos 32340 CRC32 0x59c0b466 	Anonymous_GTID	last_committed=25	sequence_number=26	rbr_only=yes	original_committed_timestamp=1790041876122560	immediate_commit_timestamp=1790041876122560	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041876122560 (2026-09-22 08:51:16.122560 SE Asia Standard Time)
# immediate_commit_timestamp=1790041876122560 (2026-09-22 08:51:16.122560 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041876122560*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 32340
#260922  8:51:16 server id 1  end_log_pos 32430 CRC32 0x98493ec9 	Query	thread_id=30	exec_time=0	error_code=0
SET TIMESTAMP=1790041876/*!*/;
BEGIN
/*!*/;
# at 32430
#260922  8:51:16 server id 1  end_log_pos 32504 CRC32 0x1ead169a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 32504
#260922  8:51:16 server id 1  end_log_pos 33720 CRC32 0x0dba23e6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
FN+xahMBAAAASgAAAPh+AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JoWrR4=
FN+xah8BAAAAwAQAALiDAAAAAFMAAAAAAAEAAgAG//8AKABJT0hkYXJ4UW1IRXpScmJaakt4N3ZG
RHJXeFNCcXVRMk9DVGxJdEdxBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2labVJFYmt3NVpXYzFabVJrUVZSVVpIUmhUbG80ZVVvMWVUVlhjbU13TkdN
MmJYUjBRV016TUNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWhZM1JwZG1sMGVTMXNi
MmR6SWp0ek9qVTZJbkp2ZFhSbElqdHpPakkxT2lKaFpHMXBiaTVoWTNScGRtbDBlUzFzYjJkekxt
bHVaR1Y0SWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5DN+xagAoAElP
SGRhcnhRbUhFelJyYlpqS3g3dkZEcld4U0JxdVEyT0NUbEl0R3EEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVptUkVia3c1WldjMVptUmtRVlJVWkhS
aFRsbzRlVW8xZVRWWGNtTXdOR00yYlhSMFFXTXpNQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2
TWpwN2N6b3pPaUoxY213aU8zTTZOREU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWha
RzFwYmk5aFkzUnBkbWwwZVMxc2IyZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJp
NWhZM1JwZG1sMGVTMXNiMmR6TG1sdVpHVjRJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pv
ek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVm
ZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRP
V1FpTzJrNk5EdDkU37Fq5iO6DQ==
'/*!*/;
# at 33720
#260922  8:51:16 server id 1  end_log_pos 33751 CRC32 0x5b6ccb64 	Xid = 1820
COMMIT/*!*/;
# at 33751
#260922  8:51:22 server id 1  end_log_pos 33830 CRC32 0xb5dd1a81 	Anonymous_GTID	last_committed=26	sequence_number=27	rbr_only=yes	original_committed_timestamp=1790041882427583	immediate_commit_timestamp=1790041882427583	transaction_length=714
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041882427583 (2026-09-22 08:51:22.427583 SE Asia Standard Time)
# immediate_commit_timestamp=1790041882427583 (2026-09-22 08:51:22.427583 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041882427583*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 33830
#260922  8:51:22 server id 1  end_log_pos 33922 CRC32 0x36ebdceb 	Query	thread_id=31	exec_time=0	error_code=0
SET TIMESTAMP=1790041882/*!*/;
BEGIN
/*!*/;
# at 33922
#260922  8:51:22 server id 1  end_log_pos 34010 CRC32 0xc1c5c5f9 	Table_map: `pln_up_imy`.`users` mapped to number 91
# at 34010
#260922  8:51:22 server id 1  end_log_pos 34434 CRC32 0x3da72ffa 	Update_rows: table id 91 flags: STMT_END_F

BINLOG '
Gt+xahMBAAAAWAAAANqEAAAAAFsAAAAAAAMACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHg+cXFwQ==
Gt+xah8BAAAAqAEAAIKGAAAAAFsAAAAAAAEAAgAM/////8AABAAAAAAAAAAFAEFkbWluDwBhZG1p
bkBnbWFpbC5jb20NAEFkbWluaXN0cmF0b3Jqpu8iPAAkMnkkMTIkT2N3UVlua0NzVEpvQVZ5SENH
VUFITzgvTm9kaWNDZGJObk1NU1Z1Z1JvMEhUdVlWaC9JRGk8AFUwTm41WjZDemRrZ0FBUTRTV2Vm
U1djSm5IczJEUFZ1OG15U3VubkczVlZVbTU2NUYxSFppelQ0SkVBbGqm7yJqqJFFAQAAAAAAAADA
AAQAAAAAAAAABQBBZG1pbg8AYWRtaW5AZ21haWwuY29tDQBBZG1pbmlzdHJhdG9yaqbvIjwAJDJ5
JDEyJE9jd1FZbmtDc1RKb0FWeUhDR1VBSE84L05vZGljQ2RiTm5NTVNWdWdSbzBIVHVZVmgvSURp
PABIbDlpbDhKTU1NV3NBazljSTIzMjFhdk1ESXluZFRJTVZCcFpXUTYzRWtraVZHZFVYUUhPZVE0
MDdrbldqpu8iaqiRRQEAAAAAAAAA+i+nPQ==
'/*!*/;
# at 34434
#260922  8:51:22 server id 1  end_log_pos 34465 CRC32 0x2bb2564e 	Xid = 1832
COMMIT/*!*/;
# at 34465
#260922  8:51:22 server id 1  end_log_pos 34544 CRC32 0xdf2b2921 	Anonymous_GTID	last_committed=27	sequence_number=28	rbr_only=yes	original_committed_timestamp=1790041882560537	immediate_commit_timestamp=1790041882560537	transaction_length=890
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041882560537 (2026-09-22 08:51:22.560537 SE Asia Standard Time)
# immediate_commit_timestamp=1790041882560537 (2026-09-22 08:51:22.560537 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041882560537*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 34544
#260922  8:51:22 server id 1  end_log_pos 34625 CRC32 0x1befefbb 	Query	thread_id=31	exec_time=0	error_code=0
SET TIMESTAMP=1790041882/*!*/;
BEGIN
/*!*/;
# at 34625
#260922  8:51:22 server id 1  end_log_pos 34699 CRC32 0x1d6c2da0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 34699
#260922  8:51:22 server id 1  end_log_pos 35324 CRC32 0x6ef892af 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
Gt+xahMBAAAASgAAAIuHAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4KAtbB0=
Gt+xaiABAAAAcQIAAPyJAAAAAFMAAAAAAAEAAgAG/wAoAElPSGRhcnhRbUhFelJyYlpqS3g3dkZE
cld4U0JxdVEyT0NUbEl0R3EEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNpgBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaVptUkVia3c1WldjMVptUmtRVlJVWkhSaFRsbzRlVW8xZVRWWGNtTXdOR00y
YlhSMFFXTXpNQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZO
REU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5aFkzUnBkbWwwZVMxc2Iy
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qSTFPaUpoWkcxcGJpNWhZM1JwZG1sMGVTMXNiMmR6TG1s
dVpHVjRJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02
TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZ
akptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDkU37Fqr5L4bg==
'/*!*/;
# at 35324
#260922  8:51:22 server id 1  end_log_pos 35355 CRC32 0xc515999b 	Xid = 1835
COMMIT/*!*/;
# at 35355
#260922  8:51:22 server id 1  end_log_pos 35434 CRC32 0x77bfaa2c 	Anonymous_GTID	last_committed=28	sequence_number=29	rbr_only=yes	original_committed_timestamp=1790041882583030	immediate_commit_timestamp=1790041882583030	transaction_length=634
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041882583030 (2026-09-22 08:51:22.583030 SE Asia Standard Time)
# immediate_commit_timestamp=1790041882583030 (2026-09-22 08:51:22.583030 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041882583030*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 35434
#260922  8:51:22 server id 1  end_log_pos 35515 CRC32 0x18c8258f 	Query	thread_id=31	exec_time=0	error_code=0
SET TIMESTAMP=1790041882/*!*/;
BEGIN
/*!*/;
# at 35515
#260922  8:51:22 server id 1  end_log_pos 35589 CRC32 0xf24a88f7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 35589
#260922  8:51:22 server id 1  end_log_pos 35958 CRC32 0xd8b8d024 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
Gt+xahMBAAAASgAAAAWLAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PeISvI=
Gt+xah4BAAAAcQEAAHaMAAAAAFMAAAAAAAEAAgAG/wIoAFpGdEFWTkxGWTdSQWM4ZTJxcTlnUGE2
OGZ4Q3RJMzl6U3JlNGtNZVUJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzagAAAAWVRveU9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lXSFZqYVZoc1kwMU5aWFZ5TWtKcWJISlNVMWN3ZWxaeWFsVjFPR1prV2xZMWRqRlVjMEkw
UXlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5ZlE9PRrfsWok0LjY
'/*!*/;
# at 35958
#260922  8:51:22 server id 1  end_log_pos 35989 CRC32 0xc063d1c7 	Xid = 1841
COMMIT/*!*/;
# at 35989
#260922  8:51:23 server id 1  end_log_pos 36068 CRC32 0x7bca45eb 	Anonymous_GTID	last_committed=29	sequence_number=30	rbr_only=yes	original_committed_timestamp=1790041883565929	immediate_commit_timestamp=1790041883565929	transaction_length=1090
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041883565929 (2026-09-22 08:51:23.565929 SE Asia Standard Time)
# immediate_commit_timestamp=1790041883565929 (2026-09-22 08:51:23.565929 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041883565929*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 36068
#260922  8:51:23 server id 1  end_log_pos 36158 CRC32 0x7fe0e4ca 	Query	thread_id=32	exec_time=0	error_code=0
SET TIMESTAMP=1790041883/*!*/;
BEGIN
/*!*/;
# at 36158
#260922  8:51:23 server id 1  end_log_pos 36232 CRC32 0xba77da71 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 36232
#260922  8:51:23 server id 1  end_log_pos 37048 CRC32 0x6684a42b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
G9+xahMBAAAASgAAAIiNAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HHad7o=
G9+xah8BAAAAMAMAALiQAAAAAFMAAAAAAAEAAgAG//8CKABaRnRBVk5MRlk3UkFjOGUycXE5Z1Bh
NjhmeEN0STM5elNyZTRrTWVVCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2oAAAAFlUb3lPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV0hWamFWaHNZMDFOWlhWeU1rSnFiSEpTVTFjd2VsWnlhbFYxT0daa1dsWTFkakZVYzBJ
MFF5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWZRPT0a37FqAigAWkZ0QVZOTEZZN1JBYzhlMnFxOWdQYTY4ZnhDdEkz
OXpTcmU0a01lVQkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNhABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVdI
VmphVmhzWTAxTlpYVnlNa0pxYkhKU1UxY3dlbFp5YWxWMU9HWmtXbFkxZGpGVWMwSTBReUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2Iy
MWxJanQ5ZlE9PRvfsWorpIRm
'/*!*/;
# at 37048
#260922  8:51:23 server id 1  end_log_pos 37079 CRC32 0x28c9096b 	Xid = 1898
COMMIT/*!*/;
# at 37079
#260922  8:51:28 server id 1  end_log_pos 37158 CRC32 0x16975375 	Anonymous_GTID	last_committed=30	sequence_number=31	rbr_only=yes	original_committed_timestamp=1790041888916730	immediate_commit_timestamp=1790041888916730	transaction_length=1218
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041888916730 (2026-09-22 08:51:28.916730 SE Asia Standard Time)
# immediate_commit_timestamp=1790041888916730 (2026-09-22 08:51:28.916730 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041888916730*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 37158
#260922  8:51:28 server id 1  end_log_pos 37248 CRC32 0xb7ee9ad7 	Query	thread_id=33	exec_time=0	error_code=0
SET TIMESTAMP=1790041888/*!*/;
BEGIN
/*!*/;
# at 37248
#260922  8:51:28 server id 1  end_log_pos 37322 CRC32 0xa3db2ad7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 37322
#260922  8:51:28 server id 1  end_log_pos 38266 CRC32 0x69056ca7 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
IN+xahMBAAAASgAAAMqRAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ncq26M=
IN+xah8BAAAAsAMAAHqVAAAAAFMAAAAAAAEAAgAG//8CKABaRnRBVk5MRlk3UkFjOGUycXE5Z1Bh
NjhmeEN0STM5elNyZTRrTWVVCTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2EAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pV0hWamFWaHNZMDFOWlhWeU1rSnFiSEpTVTFjd2VsWnlhbFYxT0daa1dsWTFkakZVYzBJ
MFF5STdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9p
Ym1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lP
M002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6
bzBPaUpvYjIxbElqdDlmUT09G9+xagIoAFpGdEFWTkxGWTdSQWM4ZTJxcTlnUGE2OGZ4Q3RJMzl6
U3JlNGtNZVUJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsg
eDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAu
MC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXSFZq
YVZoc1kwMU5aWFZ5TWtKcWJISlNVMWN3ZWxaeWFsVjFPR1prV2xZMWRqRlVjMEkwUXlJN2N6bzJP
aUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9q
QTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNek02SW1o
MGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9pSnliM1Yw
WlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9IN+xaqdsBWk=
'/*!*/;
# at 38266
#260922  8:51:28 server id 1  end_log_pos 38297 CRC32 0x49a642a3 	Xid = 1955
COMMIT/*!*/;
# at 38297
#260922  8:51:48 server id 1  end_log_pos 38376 CRC32 0xc38a3fab 	Anonymous_GTID	last_committed=31	sequence_number=32	rbr_only=yes	original_committed_timestamp=1790041908833034	immediate_commit_timestamp=1790041908833034	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041908833034 (2026-09-22 08:51:48.833034 SE Asia Standard Time)
# immediate_commit_timestamp=1790041908833034 (2026-09-22 08:51:48.833034 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041908833034*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 38376
#260922  8:51:48 server id 1  end_log_pos 38457 CRC32 0x4d364d1d 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1790041908/*!*/;
BEGIN
/*!*/;
# at 38457
#260922  8:51:48 server id 1  end_log_pos 38531 CRC32 0x9a10e469 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 38531
#260922  8:51:48 server id 1  end_log_pos 39028 CRC32 0x77fd6b34 	Delete_rows: table id 83 flags: STMT_END_F

BINLOG '
NN+xahMBAAAASgAAAIOWAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GnkEJo=
NN+xaiABAAAA8QEAAHSYAAAAAFMAAAAAAAEAAgAG/wIoAFpGdEFWTkxGWTdSQWM4ZTJxcTlnUGE2
OGZ4Q3RJMzl6U3JlNGtNZVUJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lXSFZqYVZoc1kwMU5aWFZ5TWtKcWJISlNVMWN3ZWxaeWFsVjFPR1prV2xZMWRqRlVjMEkw
UXlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2li
bVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8z
TTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pv
MU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWDA9IN+xajRr/Xc=
'/*!*/;
# at 39028
#260922  8:51:48 server id 1  end_log_pos 39059 CRC32 0xb4272d19 	Xid = 1967
COMMIT/*!*/;
# at 39059
#260922  8:51:48 server id 1  end_log_pos 39138 CRC32 0x01a57163 	Anonymous_GTID	last_committed=32	sequence_number=33	rbr_only=yes	original_committed_timestamp=1790041908942515	immediate_commit_timestamp=1790041908942515	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041908942515 (2026-09-22 08:51:48.942515 SE Asia Standard Time)
# immediate_commit_timestamp=1790041908942515 (2026-09-22 08:51:48.942515 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041908942515*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 39138
#260922  8:51:48 server id 1  end_log_pos 39219 CRC32 0xaac3272e 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1790041908/*!*/;
BEGIN
/*!*/;
# at 39219
#260922  8:51:48 server id 1  end_log_pos 39293 CRC32 0x3dec9301 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 39293
#260922  8:51:48 server id 1  end_log_pos 39882 CRC32 0xb19b7952 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
NN+xahMBAAAASgAAAH2ZAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AGT7D0=
NN+xah4BAAAATQIAAMqbAAAAAFMAAAAAAAEAAgAG/wAoAEZpalFXWExuOVNzeVB4RTVsZEZMb3pM
ZjlQMzYwemZYOGswMElUWVILAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaWRXdzNUbVpVVUVaTlVrbzFNVTFXY0ZBMVJXWmtZVE52VURKVlJFSlJiVmd5
YVdzM2NtUTNUaUk3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdm
WE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJk
cGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pFeE8zMD0037FqUnmbsQ==
'/*!*/;
# at 39882
#260922  8:51:48 server id 1  end_log_pos 39913 CRC32 0xf4d49a80 	Xid = 1985
COMMIT/*!*/;
# at 39913
#260922  8:51:50 server id 1  end_log_pos 39992 CRC32 0x6d84046c 	Anonymous_GTID	last_committed=33	sequence_number=34	rbr_only=yes	original_committed_timestamp=1790041910445277	immediate_commit_timestamp=1790041910445277	transaction_length=1446
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041910445277 (2026-09-22 08:51:50.445277 SE Asia Standard Time)
# immediate_commit_timestamp=1790041910445277 (2026-09-22 08:51:50.445277 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041910445277*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 39992
#260922  8:51:50 server id 1  end_log_pos 40082 CRC32 0xc1242ae0 	Query	thread_id=35	exec_time=0	error_code=0
SET TIMESTAMP=1790041910/*!*/;
BEGIN
/*!*/;
# at 40082
#260922  8:51:50 server id 1  end_log_pos 40156 CRC32 0xbc8127f1 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 40156
#260922  8:51:50 server id 1  end_log_pos 41328 CRC32 0xf2859fac 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Nt+xahMBAAAASgAAANycAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PEngbw=
Nt+xah8BAAAAlAQAAHChAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2Iy
ZHBiaUk3Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qRXhPMzA9NN+xagAoAEZpalFXWExuOVNzeVB4RTVsZEZMb3pMZjlQMzYwemZYOGswMElU
WVILAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMu
MC4wLjAgU2FmYXJpLzUzNy4zNpABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRX
dzNUbVpVVUVaTlVrbzFNVTFXY0ZBMVJXWmtZVE52VURKVlJFSlJiVmd5YVdzM2NtUTNUaUk3Y3pv
Mk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRo
T2pBNmUzMTljem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5EQTZJ
bWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5cllYSjVZWGRoYmk5a1lYTm9ZbTloY21RaU8z
TTZOVG9pY205MWRHVWlPM002TVRnNkltdGhjbmxoZDJGdUxtUmhjMmhpYjJGeVpDSTdmWE02TlRB
NklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhs
WVRSbE16QTVPRGxrSWp0cE9qRXhPMzA9Nt+xaqyfhfI=
'/*!*/;
# at 41328
#260922  8:51:50 server id 1  end_log_pos 41359 CRC32 0x09c4c08d 	Xid = 2015
COMMIT/*!*/;
# at 41359
#260922  8:52:08 server id 1  end_log_pos 41438 CRC32 0x0564739c 	Anonymous_GTID	last_committed=34	sequence_number=35	rbr_only=yes	original_committed_timestamp=1790041928387055	immediate_commit_timestamp=1790041928387055	transaction_length=1430
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041928387055 (2026-09-22 08:52:08.387055 SE Asia Standard Time)
# immediate_commit_timestamp=1790041928387055 (2026-09-22 08:52:08.387055 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041928387055*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 41438
#260922  8:52:08 server id 1  end_log_pos 41528 CRC32 0xf048d4b9 	Query	thread_id=36	exec_time=0	error_code=0
SET TIMESTAMP=1790041928/*!*/;
BEGIN
/*!*/;
# at 41528
#260922  8:52:08 server id 1  end_log_pos 41602 CRC32 0xbea8fcb3 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 41602
#260922  8:52:08 server id 1  end_log_pos 42758 CRC32 0xe479fa90 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
SN+xahMBAAAASgAAAIKiAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LP8qL4=
SN+xah8BAAAAhAQAAAanAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaQAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXJZWEo1WVhkaGJp
OWtZWE5vWW05aGNtUWlPM002TlRvaWNtOTFkR1VpTzNNNk1UZzZJbXRoY25saGQyRnVMbVJoYzJo
aWIyRnlaQ0k3ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUx
T0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPakV4TzMwPTbfsWoAKABGaWpRV1hMbjlT
c3lQeEU1bGRGTG96TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxh
LzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtI
VE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9u
dHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVRO
dlVESlZSRUpSYlZneWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2
YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlP
MkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01D
STdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpV
NVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2
TVRFN2ZRPT1I37FqkPp55A==
'/*!*/;
# at 42758
#260922  8:52:08 server id 1  end_log_pos 42789 CRC32 0x0340b672 	Xid = 2075
COMMIT/*!*/;
# at 42789
#260922  8:52:17 server id 1  end_log_pos 42868 CRC32 0x29c92f12 	Anonymous_GTID	last_committed=35	sequence_number=36	rbr_only=yes	original_committed_timestamp=1790041937281727	immediate_commit_timestamp=1790041937281727	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041937281727 (2026-09-22 08:52:17.281727 SE Asia Standard Time)
# immediate_commit_timestamp=1790041937281727 (2026-09-22 08:52:17.281727 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041937281727*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 42868
#260922  8:52:17 server id 1  end_log_pos 42958 CRC32 0x2a783cc5 	Query	thread_id=37	exec_time=0	error_code=0
SET TIMESTAMP=1790041937/*!*/;
BEGIN
/*!*/;
# at 42958
#260922  8:52:17 server id 1  end_log_pos 43032 CRC32 0x46773c00 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 43032
#260922  8:52:17 server id 1  end_log_pos 44176 CRC32 0x2602aa20 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
Ud+xahMBAAAASgAAABioAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AA8d0Y=
Ud+xah8BAAAAeAQAAJCsAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT1I37Fq
ACgARmlqUVdYTG45U3N5UHhFNWxkRkxvekxmOVAzNjB6Zlg4azAwSVRZUgsAAAAAAAAACTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pZFd3M1RtWlVVRVpOVWtvMU1V
MVdjRkExUldaa1lUTnZVREpWUkVKUmJWZ3lhV3MzY21RM1RpSTdjem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpm
Y0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TkRJNkltaDBkSEE2THk4eE1qY3VN
QzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmMyVnFZWEpoYUNJN2N6bzFPaUp5YjNWMFpT
STdjem8zT2lKelpXcGhjbUZvSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT1R37Fq
IKoCJg==
'/*!*/;
# at 44176
#260922  8:52:17 server id 1  end_log_pos 44207 CRC32 0x39858d94 	Xid = 2135
COMMIT/*!*/;
# at 44207
#260922  8:52:23 server id 1  end_log_pos 44286 CRC32 0xe155ae96 	Anonymous_GTID	last_committed=36	sequence_number=37	rbr_only=yes	original_committed_timestamp=1790041943928500	immediate_commit_timestamp=1790041943928500	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041943928500 (2026-09-22 08:52:23.928500 SE Asia Standard Time)
# immediate_commit_timestamp=1790041943928500 (2026-09-22 08:52:23.928500 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041943928500*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 44286
#260922  8:52:23 server id 1  end_log_pos 44376 CRC32 0x0ef80618 	Query	thread_id=38	exec_time=0	error_code=0
SET TIMESTAMP=1790041943/*!*/;
BEGIN
/*!*/;
# at 44376
#260922  8:52:23 server id 1  end_log_pos 44450 CRC32 0xc486aa90 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 44450
#260922  8:52:23 server id 1  end_log_pos 45630 CRC32 0xb249c74e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
V9+xahMBAAAASgAAAKKtAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JCqhsQ=
V9+xah8BAAAAnAQAAD6yAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOREk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2YzJWcVlYSmhhQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzNPaUp6WldwaGNtRm9JanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZNVEU3ZlE9PVHfsWoAKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZORFE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2ZG1semFTMXRhWE5wSWp0ek9qVTZJbkp2ZFhSbElqdHpPams2SW5acGMya3RiV2x6YVNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD1X37FqTsdJsg==
'/*!*/;
# at 45630
#260922  8:52:23 server id 1  end_log_pos 45661 CRC32 0xbda3abfe 	Xid = 2195
COMMIT/*!*/;
# at 45661
#260922  8:52:46 server id 1  end_log_pos 45740 CRC32 0x892d1b9e 	Anonymous_GTID	last_committed=37	sequence_number=38	rbr_only=yes	original_committed_timestamp=1790041966848514	immediate_commit_timestamp=1790041966848514	transaction_length=908
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041966848514 (2026-09-22 08:52:46.848514 SE Asia Standard Time)
# immediate_commit_timestamp=1790041966848514 (2026-09-22 08:52:46.848514 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041966848514*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 45740
#260922  8:52:46 server id 1  end_log_pos 45821 CRC32 0x9277c116 	Query	thread_id=39	exec_time=0	error_code=0
SET TIMESTAMP=1790041966/*!*/;
BEGIN
/*!*/;
# at 45821
#260922  8:52:46 server id 1  end_log_pos 45895 CRC32 0x5f5278bb 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 45895
#260922  8:52:46 server id 1  end_log_pos 46538 CRC32 0xe8c9bd09 	Write_rows: table id 83 flags: STMT_END_F

BINLOG '
bt+xahMBAAAASgAAAEezAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Lt4Ul8=
bt+xah4BAAAAgwIAAMq1AAAAAFMAAAAAAAEAAgAG/wIoAEx1enlXOHZxdkVOZkd1ZGhLbGUwcHBa
WE9GSURtU0FkZUlmUllpbG4JMTI3LjAuMC4xfQBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzYgRWRnLzE1My4wLjAuMKQBAABZVG8wT250ek9qWTZJ
bDkwYjJ0bGJpSTdjem8wTURvaVRHaFBXRWxFVkc5RlpFaFhTRkJUZFRsaFVUVnVTR2hOY25OWmNF
MTBaVzgxYVZRNGNHUkZUQ0k3Y3pvek9pSjFjbXdpTzJFNk1UcDdjem80T2lKcGJuUmxibVJsWkNJ
N2N6bzBNRG9pYUhSMGNEb3ZMekV5Tnk0d0xqQXVNVG80TURBd0wydGhjbmxoZDJGdUwyUmhjMmhp
YjJGeVpDSTdmWE02T1RvaVgzQnlaWFpwYjNWeklqdGhPakk2ZTNNNk16b2lkWEpzSWp0ek9qUXdP
aUpvZEhSd09pOHZNVEkzTGpBdU1DNHhPamd3TURBdmEyRnllV0YzWVc0dlpHRnphR0p2WVhKa0lq
dHpPalU2SW5KdmRYUmxJanR6T2pFNE9pSnJZWEo1WVhkaGJpNWtZWE5vWW05aGNtUWlPMzF6T2pZ
NklsOW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2
TURwN2ZYMTlu37FqCb3J6A==
'/*!*/;
# at 46538
#260922  8:52:46 server id 1  end_log_pos 46569 CRC32 0xe8e5ac90 	Xid = 2207
COMMIT/*!*/;
# at 46569
#260922  8:52:47 server id 1  end_log_pos 46648 CRC32 0xa38db744 	Anonymous_GTID	last_committed=38	sequence_number=39	rbr_only=yes	original_committed_timestamp=1790041967577268	immediate_commit_timestamp=1790041967577268	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041967577268 (2026-09-22 08:52:47.577268 SE Asia Standard Time)
# immediate_commit_timestamp=1790041967577268 (2026-09-22 08:52:47.577268 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041967577268*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 46648
#260922  8:52:47 server id 1  end_log_pos 46738 CRC32 0x2d93ad7c 	Query	thread_id=40	exec_time=0	error_code=0
SET TIMESTAMP=1790041967/*!*/;
BEGIN
/*!*/;
# at 46738
#260922  8:52:47 server id 1  end_log_pos 46812 CRC32 0x33f2d31d 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 46812
#260922  8:52:47 server id 1  end_log_pos 48036 CRC32 0xb5d1a860 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
b9+xahMBAAAASgAAANy2AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4B3T8jM=
b9+xah8BAAAAyAQAAKS7AAAAAFMAAAAAAAEAAgAG//8CKABMdXp5Vzh2cXZFTmZHdWRoS2xlMHBw
WlhPRklEbVNBZGVJZlJZaWxuCTEyNy4wLjAuMX0ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2IEVkZy8xNTMuMC4wLjCkAQAAWVRvME9udHpPalk2
SWw5MGIydGxiaUk3Y3pvME1Eb2lUR2hQV0VsRVZHOUZaRWhYU0ZCVGRUbGhVVFZ1U0doTmNuTlpj
RTEwWlc4MWFWUTRjR1JGVENJN2N6b3pPaUoxY213aU8yRTZNVHA3Y3pvNE9pSnBiblJsYm1SbFpD
STdjem8wTURvaWFIUjBjRG92THpFeU55NHdMakF1TVRvNE1EQXdMMnRoY25saGQyRnVMMlJoYzJo
aWIyRnlaQ0k3ZlhNNk9Ub2lYM0J5WlhacGIzVnpJanRoT2pJNmUzTTZNem9pZFhKc0lqdHpPalF3
T2lKb2RIUndPaTh2TVRJM0xqQXVNQzR4T2pnd01EQXZhMkZ5ZVdGM1lXNHZaR0Z6YUdKdllYSmtJ
anR6T2pVNkluSnZkWFJsSWp0ek9qRTRPaUpyWVhKNVlYZGhiaTVrWVhOb1ltOWhjbVFpTzMxek9q
WTZJbDltYkdGemFDSTdZVG95T250ek9qTTZJbTlzWkNJN1lUb3dPbnQ5Y3pvek9pSnVaWGNpTzJF
Nk1EcDdmWDE5bt+xagIoAEx1enlXOHZxdkVOZkd1ZGhLbGUwcHBaWE9GSURtU0FkZUlmUllpbG4J
MTI3LjAuMC4xfQBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBs
ZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFy
aS81MzcuMzYgRWRnLzE1My4wLjAuMIgBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURv
aVRHaFBXRWxFVkc5RlpFaFhTRkJUZFRsaFVUVnVTR2hOY25OWmNFMTBaVzgxYVZRNGNHUkZUQ0k3
Y3pvek9pSjFjbXdpTzJFNk1UcDdjem80T2lKcGJuUmxibVJsWkNJN2N6bzBNRG9pYUhSMGNEb3ZM
ekV5Tnk0d0xqQXVNVG80TURBd0wydGhjbmxoZDJGdUwyUmhjMmhpYjJGeVpDSTdmWE02T1RvaVgz
QnlaWFpwYjNWeklqdGhPakk2ZTNNNk16b2lkWEpzSWp0ek9qTXpPaUpvZEhSd09pOHZNVEkzTGpB
dU1DNHhPamd3TURBdllXUnRhVzR2Ykc5bmFXNGlPM002TlRvaWNtOTFkR1VpTzNNNk5Ub2liRzlu
YVc0aU8zMXpPalk2SWw5bWJHRnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6b3pP
aUp1WlhjaU8yRTZNRHA3ZlgxOW/fsWpgqNG1
'/*!*/;
# at 48036
#260922  8:52:47 server id 1  end_log_pos 48067 CRC32 0x4084d2d6 	Xid = 2264
COMMIT/*!*/;
# at 48067
#260922  8:52:52 server id 1  end_log_pos 48146 CRC32 0xa33b9a6d 	Anonymous_GTID	last_committed=39	sequence_number=40	rbr_only=yes	original_committed_timestamp=1790041972680515	immediate_commit_timestamp=1790041972680515	transaction_length=1454
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041972680515 (2026-09-22 08:52:52.680515 SE Asia Standard Time)
# immediate_commit_timestamp=1790041972680515 (2026-09-22 08:52:52.680515 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041972680515*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 48146
#260922  8:52:52 server id 1  end_log_pos 48236 CRC32 0x46c3e7e8 	Query	thread_id=41	exec_time=0	error_code=0
SET TIMESTAMP=1790041972/*!*/;
BEGIN
/*!*/;
# at 48236
#260922  8:52:52 server id 1  end_log_pos 48310 CRC32 0xf4f68ff5 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 48310
#260922  8:52:52 server id 1  end_log_pos 49490 CRC32 0xd500dd2e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
dN+xahMBAAAASgAAALa8AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PWP9vQ=
dN+xah8BAAAAnAQAAFLBAAAAAFMAAAAAAAEAAgAG//8CKABMdXp5Vzh2cXZFTmZHdWRoS2xlMHBw
WlhPRklEbVNBZGVJZlJZaWxuCTEyNy4wLjAuMX0ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2IEVkZy8xNTMuMC4wLjCIAQAAWVRvME9udHpPalk2
SWw5MGIydGxiaUk3Y3pvME1Eb2lUR2hQV0VsRVZHOUZaRWhYU0ZCVGRUbGhVVFZ1U0doTmNuTlpj
RTEwWlc4MWFWUTRjR1JGVENJN2N6b3pPaUoxY213aU8yRTZNVHA3Y3pvNE9pSnBiblJsYm1SbFpD
STdjem8wTURvaWFIUjBjRG92THpFeU55NHdMakF1TVRvNE1EQXdMMnRoY25saGQyRnVMMlJoYzJo
aWIyRnlaQ0k3ZlhNNk9Ub2lYM0J5WlhacGIzVnpJanRoT2pJNmUzTTZNem9pZFhKc0lqdHpPak16
T2lKb2RIUndPaTh2TVRJM0xqQXVNQzR4T2pnd01EQXZZV1J0YVc0dmJHOW5hVzRpTzNNNk5Ub2lj
bTkxZEdVaU8zTTZOVG9pYkc5bmFXNGlPMzF6T2pZNklsOW1iR0Z6YUNJN1lUb3lPbnR6T2pNNklt
OXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURwN2ZYMTlv37FqAigATHV6eVc4dnF2RU5m
R3VkaEtsZTBwcFpYT0ZJRG1TQWRlSWZSWWlsbgkxMjcuMC4wLjF9AE1vemlsbGEvNS4wIChXaW5k
b3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2Ug
R2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2FmYXJpLzUzNy4zNiBFZGcvMTUzLjAuMC4weAEAAFlU
bzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pVEdoUFdFbEVWRzlGWkVoWFNGQlRkVGxoVVRW
dVNHaE5jbk5aY0UxMFpXODFhVlE0Y0dSRlRDSTdjem96T2lKMWNtd2lPMkU2TVRwN2N6bzRPaUpw
Ym5SbGJtUmxaQ0k3Y3pvME1Eb2lhSFIwY0Rvdkx6RXlOeTR3TGpBdU1UbzRNREF3TDJ0aGNubGhk
MkZ1TDJSaGMyaGliMkZ5WkNJN2ZYTTZPVG9pWDNCeVpYWnBiM1Z6SWp0aE9qSTZlM002TXpvaWRY
SnNJanR6T2pJeE9pSm9kSFJ3T2k4dk1USTNMakF1TUM0eE9qZ3dNREFpTzNNNk5Ub2ljbTkxZEdV
aU8zTTZORG9pYUc5dFpTSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRo
T2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYMD1037FqLt0A1Q==
'/*!*/;
# at 49490
#260922  8:52:52 server id 1  end_log_pos 49521 CRC32 0xe518a03b 	Xid = 2321
COMMIT/*!*/;
# at 49521
#260922  8:53:09 server id 1  end_log_pos 49600 CRC32 0xe74fa7e5 	Anonymous_GTID	last_committed=40	sequence_number=41	rbr_only=yes	original_committed_timestamp=1790041989147951	immediate_commit_timestamp=1790041989147951	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790041989147951 (2026-09-22 08:53:09.147951 SE Asia Standard Time)
# immediate_commit_timestamp=1790041989147951 (2026-09-22 08:53:09.147951 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790041989147951*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 49600
#260922  8:53:09 server id 1  end_log_pos 49690 CRC32 0x366a81c2 	Query	thread_id=42	exec_time=0	error_code=0
SET TIMESTAMP=1790041989/*!*/;
BEGIN
/*!*/;
# at 49690
#260922  8:53:09 server id 1  end_log_pos 49764 CRC32 0x23b3b0fd 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 49764
#260922  8:53:09 server id 1  end_log_pos 50988 CRC32 0xf910ddc5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
hd+xahMBAAAASgAAAGTCAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4P2wsyM=
hd+xah8BAAAAyAQAACzHAAAAAFMAAAAAAAEAAgAG//8CKABMdXp5Vzh2cXZFTmZHdWRoS2xlMHBw
WlhPRklEbVNBZGVJZlJZaWxuCTEyNy4wLjAuMX0ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2IEVkZy8xNTMuMC4wLjB4AQAAWVRvME9udHpPalk2
SWw5MGIydGxiaUk3Y3pvME1Eb2lUR2hQV0VsRVZHOUZaRWhYU0ZCVGRUbGhVVFZ1U0doTmNuTlpj
RTEwWlc4MWFWUTRjR1JGVENJN2N6b3pPaUoxY213aU8yRTZNVHA3Y3pvNE9pSnBiblJsYm1SbFpD
STdjem8wTURvaWFIUjBjRG92THpFeU55NHdMakF1TVRvNE1EQXdMMnRoY25saGQyRnVMMlJoYzJo
aWIyRnlaQ0k3ZlhNNk9Ub2lYM0J5WlhacGIzVnpJanRoT2pJNmUzTTZNem9pZFhKc0lqdHpPakl4
T2lKb2RIUndPaTh2TVRJM0xqQXVNQzR4T2pnd01EQWlPM002TlRvaWNtOTFkR1VpTzNNNk5Eb2lh
Rzl0WlNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9q
TTZJbTVsZHlJN1lUb3dPbnQ5ZlgwPXTfsWoCKABMdXp5Vzh2cXZFTmZHdWRoS2xlMHBwWlhPRklE
bVNBZGVJZlJZaWxuCTEyNy4wLjAuMX0ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2lu
NjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1
My4wLjAuMCBTYWZhcmkvNTM3LjM2IEVkZy8xNTMuMC4wLjC0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lUR2hQV0VsRVZHOUZaRWhYU0ZCVGRUbGhVVFZ1U0doTmNuTlpjRTEwWlc4
MWFWUTRjR1JGVENJN2N6b3pPaUoxY213aU8yRTZNVHA3Y3pvNE9pSnBiblJsYm1SbFpDSTdjem8w
TURvaWFIUjBjRG92THpFeU55NHdMakF1TVRvNE1EQXdMMnRoY25saGQyRnVMMlJoYzJoaWIyRnla
Q0k3ZlhNNk9Ub2lYM0J5WlhacGIzVnpJanRoT2pJNmUzTTZNem9pZFhKc0lqdHpPalV5T2lKb2RI
UndPaTh2TVRJM0xqQXVNQzR4T2pnd01EQXZkR1Z1ZEdGdVp5MXJZVzFwTDNCeWIyWnBiQzF3WlhK
MWMyRm9ZV0Z1SWp0ek9qVTZJbkp2ZFhSbElqdHpPakUzT2lKd2NtOW1hV3d0Y0dWeWRYTmhhR0Zo
YmlJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJ
bTVsZHlJN1lUb3dPbnQ5ZlgwPYXfsWrF3RD5
'/*!*/;
# at 50988
#260922  8:53:09 server id 1  end_log_pos 51019 CRC32 0x84d41399 	Xid = 2378
COMMIT/*!*/;
# at 51019
#260922  8:54:34 server id 1  end_log_pos 51098 CRC32 0xd80e7b9b 	Anonymous_GTID	last_committed=41	sequence_number=42	rbr_only=yes	original_committed_timestamp=1790042074198395	immediate_commit_timestamp=1790042074198395	transaction_length=1486
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042074198395 (2026-09-22 08:54:34.198395 SE Asia Standard Time)
# immediate_commit_timestamp=1790042074198395 (2026-09-22 08:54:34.198395 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042074198395*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 51098
#260922  8:54:34 server id 1  end_log_pos 51188 CRC32 0xdea6f32d 	Query	thread_id=43	exec_time=0	error_code=0
SET TIMESTAMP=1790042074/*!*/;
BEGIN
/*!*/;
# at 51188
#260922  8:54:34 server id 1  end_log_pos 51262 CRC32 0x9d7b34e4 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 51262
#260922  8:54:34 server id 1  end_log_pos 52474 CRC32 0x3072f350 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
2t+xahMBAAAASgAAAD7IAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OQ0e50=
2t+xah8BAAAAvAQAAPrMAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZORFE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2ZG1semFTMXRhWE5wSWp0ek9qVTZJbkp2ZFhSbElqdHpPams2SW5acGMya3RiV2x6YVNJ
N2ZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pFeE8zMD1X37FqACgARmlqUVdYTG45U3N5UHhFNWxk
RkxvekxmOVAzNjB6Zlg4azAwSVRZUgsAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3LjM2pAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pZFd3M1RtWlVVRVpOVWtvMU1VMVdjRkExUldaa1lUTnZVREpWUkVK
UmJWZ3lhV3MzY21RM1RpSTdjem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2
TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdj
em96T2lKMWNtd2lPM002TlRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlX
NW5MV3RoYldrdmMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdjem8xT2lKeWIzVjBaU0k3Y3pv
eE9Ub2ljM1J5ZFd0MGRYSXRiM0puWVc1cGMyRnphU0k3ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgx
T1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBP
akV4TzMwPdrfsWpQ83Iw
'/*!*/;
# at 52474
#260922  8:54:34 server id 1  end_log_pos 52505 CRC32 0xb967b8bb 	Xid = 2438
COMMIT/*!*/;
# at 52505
#260922  8:55:54 server id 1  end_log_pos 52584 CRC32 0xa8418142 	Anonymous_GTID	last_committed=42	sequence_number=43	rbr_only=yes	original_committed_timestamp=1790042154609749	immediate_commit_timestamp=1790042154609749	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042154609749 (2026-09-22 08:55:54.609749 SE Asia Standard Time)
# immediate_commit_timestamp=1790042154609749 (2026-09-22 08:55:54.609749 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042154609749*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 52584
#260922  8:55:54 server id 1  end_log_pos 52674 CRC32 0x221d53ef 	Query	thread_id=44	exec_time=0	error_code=0
SET TIMESTAMP=1790042154/*!*/;
BEGIN
/*!*/;
# at 52674
#260922  8:55:54 server id 1  end_log_pos 52748 CRC32 0x328a48e8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 52748
#260922  8:55:54 server id 1  end_log_pos 53924 CRC32 0xbde28a58 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
KuCxahMBAAAASgAAAAzOAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OhIijI=
KuCxah8BAAAAmAQAAKTSAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzakAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOVFE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2YzNSeWRXdDBkWEl0YjNKbllXNXBjMkZ6YVNJN2N6bzFPaUp5YjNWMFpTSTdjem94T1Rv
aWMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0po
TXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qRXhP
MzA92t+xagAoAEZpalFXWExuOVNzeVB4RTVsZEZMb3pMZjlQMzYwemZYOGswMElUWVILAAAAAAAA
AAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFw
cGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTMuMC4wLjAgU2Fm
YXJpLzUzNy4zNmQBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaWRXdzNUbVpVVUVa
TlVrbzFNVTFXY0ZBMVJXWmtZVE52VURKVlJFSlJiVmd5YVdzM2NtUTNUaUk3Y3pvMk9pSmZabXho
YzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTlj
em81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgwZEhBNkx5
OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJanQ5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZNVEU3ZlE9PSrgsWpYiuK9
'/*!*/;
# at 53924
#260922  8:55:54 server id 1  end_log_pos 53955 CRC32 0x87ed4275 	Xid = 2498
COMMIT/*!*/;
# at 53955
#260922  8:56:16 server id 1  end_log_pos 54032 CRC32 0x812d4370 	Anonymous_GTID	last_committed=43	sequence_number=44	rbr_only=no	original_committed_timestamp=1790042176444195	immediate_commit_timestamp=1790042176444195	transaction_length=240
# original_commit_timestamp=1790042176444195 (2026-09-22 08:56:16.444195 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176444195 (2026-09-22 08:56:16.444195 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176444195*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54032
#260922  8:56:16 server id 1  end_log_pos 54195 CRC32 0xb5a5190a 	Query	thread_id=45	exec_time=0	error_code=0	Xid = 2519
use `pln_up_imy`/*!*/;
SET TIMESTAMP=1790042176/*!*/;
SET @@session.pseudo_thread_id=45/*!*/;
DROP TABLE IF EXISTS `contact_messages` /* generated by server */
/*!*/;
# at 54195
#260922  8:56:16 server id 1  end_log_pos 54272 CRC32 0x7d4ec146 	Anonymous_GTID	last_committed=44	sequence_number=45	rbr_only=no	original_committed_timestamp=1790042176451435	immediate_commit_timestamp=1790042176451435	transaction_length=223
# original_commit_timestamp=1790042176451435 (2026-09-22 08:56:16.451435 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176451435 (2026-09-22 08:56:16.451435 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176451435*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54272
#260922  8:56:16 server id 1  end_log_pos 54418 CRC32 0x8b983043 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1790042176/*!*/;
DROP TABLE IF EXISTS `contacts` /* generated by server */
/*!*/;
# at 54418
#260922  8:56:16 server id 1  end_log_pos 54495 CRC32 0x00619ad6 	Anonymous_GTID	last_committed=45	sequence_number=46	rbr_only=no	original_committed_timestamp=1790042176455277	immediate_commit_timestamp=1790042176455277	transaction_length=224
# original_commit_timestamp=1790042176455277 (2026-09-22 08:56:16.455277 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176455277 (2026-09-22 08:56:16.455277 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176455277*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54495
#260922  8:56:16 server id 1  end_log_pos 54642 CRC32 0x56278a0e 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1790042176/*!*/;
DROP TABLE IF EXISTS `locations` /* generated by server */
/*!*/;
# at 54642
#260922  8:56:16 server id 1  end_log_pos 54719 CRC32 0xea5dc7c4 	Anonymous_GTID	last_committed=46	sequence_number=47	rbr_only=no	original_committed_timestamp=1790042176460449	immediate_commit_timestamp=1790042176460449	transaction_length=228
# original_commit_timestamp=1790042176460449 (2026-09-22 08:56:16.460449 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176460449 (2026-09-22 08:56:16.460449 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176460449*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54719
#260922  8:56:16 server id 1  end_log_pos 54870 CRC32 0x532e157f 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1790042176/*!*/;
DROP TABLE IF EXISTS `social_medias` /* generated by server */
/*!*/;
# at 54870
#260922  8:56:16 server id 1  end_log_pos 54949 CRC32 0xfeb1ba15 	Anonymous_GTID	last_committed=47	sequence_number=48	rbr_only=yes	original_committed_timestamp=1790042176470736	immediate_commit_timestamp=1790042176470736	transaction_length=542
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042176470736 (2026-09-22 08:56:16.470736 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176470736 (2026-09-22 08:56:16.470736 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176470736*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54949
#260922  8:56:16 server id 1  end_log_pos 55032 CRC32 0xf652df6b 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1790042176/*!*/;
BEGIN
/*!*/;
# at 55032
#260922  8:56:16 server id 1  end_log_pos 55120 CRC32 0x82170b3d 	Table_map: `pln_up_imy`.`menus` mapped to number 90
# at 55120
#260922  8:56:16 server id 1  end_log_pos 55381 CRC32 0x77759727 	Delete_rows: table id 90 flags: STMT_END_F

BINLOG '
QOCxahMBAAAAWAAAAFDXAAAAAFoAAAAAAAMACnBsbl91cF9pbXkABW1lbnVzAA4ICA8PDwgPDw8D
AQgREQ78A1AA/APQBygA8AAAAHI5AQH0AgHgPQsXgg==
QOCxaiABAAAABQEAAFXYAAAAAFoAAAAAAAEAAgAO//9gAREAAAAAAAAAEAAAAAAAAAAMAEh1YnVu
Z2kgS2FtaQVyb3V0ZQwAaHVidW5naS1rYW1pBV9zZWxmAQAAAAEEAAAAAAAAAGqpkNdqqZDXYAES
AAAAAAAAABAAAAAAAAAABgBMb2thc2kFcm91dGUGAGxva2FzaQVfc2VsZgIAAAABBAAAAAAAAABq
qZDXaqmQ12ABEwAAAAAAAAAQAAAAAAAAAAwAU29zaWFsIE1lZGlhBXJvdXRlDABzb3NpYWwtbWVk
aWEFX3NlbGYDAAAAAQQAAAAAAAAAaqmQ12qpkNcnl3V3
'/*!*/;
# at 55381
#260922  8:56:16 server id 1  end_log_pos 55412 CRC32 0x55164672 	Xid = 2537
COMMIT/*!*/;
# at 55412
#260922  8:56:16 server id 1  end_log_pos 55491 CRC32 0xe5df1414 	Anonymous_GTID	last_committed=48	sequence_number=49	rbr_only=yes	original_committed_timestamp=1790042176475191	immediate_commit_timestamp=1790042176475191	transaction_length=381
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042176475191 (2026-09-22 08:56:16.475191 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176475191 (2026-09-22 08:56:16.475191 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176475191*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 55491
#260922  8:56:16 server id 1  end_log_pos 55574 CRC32 0x5507d1d3 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1790042176/*!*/;
BEGIN
/*!*/;
# at 55574
#260922  8:56:16 server id 1  end_log_pos 55662 CRC32 0x76850774 	Table_map: `pln_up_imy`.`menus` mapped to number 90
# at 55662
#260922  8:56:16 server id 1  end_log_pos 55762 CRC32 0xf4691a34 	Delete_rows: table id 90 flags: STMT_END_F

BINLOG '
QOCxahMBAAAAWAAAAG7ZAAAAAFoAAAAAAAMACnBsbl91cF9pbXkABW1lbnVzAA4ICA8PDwgPDw8D
AQgREQ78A1AA/APQBygA8AAAAHI5AQH0AgHgdAeFdg==
QOCxaiABAAAAZAAAANLZAAAAAFoAAAAAAAEAAgAO//8yABAAAAAAAAAABgBLb250YWsDdXJsAQAj
BV9zZWxmC2ZhLWVudmVsb3BlBQAAAAEEAAAAAAAAAGqpkNdqqZDXNBpp9A==
'/*!*/;
# at 55762
#260922  8:56:16 server id 1  end_log_pos 55793 CRC32 0x493f17ff 	Xid = 2543
COMMIT/*!*/;
# at 55793
#260922  8:56:16 server id 1  end_log_pos 55872 CRC32 0xed74e432 	Anonymous_GTID	last_committed=49	sequence_number=50	rbr_only=yes	original_committed_timestamp=1790042176510699	immediate_commit_timestamp=1790042176510699	transaction_length=367
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042176510699 (2026-09-22 08:56:16.510699 SE Asia Standard Time)
# immediate_commit_timestamp=1790042176510699 (2026-09-22 08:56:16.510699 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042176510699*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 55872
#260922  8:56:16 server id 1  end_log_pos 55953 CRC32 0xc191f84a 	Query	thread_id=45	exec_time=0	error_code=0
SET TIMESTAMP=1790042176/*!*/;
BEGIN
/*!*/;
# at 55953
#260922  8:56:16 server id 1  end_log_pos 56022 CRC32 0x22f41975 	Table_map: `pln_up_imy`.`migrations` mapped to number 100
# at 56022
#260922  8:56:16 server id 1  end_log_pos 56129 CRC32 0xe7fd1cc8 	Write_rows: table id 100 flags: STMT_END_F

BINLOG '
QOCxahMBAAAARQAAANbaAAAAAGQAAAAAAAEACnBsbl91cF9pbXkACm1pZ3JhdGlvbnMAAwMPAwL8
AwABAYACAeB1GfQi
QOCxah4BAAAAawAAAEHbAAAAAGQAAAAAAAEAAgAD/wAQAAAAPQAyMDI2XzA5XzIxXzAwMDAwMV9k
cm9wX2NvbnRhY3RzX2xvY2F0aW9uc19zb2NpYWxfbWVkaWFfdGFibGVzBwAAAMgc/ec=
'/*!*/;
# at 56129
#260922  8:56:16 server id 1  end_log_pos 56160 CRC32 0xf61fbd82 	Xid = 2561
COMMIT/*!*/;
# at 56160
#260922  8:56:30 server id 1  end_log_pos 56239 CRC32 0xcc2f0178 	Anonymous_GTID	last_committed=50	sequence_number=51	rbr_only=yes	original_committed_timestamp=1790042190350703	immediate_commit_timestamp=1790042190350703	transaction_length=1386
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042190350703 (2026-09-22 08:56:30.350703 SE Asia Standard Time)
# immediate_commit_timestamp=1790042190350703 (2026-09-22 08:56:30.350703 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042190350703*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 56239
#260922  8:56:30 server id 1  end_log_pos 56329 CRC32 0x889a58cf 	Query	thread_id=46	exec_time=0	error_code=0
SET TIMESTAMP=1790042190/*!*/;
BEGIN
/*!*/;
# at 56329
#260922  8:56:30 server id 1  end_log_pos 56403 CRC32 0x34efca72 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 56403
#260922  8:56:30 server id 1  end_log_pos 57515 CRC32 0xe70ca0d1 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
TuCxahMBAAAASgAAAFPcAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HLK7zQ=
TuCxah8BAAAAWAQAAKvgAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT0q4LFq
ACgARmlqUVdYTG45U3N5UHhFNWxkRkxvekxmOVAzNjB6Zlg4azAwSVRZUgsAAAAAAAAACTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2ZAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pZFd3M1RtWlVVRVpOVWtvMU1V
MVdjRkExUldaa1lUTnZVREpWUkVKUmJWZ3lhV3MzY21RM1RpSTdjem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpm
Y0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VN
QzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8xTURvaWJH
OW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdV
ek1EazRPV1FpTzJrNk1URTdmUT09TuCxatGgDOc=
'/*!*/;
# at 57515
#260922  8:56:30 server id 1  end_log_pos 57546 CRC32 0x397974fb 	Xid = 2612
COMMIT/*!*/;
# at 57546
#260922  8:56:32 server id 1  end_log_pos 57625 CRC32 0x68db966c 	Anonymous_GTID	last_committed=51	sequence_number=52	rbr_only=yes	original_committed_timestamp=1790042192469551	immediate_commit_timestamp=1790042192469551	transaction_length=1386
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042192469551 (2026-09-22 08:56:32.469551 SE Asia Standard Time)
# immediate_commit_timestamp=1790042192469551 (2026-09-22 08:56:32.469551 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042192469551*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 57625
#260922  8:56:32 server id 1  end_log_pos 57715 CRC32 0x4765a557 	Query	thread_id=47	exec_time=0	error_code=0
SET TIMESTAMP=1790042192/*!*/;
BEGIN
/*!*/;
# at 57715
#260922  8:56:32 server id 1  end_log_pos 57789 CRC32 0xc3363c31 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 57789
#260922  8:56:32 server id 1  end_log_pos 58901 CRC32 0x901a87c2 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
UOCxahMBAAAASgAAAL3hAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DE8NsM=
UOCxah8BAAAAWAQAABXmAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT1O4LFq
ACgARmlqUVdYTG45U3N5UHhFNWxkRkxvekxmOVAzNjB6Zlg4azAwSVRZUgsAAAAAAAAACTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2ZAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pZFd3M1RtWlVVRVpOVWtvMU1V
MVdjRkExUldaa1lUTnZVREpWUkVKUmJWZ3lhV3MzY21RM1RpSTdjem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpm
Y0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VN
QzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8xTURvaWJH
OW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdV
ek1EazRPV1FpTzJrNk1URTdmUT09UOCxasKHGpA=
'/*!*/;
# at 58901
#260922  8:56:32 server id 1  end_log_pos 58932 CRC32 0xc01d763c 	Xid = 2663
COMMIT/*!*/;
# at 58932
#260922  8:57:15 server id 1  end_log_pos 59011 CRC32 0xe388350a 	Anonymous_GTID	last_committed=52	sequence_number=53	rbr_only=yes	original_committed_timestamp=1790042235890954	immediate_commit_timestamp=1790042235890954	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042235890954 (2026-09-22 08:57:15.890954 SE Asia Standard Time)
# immediate_commit_timestamp=1790042235890954 (2026-09-22 08:57:15.890954 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042235890954*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 59011
#260922  8:57:15 server id 1  end_log_pos 59101 CRC32 0xc64e4bc2 	Query	thread_id=48	exec_time=0	error_code=0
SET TIMESTAMP=1790042235/*!*/;
BEGIN
/*!*/;
# at 59101
#260922  8:57:15 server id 1  end_log_pos 59175 CRC32 0x72f5e468 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 59175
#260922  8:57:15 server id 1  end_log_pos 60319 CRC32 0xebacc1b9 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
e+CxahMBAAAASgAAACfnAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Gjk9XI=
e+Cxah8BAAAAeAQAAJ/rAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzZkAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DSTdjem8xT2lKeWIz
VjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TVRFN2ZRPT1Q4LFq
ACgARmlqUVdYTG45U3N5UHhFNWxkRkxvekxmOVAzNjB6Zlg4azAwSVRZUgsAAAAAAAAACTEyNy4w
LjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJL
aXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzE1My4wLjAuMCBTYWZhcmkvNTM3
LjM2hAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pZFd3M1RtWlVVRVpOVWtvMU1V
MVdjRkExUldaa1lUTnZVREpWUkVKUmJWZ3lhV3MzY21RM1RpSTdjem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzVPaUpm
Y0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpZNkltaDBkSEE2THk4eE1qY3VN
QzR3TGpFNk9EQXdNQzlzWVhsaGJtRnVMMlJoWm5SaGNpSTdjem8xT2lKeWIzVjBaU0k3Y3pveE5E
b2liR0Y1WVc1aGJpNWtZV1owWVhJaU8zMXpPalV3T2lKc2IyZHBibDkzWldKZk5UbGlZVE0yWVdS
a1l6SmlNbVk1TkRBeE5UZ3daakF4TkdNM1pqVTRaV0UwWlRNd09UZzVaQ0k3YVRveE1UdDl74LFq
ucGs6w==
'/*!*/;
# at 60319
#260922  8:57:15 server id 1  end_log_pos 60350 CRC32 0x7fe48f43 	Xid = 2714
COMMIT/*!*/;
# at 60350
#260922  9:02:06 server id 1  end_log_pos 60429 CRC32 0x7632ca2b 	Anonymous_GTID	last_committed=53	sequence_number=54	rbr_only=yes	original_committed_timestamp=1790042526084610	immediate_commit_timestamp=1790042526084610	transaction_length=1482
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1790042526084610 (2026-09-22 09:02:06.084610 SE Asia Standard Time)
# immediate_commit_timestamp=1790042526084610 (2026-09-22 09:02:06.084610 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1790042526084610*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 60429
#260922  9:02:06 server id 1  end_log_pos 60519 CRC32 0xb8461f84 	Query	thread_id=49	exec_time=0	error_code=0
SET TIMESTAMP=1790042526/*!*/;
BEGIN
/*!*/;
# at 60519
#260922  9:02:06 server id 1  end_log_pos 60593 CRC32 0xc3e3e74f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 60593
#260922  9:02:06 server id 1  end_log_pos 61801 CRC32 0xe376b75c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
nuGxahMBAAAASgAAALHsAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E/n48M=
nuGxah8BAAAAuAQAAGnxAAAAAFMAAAAAAAEAAgAG//8AKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzaEAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOXNZWGxoYm1GdUwy
UmhablJoY2lJN2N6bzFPaUp5YjNWMFpTSTdjem94TkRvaWJHRjVZVzVoYmk1a1lXWjBZWElpTzMx
ek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00z
WmpVNFpXRTBaVE13T1RnNVpDSTdhVG94TVR0OXvgsWoAKABGaWpRV1hMbjlTc3lQeEU1bGRGTG96
TGY5UDM2MHpmWDhrMDBJVFlSCwAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUzLjAuMC4wIFNhZmFyaS81MzcuMzakAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lkV3czVG1aVVVFWk5Va28xTVUxV2NGQTFSV1prWVROdlVESlZSRUpSYlZn
eWFXczNjbVEzVGlJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZOVFE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxX
dGhiV2t2YzNSeWRXdDBkWEl0YjNKbllXNXBjMkZ6YVNJN2N6bzFPaUp5YjNWMFpTSTdjem94T1Rv
aWMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0po
TXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qRXhP
MzA9nuGxaly3duM=
'/*!*/;
# at 61801
#260922  9:02:06 server id 1  end_log_pos 61832 CRC32 0x95e7c125 	Xid = 2765
COMMIT/*!*/;
# at 61832
#260922 11:12:54 server id 1  end_log_pos 61855 CRC32 0x400825b2 	Stop
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
