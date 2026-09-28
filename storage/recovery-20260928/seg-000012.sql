# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#260914 14:52:19 server id 1  end_log_pos 126 CRC32 0x6310c38e 	Start: binlog v 4, server v 8.0.30 created 260914 14:52:19 at startup
ROLLBACK/*!*/;
BINLOG '
s6enag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAACzp6dqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAAY7DEGM=
'/*!*/;
# at 126
#260914 14:52:19 server id 1  end_log_pos 157 CRC32 0xdf34a50c 	Previous-GTIDs
# [empty]
# at 157
#260914 14:52:35 server id 1  end_log_pos 236 CRC32 0x6c144431 	Anonymous_GTID	last_committed=0	sequence_number=1	rbr_only=yes	original_committed_timestamp=1789372355153943	immediate_commit_timestamp=1789372355153943	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372355153943 (2026-09-14 14:52:35.153943 SE Asia Standard Time)
# immediate_commit_timestamp=1789372355153943 (2026-09-14 14:52:35.153943 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372355153943*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236
#260914 14:52:35 server id 1  end_log_pos 326 CRC32 0x39548b39 	Query	thread_id=8	exec_time=0	error_code=0
SET TIMESTAMP=1789372355/*!*/;
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
# at 326
#260914 14:52:35 server id 1  end_log_pos 400 CRC32 0x07ea054a 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 400
#260914 14:52:35 server id 1  end_log_pos 1624 CRC32 0x8e63c9c7 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
w6enahMBAAAASgAAAJABAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EoF6gc=
w6enah8BAAAAyAQAAFgGAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPZenp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPcOnp2rHyWOO
'/*!*/;
# at 1624
#260914 14:52:35 server id 1  end_log_pos 1655 CRC32 0x455a13cc 	Xid = 21
COMMIT/*!*/;
# at 1655
#260914 14:52:52 server id 1  end_log_pos 1734 CRC32 0x6b15f66e 	Anonymous_GTID	last_committed=1	sequence_number=2	rbr_only=no	original_committed_timestamp=1789372372486259	immediate_commit_timestamp=1789372372486259	transaction_length=704
# original_commit_timestamp=1789372372486259 (2026-09-14 14:52:52.486259 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372486259 (2026-09-14 14:52:52.486259 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372486259*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 1734
#260914 14:52:52 server id 1  end_log_pos 2359 CRC32 0x3409f102 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 42
use `pln_up_imy`/*!*/;
SET TIMESTAMP=1789372372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `activity_logs` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned null, `user_name` varchar(255) null, `user_role` varchar(255) null, `module` varchar(255) not null, `action` varchar(255) not null, `description` text not null, `subject_type` varchar(255) null, `subject_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` varchar(500) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 2359
#260914 14:52:52 server id 1  end_log_pos 2438 CRC32 0x7edf86c0 	Anonymous_GTID	last_committed=2	sequence_number=3	rbr_only=no	original_committed_timestamp=1789372372511297	immediate_commit_timestamp=1789372372511297	transaction_length=322
# original_commit_timestamp=1789372372511297 (2026-09-14 14:52:52.511297 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372511297 (2026-09-14 14:52:52.511297 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372511297*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2438
#260914 14:52:52 server id 1  end_log_pos 2681 CRC32 0xfbaca712 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 45
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add constraint `activity_logs_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete set null
/*!*/;
# at 2681
#260914 14:52:52 server id 1  end_log_pos 2760 CRC32 0x04292421 	Anonymous_GTID	last_committed=3	sequence_number=4	rbr_only=no	original_committed_timestamp=1789372372520789	immediate_commit_timestamp=1789372372520789	transaction_length=263
# original_commit_timestamp=1789372372520789 (2026-09-14 14:52:52.520789 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372520789 (2026-09-14 14:52:52.520789 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372520789*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2760
#260914 14:52:52 server id 1  end_log_pos 2944 CRC32 0xfa1b10ef 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 48
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_created_at_index`(`created_at`)
/*!*/;
# at 2944
#260914 14:52:52 server id 1  end_log_pos 3023 CRC32 0xdc4b0bd8 	Anonymous_GTID	last_committed=4	sequence_number=5	rbr_only=no	original_committed_timestamp=1789372372530440	immediate_commit_timestamp=1789372372530440	transaction_length=272
# original_commit_timestamp=1789372372530440 (2026-09-14 14:52:52.530440 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372530440 (2026-09-14 14:52:52.530440 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372530440*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3023
#260914 14:52:52 server id 1  end_log_pos 3216 CRC32 0x8a284334 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 51
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_action_index`(`module`, `action`)
/*!*/;
# at 3216
#260914 14:52:52 server id 1  end_log_pos 3295 CRC32 0x3767a1b6 	Anonymous_GTID	last_committed=5	sequence_number=6	rbr_only=no	original_committed_timestamp=1789372372538182	immediate_commit_timestamp=1789372372538182	transaction_length=255
# original_commit_timestamp=1789372372538182 (2026-09-14 14:52:52.538182 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372538182 (2026-09-14 14:52:52.538182 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372538182*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3295
#260914 14:52:52 server id 1  end_log_pos 3471 CRC32 0xdaf7240c 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 54
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_module_index`(`module`)
/*!*/;
# at 3471
#260914 14:52:52 server id 1  end_log_pos 3550 CRC32 0x527dbac5 	Anonymous_GTID	last_committed=6	sequence_number=7	rbr_only=no	original_committed_timestamp=1789372372547184	immediate_commit_timestamp=1789372372547184	transaction_length=255
# original_commit_timestamp=1789372372547184 (2026-09-14 14:52:52.547184 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372547184 (2026-09-14 14:52:52.547184 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372547184*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3550
#260914 14:52:52 server id 1  end_log_pos 3726 CRC32 0x6de4577c 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 57
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_action_index`(`action`)
/*!*/;
# at 3726
#260914 14:52:52 server id 1  end_log_pos 3805 CRC32 0xd664c5ec 	Anonymous_GTID	last_committed=7	sequence_number=8	rbr_only=no	original_committed_timestamp=1789372372556071	immediate_commit_timestamp=1789372372556071	transaction_length=267
# original_commit_timestamp=1789372372556071 (2026-09-14 14:52:52.556071 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372556071 (2026-09-14 14:52:52.556071 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372556071*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3805
#260914 14:52:52 server id 1  end_log_pos 3993 CRC32 0x98d50bd2 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 60
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `activity_logs` add index `activity_logs_subject_type_index`(`subject_type`)
/*!*/;
# at 3993
#260914 14:52:52 server id 1  end_log_pos 4072 CRC32 0x51a2006b 	Anonymous_GTID	last_committed=8	sequence_number=9	rbr_only=yes	original_committed_timestamp=1789372372561968	immediate_commit_timestamp=1789372372561968	transaction_length=350
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372372561968 (2026-09-14 14:52:52.561968 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372561968 (2026-09-14 14:52:52.561968 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372561968*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4072
#260914 14:52:52 server id 1  end_log_pos 4153 CRC32 0x26f866ea 	Query	thread_id=9	exec_time=0	error_code=0
SET TIMESTAMP=1789372372/*!*/;
BEGIN
/*!*/;
# at 4153
#260914 14:52:52 server id 1  end_log_pos 4222 CRC32 0x9293f08a 	Table_map: `pln_up_imy`.`migrations` mapped to number 93
# at 4222
#260914 14:52:52 server id 1  end_log_pos 4312 CRC32 0x2ae03d6c 	Write_rows: table id 93 flags: STMT_END_F

BINLOG '
1KenahMBAAAARQAAAH4QAAAAAF0AAAAAAAEACnBsbl91cF9pbXkACm1pZ3JhdGlvbnMAAwMPAwL8
AwABAYACAeCK8JOS
1Kenah4BAAAAWgAAANgQAAAAAF0AAAAAAAEAAgAD/wAKAAAALAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfYWN0aXZpdHlfbG9nc190YWJsZQQAAABsPeAq
'/*!*/;
# at 4312
#260914 14:52:52 server id 1  end_log_pos 4343 CRC32 0x36dc1664 	Xid = 63
COMMIT/*!*/;
# at 4343
#260914 14:52:52 server id 1  end_log_pos 4422 CRC32 0xddd20c9d 	Anonymous_GTID	last_committed=9	sequence_number=10	rbr_only=no	original_committed_timestamp=1789372372599796	immediate_commit_timestamp=1789372372599796	transaction_length=652
# original_commit_timestamp=1789372372599796 (2026-09-14 14:52:52.599796 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372599796 (2026-09-14 14:52:52.599796 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372599796*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4422
#260914 14:52:52 server id 1  end_log_pos 4995 CRC32 0x5b38a333 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 66
SET TIMESTAMP=1789372372/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
create table `galleries` (`id` bigint unsigned not null auto_increment primary key, `judul` varchar(255) not null, `kategori` enum('KEGIATAN', 'FASILITAS', 'DOKUMENTASI', 'SEREMONIAL') not null, `deskripsi` text null, `file_gambar` varchar(255) not null, `tanggal_kegiatan` date not null, `status` enum('publikasi', 'draft') not null default 'publikasi', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
/*!*/;
# at 4995
#260914 14:52:52 server id 1  end_log_pos 5072 CRC32 0x20436341 	Anonymous_GTID	last_committed=10	sequence_number=11	rbr_only=no	original_committed_timestamp=1789372372608587	immediate_commit_timestamp=1789372372608587	transaction_length=249
# original_commit_timestamp=1789372372608587 (2026-09-14 14:52:52.608587 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372608587 (2026-09-14 14:52:52.608587 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372608587*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5072
#260914 14:52:52 server id 1  end_log_pos 5244 CRC32 0x48ae3efe 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 69
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_kategori_index`(`kategori`)
/*!*/;
# at 5244
#260914 14:52:52 server id 1  end_log_pos 5321 CRC32 0xd4013c20 	Anonymous_GTID	last_committed=11	sequence_number=12	rbr_only=no	original_committed_timestamp=1789372372616018	immediate_commit_timestamp=1789372372616018	transaction_length=245
# original_commit_timestamp=1789372372616018 (2026-09-14 14:52:52.616018 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372616018 (2026-09-14 14:52:52.616018 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372616018*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5321
#260914 14:52:52 server id 1  end_log_pos 5489 CRC32 0xbcee3184 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 72
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_status_index`(`status`)
/*!*/;
# at 5489
#260914 14:52:52 server id 1  end_log_pos 5568 CRC32 0x4806b63d 	Anonymous_GTID	last_committed=12	sequence_number=13	rbr_only=no	original_committed_timestamp=1789372372628934	immediate_commit_timestamp=1789372372628934	transaction_length=267
# original_commit_timestamp=1789372372628934 (2026-09-14 14:52:52.628934 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372628934 (2026-09-14 14:52:52.628934 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372628934*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5568
#260914 14:52:52 server id 1  end_log_pos 5756 CRC32 0xb5421b47 	Query	thread_id=9	exec_time=0	error_code=0	Xid = 75
SET TIMESTAMP=1789372372/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
alter table `galleries` add index `galleries_tanggal_kegiatan_index`(`tanggal_kegiatan`)
/*!*/;
# at 5756
#260914 14:52:52 server id 1  end_log_pos 5835 CRC32 0x9eaf8b30 	Anonymous_GTID	last_committed=13	sequence_number=14	rbr_only=yes	original_committed_timestamp=1789372372631999	immediate_commit_timestamp=1789372372631999	transaction_length=346
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372372631999 (2026-09-14 14:52:52.631999 SE Asia Standard Time)
# immediate_commit_timestamp=1789372372631999 (2026-09-14 14:52:52.631999 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372372631999*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5835
#260914 14:52:52 server id 1  end_log_pos 5916 CRC32 0x774d0bc6 	Query	thread_id=9	exec_time=0	error_code=0
SET TIMESTAMP=1789372372/*!*/;
BEGIN
/*!*/;
# at 5916
#260914 14:52:52 server id 1  end_log_pos 5985 CRC32 0x9d50e1ad 	Table_map: `pln_up_imy`.`migrations` mapped to number 93
# at 5985
#260914 14:52:52 server id 1  end_log_pos 6071 CRC32 0x5c01dd1d 	Write_rows: table id 93 flags: STMT_END_F

BINLOG '
1KenahMBAAAARQAAAGEXAAAAAF0AAAAAAAEACnBsbl91cF9pbXkACm1pZ3JhdGlvbnMAAwMPAwL8
AwABAYACAeCt4VCd
1Kenah4BAAAAVgAAALcXAAAAAF0AAAAAAAEAAgAD/wALAAAAKAAyMDI2XzA5XzE0XzAwMDAwMl9j
cmVhdGVfZ2FsbGVyaWVzX3RhYmxlBAAAAB3dAVw=
'/*!*/;
# at 6071
#260914 14:52:52 server id 1  end_log_pos 6102 CRC32 0x7b3e189c 	Xid = 78
COMMIT/*!*/;
# at 6102
#260914 14:53:02 server id 1  end_log_pos 6181 CRC32 0xd03956fe 	Anonymous_GTID	last_committed=14	sequence_number=15	rbr_only=yes	original_committed_timestamp=1789372382793159	immediate_commit_timestamp=1789372382793159	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372382793159 (2026-09-14 14:53:02.793159 SE Asia Standard Time)
# immediate_commit_timestamp=1789372382793159 (2026-09-14 14:53:02.793159 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372382793159*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 6181
#260914 14:53:02 server id 1  end_log_pos 6271 CRC32 0xe8eb450f 	Query	thread_id=10	exec_time=0	error_code=0
SET TIMESTAMP=1789372382/*!*/;
BEGIN
/*!*/;
# at 6271
#260914 14:53:02 server id 1  end_log_pos 6345 CRC32 0x33cfd77e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 6345
#260914 14:53:02 server id 1  end_log_pos 7569 CRC32 0x1f1b70e6 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
3qenahMBAAAASgAAAMkYAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4H7XzzM=
3qenah8BAAAAyAQAAJEdAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPcOnp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPd6np2rmcBsf
'/*!*/;
# at 7569
#260914 14:53:02 server id 1  end_log_pos 7600 CRC32 0xd9573162 	Xid = 105
COMMIT/*!*/;
# at 7600
#260914 14:53:10 server id 1  end_log_pos 7679 CRC32 0x0f4373b0 	Anonymous_GTID	last_committed=15	sequence_number=16	rbr_only=yes	original_committed_timestamp=1789372390726646	immediate_commit_timestamp=1789372390726646	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372390726646 (2026-09-14 14:53:10.726646 SE Asia Standard Time)
# immediate_commit_timestamp=1789372390726646 (2026-09-14 14:53:10.726646 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372390726646*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 7679
#260914 14:53:10 server id 1  end_log_pos 7769 CRC32 0xbba6ff3a 	Query	thread_id=11	exec_time=0	error_code=0
SET TIMESTAMP=1789372390/*!*/;
BEGIN
/*!*/;
# at 7769
#260914 14:53:10 server id 1  end_log_pos 7843 CRC32 0x72853e60 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 7843
#260914 14:53:10 server id 1  end_log_pos 9067 CRC32 0x92ea29be 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
5qenahMBAAAASgAAAKMeAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GA+hXI=
5qenah8BAAAAyAQAAGsjAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPd6np2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPeanp2q+KeqS
'/*!*/;
# at 9067
#260914 14:53:10 server id 1  end_log_pos 9098 CRC32 0x43a853f1 	Xid = 123
COMMIT/*!*/;
# at 9098
#260914 14:53:13 server id 1  end_log_pos 9177 CRC32 0xffa98322 	Anonymous_GTID	last_committed=16	sequence_number=17	rbr_only=yes	original_committed_timestamp=1789372393561541	immediate_commit_timestamp=1789372393561541	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372393561541 (2026-09-14 14:53:13.561541 SE Asia Standard Time)
# immediate_commit_timestamp=1789372393561541 (2026-09-14 14:53:13.561541 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372393561541*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 9177
#260914 14:53:13 server id 1  end_log_pos 9267 CRC32 0xea6a2af1 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1789372393/*!*/;
BEGIN
/*!*/;
# at 9267
#260914 14:53:13 server id 1  end_log_pos 9341 CRC32 0xe8817e19 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 9341
#260914 14:53:13 server id 1  end_log_pos 10565 CRC32 0x505eff1c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6aenahMBAAAASgAAAH0kAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Bl+geg=
6aenah8BAAAAyAQAAEUpAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPeanp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPemnp2oc/15Q
'/*!*/;
# at 10565
#260914 14:53:13 server id 1  end_log_pos 10596 CRC32 0x9e548444 	Xid = 138
COMMIT/*!*/;
# at 10596
#260914 14:53:14 server id 1  end_log_pos 10675 CRC32 0x3903a8f5 	Anonymous_GTID	last_committed=17	sequence_number=18	rbr_only=yes	original_committed_timestamp=1789372394866172	immediate_commit_timestamp=1789372394866172	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372394866172 (2026-09-14 14:53:14.866172 SE Asia Standard Time)
# immediate_commit_timestamp=1789372394866172 (2026-09-14 14:53:14.866172 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372394866172*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 10675
#260914 14:53:14 server id 1  end_log_pos 10765 CRC32 0x3b8bd2a3 	Query	thread_id=13	exec_time=0	error_code=0
SET TIMESTAMP=1789372394/*!*/;
BEGIN
/*!*/;
# at 10765
#260914 14:53:14 server id 1  end_log_pos 10839 CRC32 0xf546b704 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 10839
#260914 14:53:14 server id 1  end_log_pos 12059 CRC32 0xabbcf831 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
6qenahMBAAAASgAAAFcqAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AS3RvU=
6qenah8BAAAAxAQAABsvAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPemnp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzaYAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5dVpYZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcx
cGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pvek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1
WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVP
RGxrSWp0cE9qUTdmUT096qenajH4vKs=
'/*!*/;
# at 12059
#260914 14:53:14 server id 1  end_log_pos 12090 CRC32 0xdb61d0eb 	Xid = 156
COMMIT/*!*/;
# at 12090
#260914 14:53:16 server id 1  end_log_pos 12169 CRC32 0x7b763e12 	Anonymous_GTID	last_committed=18	sequence_number=19	rbr_only=yes	original_committed_timestamp=1789372396173221	immediate_commit_timestamp=1789372396173221	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372396173221 (2026-09-14 14:53:16.173221 SE Asia Standard Time)
# immediate_commit_timestamp=1789372396173221 (2026-09-14 14:53:16.173221 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372396173221*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12169
#260914 14:53:16 server id 1  end_log_pos 12259 CRC32 0xefb5e11d 	Query	thread_id=14	exec_time=0	error_code=0
SET TIMESTAMP=1789372396/*!*/;
BEGIN
/*!*/;
# at 12259
#260914 14:53:16 server id 1  end_log_pos 12333 CRC32 0xb6a773b6 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 12333
#260914 14:53:16 server id 1  end_log_pos 13549 CRC32 0x79752915 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7KenahMBAAAASgAAAC0wAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LZzp7Y=
7Kenah8BAAAAwAQAAO00AAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT096qenagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem96T2lKMWNtd2lPMkU2TURwN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT3sp6dqFSl1eQ==
'/*!*/;
# at 13549
#260914 14:53:16 server id 1  end_log_pos 13580 CRC32 0x7d9c16d2 	Xid = 174
COMMIT/*!*/;
# at 13580
#260914 14:53:17 server id 1  end_log_pos 13659 CRC32 0xcadf7c0c 	Anonymous_GTID	last_committed=19	sequence_number=20	rbr_only=yes	original_committed_timestamp=1789372397840355	immediate_commit_timestamp=1789372397840355	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372397840355 (2026-09-14 14:53:17.840355 SE Asia Standard Time)
# immediate_commit_timestamp=1789372397840355 (2026-09-14 14:53:17.840355 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372397840355*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13659
#260914 14:53:17 server id 1  end_log_pos 13749 CRC32 0xe5b5e544 	Query	thread_id=15	exec_time=0	error_code=0
SET TIMESTAMP=1789372397/*!*/;
BEGIN
/*!*/;
# at 13749
#260914 14:53:17 server id 1  end_log_pos 13823 CRC32 0x9bfa1f11 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 13823
#260914 14:53:17 server id 1  end_log_pos 15043 CRC32 0x4ec6ea73 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
7aenahMBAAAASgAAAP81AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BEf+ps=
7aenah8BAAAAxAQAAMM6AAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT097KenagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpwB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1G
a2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6T2pVd09pSnNiMmRw
Ymw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdP
VGc1WkNJN2FUbzBPMzA97aenanPqxk4=
'/*!*/;
# at 15043
#260914 14:53:17 server id 1  end_log_pos 15074 CRC32 0x2a7b444f 	Xid = 201
COMMIT/*!*/;
# at 15074
#260914 14:53:27 server id 1  end_log_pos 15153 CRC32 0x319bc511 	Anonymous_GTID	last_committed=20	sequence_number=21	rbr_only=yes	original_committed_timestamp=1789372407175988	immediate_commit_timestamp=1789372407175988	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372407175988 (2026-09-14 14:53:27.175988 SE Asia Standard Time)
# immediate_commit_timestamp=1789372407175988 (2026-09-14 14:53:27.175988 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372407175988*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 15153
#260914 14:53:27 server id 1  end_log_pos 15243 CRC32 0x2c04aedf 	Query	thread_id=16	exec_time=0	error_code=0
SET TIMESTAMP=1789372407/*!*/;
BEGIN
/*!*/;
# at 15243
#260914 14:53:27 server id 1  end_log_pos 15317 CRC32 0xefcdb28b 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 15317
#260914 14:53:27 server id 1  end_log_pos 16541 CRC32 0x7d7ccabb 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
96enahMBAAAASgAAANU7AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Iuyze8=
96enah8BAAAAyAQAAJ1AAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPe2np2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPfenp2q7ynx9
'/*!*/;
# at 16541
#260914 14:53:27 server id 1  end_log_pos 16572 CRC32 0x3930bdfb 	Xid = 219
COMMIT/*!*/;
# at 16572
#260914 14:53:32 server id 1  end_log_pos 16651 CRC32 0x9386f3fa 	Anonymous_GTID	last_committed=21	sequence_number=22	rbr_only=yes	original_committed_timestamp=1789372412849800	immediate_commit_timestamp=1789372412849800	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372412849800 (2026-09-14 14:53:32.849800 SE Asia Standard Time)
# immediate_commit_timestamp=1789372412849800 (2026-09-14 14:53:32.849800 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372412849800*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 16651
#260914 14:53:32 server id 1  end_log_pos 16741 CRC32 0xebb54fe7 	Query	thread_id=17	exec_time=0	error_code=0
SET TIMESTAMP=1789372412/*!*/;
BEGIN
/*!*/;
# at 16741
#260914 14:53:32 server id 1  end_log_pos 16815 CRC32 0xe1c1fa82 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 16815
#260914 14:53:32 server id 1  end_log_pos 18039 CRC32 0x968ef80b 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/KenahMBAAAASgAAAK9BAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4IL6weE=
/Kenah8BAAAAyAQAAHdGAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfenp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPfynp2oL+I6W
'/*!*/;
# at 18039
#260914 14:53:32 server id 1  end_log_pos 18070 CRC32 0xbef768cf 	Xid = 234
COMMIT/*!*/;
# at 18070
#260914 14:53:33 server id 1  end_log_pos 18149 CRC32 0xa82c9c96 	Anonymous_GTID	last_committed=22	sequence_number=23	rbr_only=yes	original_committed_timestamp=1789372413554811	immediate_commit_timestamp=1789372413554811	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372413554811 (2026-09-14 14:53:33.554811 SE Asia Standard Time)
# immediate_commit_timestamp=1789372413554811 (2026-09-14 14:53:33.554811 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372413554811*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 18149
#260914 14:53:33 server id 1  end_log_pos 18239 CRC32 0xdf9ad5bb 	Query	thread_id=18	exec_time=0	error_code=0
SET TIMESTAMP=1789372413/*!*/;
BEGIN
/*!*/;
# at 18239
#260914 14:53:33 server id 1  end_log_pos 18313 CRC32 0x059f0741 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 18313
#260914 14:53:33 server id 1  end_log_pos 19537 CRC32 0x98abb43c 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/aenahMBAAAASgAAAIlHAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EEHnwU=
/aenah8BAAAAyAQAAFFMAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPfynp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPf2np2o8tKuY
'/*!*/;
# at 19537
#260914 14:53:33 server id 1  end_log_pos 19568 CRC32 0xa79c0679 	Xid = 252
COMMIT/*!*/;
# at 19568
#260914 14:53:34 server id 1  end_log_pos 19647 CRC32 0x92235c4e 	Anonymous_GTID	last_committed=23	sequence_number=24	rbr_only=yes	original_committed_timestamp=1789372414051693	immediate_commit_timestamp=1789372414051693	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789372414051693 (2026-09-14 14:53:34.051693 SE Asia Standard Time)
# immediate_commit_timestamp=1789372414051693 (2026-09-14 14:53:34.051693 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789372414051693*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 19647
#260914 14:53:34 server id 1  end_log_pos 19737 CRC32 0x745f64a7 	Query	thread_id=19	exec_time=0	error_code=0
SET TIMESTAMP=1789372414/*!*/;
BEGIN
/*!*/;
# at 19737
#260914 14:53:34 server id 1  end_log_pos 19811 CRC32 0x117f0d8e 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 19811
#260914 14:53:34 server id 1  end_log_pos 21035 CRC32 0xdf2d9bfc 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/qenahMBAAAASgAAAGNNAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4I4NfxE=
/qenah8BAAAAyAQAACtSAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPf2np2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPf6np2r8my3f
'/*!*/;
# at 21035
#260914 14:53:34 server id 1  end_log_pos 21066 CRC32 0x9daa24fb 	Xid = 273
COMMIT/*!*/;
# at 21066
#260914 15:16:56 server id 1  end_log_pos 21145 CRC32 0xab7e325d 	Anonymous_GTID	last_committed=24	sequence_number=25	rbr_only=yes	original_committed_timestamp=1789373816599172	immediate_commit_timestamp=1789373816599172	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789373816599172 (2026-09-14 15:16:56.599172 SE Asia Standard Time)
# immediate_commit_timestamp=1789373816599172 (2026-09-14 15:16:56.599172 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789373816599172*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 21145
#260914 15:16:56 server id 1  end_log_pos 21235 CRC32 0x2522b0aa 	Query	thread_id=20	exec_time=0	error_code=0
SET TIMESTAMP=1789373816/*!*/;
BEGIN
/*!*/;
# at 21235
#260914 15:16:56 server id 1  end_log_pos 21309 CRC32 0xe0be33d0 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 21309
#260914 15:16:56 server id 1  end_log_pos 22529 CRC32 0x443f96db 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
eK2nahMBAAAASgAAAD1TAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NAzvuA=
eK2nah8BAAAAxAQAAAFYAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPf6np2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzaYAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5dVpYZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcx
cGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pvek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1
WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVP
RGxrSWp0cE9qUTdmUT09eK2natuWP0Q=
'/*!*/;
# at 22529
#260914 15:16:56 server id 1  end_log_pos 22560 CRC32 0x5cfb2810 	Xid = 291
COMMIT/*!*/;
# at 22560
#260914 15:16:57 server id 1  end_log_pos 22639 CRC32 0x24f3f7a4 	Anonymous_GTID	last_committed=25	sequence_number=26	rbr_only=yes	original_committed_timestamp=1789373817754487	immediate_commit_timestamp=1789373817754487	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789373817754487 (2026-09-14 15:16:57.754487 SE Asia Standard Time)
# immediate_commit_timestamp=1789373817754487 (2026-09-14 15:16:57.754487 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789373817754487*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 22639
#260914 15:16:57 server id 1  end_log_pos 22729 CRC32 0xa6b71244 	Query	thread_id=21	exec_time=0	error_code=0
SET TIMESTAMP=1789373817/*!*/;
BEGIN
/*!*/;
# at 22729
#260914 15:16:57 server id 1  end_log_pos 22803 CRC32 0x5b4a8cd7 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 22803
#260914 15:16:57 server id 1  end_log_pos 24019 CRC32 0xe066c293 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ea2nahMBAAAASgAAABNZAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NeMSls=
ea2nah8BAAAAwAQAANNdAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09eK2nagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem96T2lKMWNtd2lPMkU2TURwN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT15radqk8Jm4A==
'/*!*/;
# at 24019
#260914 15:16:57 server id 1  end_log_pos 24050 CRC32 0xd09a583c 	Xid = 309
COMMIT/*!*/;
# at 24050
#260914 15:17:02 server id 1  end_log_pos 24129 CRC32 0x9b478e5d 	Anonymous_GTID	last_committed=26	sequence_number=27	rbr_only=yes	original_committed_timestamp=1789373822818364	immediate_commit_timestamp=1789373822818364	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789373822818364 (2026-09-14 15:17:02.818364 SE Asia Standard Time)
# immediate_commit_timestamp=1789373822818364 (2026-09-14 15:17:02.818364 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789373822818364*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24129
#260914 15:17:02 server id 1  end_log_pos 24219 CRC32 0xa864d092 	Query	thread_id=22	exec_time=0	error_code=0
SET TIMESTAMP=1789373822/*!*/;
BEGIN
/*!*/;
# at 24219
#260914 15:17:02 server id 1  end_log_pos 24293 CRC32 0x800b5977 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 24293
#260914 15:17:02 server id 1  end_log_pos 25509 CRC32 0x19cb488e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
fq2nahMBAAAASgAAAOVeAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HdZC4A=
fq2nah8BAAAAwAQAAKVjAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09ea2nagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem96T2lKMWNtd2lPMkU2TURwN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT1+radqjkjLGQ==
'/*!*/;
# at 25509
#260914 15:17:02 server id 1  end_log_pos 25540 CRC32 0x42b166ca 	Xid = 327
COMMIT/*!*/;
# at 25540
#260914 15:28:41 server id 1  end_log_pos 25619 CRC32 0x5d6a42a0 	Anonymous_GTID	last_committed=27	sequence_number=28	rbr_only=yes	original_committed_timestamp=1789374521890183	immediate_commit_timestamp=1789374521890183	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789374521890183 (2026-09-14 15:28:41.890183 SE Asia Standard Time)
# immediate_commit_timestamp=1789374521890183 (2026-09-14 15:28:41.890183 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789374521890183*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25619
#260914 15:28:41 server id 1  end_log_pos 25709 CRC32 0x4aacba5d 	Query	thread_id=23	exec_time=0	error_code=0
SET TIMESTAMP=1789374521/*!*/;
BEGIN
/*!*/;
# at 25709
#260914 15:28:41 server id 1  end_log_pos 25783 CRC32 0xd932db10 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 25783
#260914 15:28:41 server id 1  end_log_pos 27003 CRC32 0x7f36bef4 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ObCnahMBAAAASgAAALdkAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BDbMtk=
ObCnah8BAAAAxAQAAHtpAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09fq2nagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpwB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1G
a2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6T2pVd09pSnNiMmRw
Ymw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdP
VGc1WkNJN2FUbzBPMzA9ObCnavS+Nn8=
'/*!*/;
# at 27003
#260914 15:28:41 server id 1  end_log_pos 27034 CRC32 0x676c59dd 	Xid = 354
COMMIT/*!*/;
# at 27034
#260914 15:28:43 server id 1  end_log_pos 27113 CRC32 0x7865f27c 	Anonymous_GTID	last_committed=28	sequence_number=29	rbr_only=yes	original_committed_timestamp=1789374523940299	immediate_commit_timestamp=1789374523940299	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789374523940299 (2026-09-14 15:28:43.940299 SE Asia Standard Time)
# immediate_commit_timestamp=1789374523940299 (2026-09-14 15:28:43.940299 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789374523940299*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27113
#260914 15:28:43 server id 1  end_log_pos 27203 CRC32 0x558ae6d8 	Query	thread_id=24	exec_time=0	error_code=0
SET TIMESTAMP=1789374523/*!*/;
BEGIN
/*!*/;
# at 27203
#260914 15:28:43 server id 1  end_log_pos 27277 CRC32 0xcc4f0a67 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 27277
#260914 15:28:43 server id 1  end_log_pos 28501 CRC32 0x0c4ce41f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
O7CnahMBAAAASgAAAI1qAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GcKT8w=
O7Cnah8BAAAAyAQAAFVvAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTmwp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPTuwp2of5EwM
'/*!*/;
# at 28501
#260914 15:28:43 server id 1  end_log_pos 28532 CRC32 0x6470bd65 	Xid = 372
COMMIT/*!*/;
# at 28532
#260914 15:40:29 server id 1  end_log_pos 28611 CRC32 0xc7ab7296 	Anonymous_GTID	last_committed=29	sequence_number=30	rbr_only=yes	original_committed_timestamp=1789375229790590	immediate_commit_timestamp=1789375229790590	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375229790590 (2026-09-14 15:40:29.790590 SE Asia Standard Time)
# immediate_commit_timestamp=1789375229790590 (2026-09-14 15:40:29.790590 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375229790590*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 28611
#260914 15:40:29 server id 1  end_log_pos 28701 CRC32 0x74856ab3 	Query	thread_id=25	exec_time=0	error_code=0
SET TIMESTAMP=1789375229/*!*/;
BEGIN
/*!*/;
# at 28701
#260914 15:40:29 server id 1  end_log_pos 28775 CRC32 0x13b8fb87 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 28775
#260914 15:40:29 server id 1  end_log_pos 29999 CRC32 0x41bc5748 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
/bKnahMBAAAASgAAAGdwAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4If7uBM=
/bKnah8BAAAAyAQAAC91AAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPTuwp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPf2yp2pIV7xB
'/*!*/;
# at 29999
#260914 15:40:29 server id 1  end_log_pos 30030 CRC32 0xa44e067c 	Xid = 399
COMMIT/*!*/;
# at 30030
#260914 15:40:33 server id 1  end_log_pos 30109 CRC32 0xdc35d0ee 	Anonymous_GTID	last_committed=30	sequence_number=31	rbr_only=yes	original_committed_timestamp=1789375233616334	immediate_commit_timestamp=1789375233616334	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375233616334 (2026-09-14 15:40:33.616334 SE Asia Standard Time)
# immediate_commit_timestamp=1789375233616334 (2026-09-14 15:40:33.616334 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375233616334*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30109
#260914 15:40:33 server id 1  end_log_pos 30199 CRC32 0x99225051 	Query	thread_id=26	exec_time=0	error_code=0
SET TIMESTAMP=1789375233/*!*/;
BEGIN
/*!*/;
# at 30199
#260914 15:40:33 server id 1  end_log_pos 30273 CRC32 0x5d2134dc 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 30273
#260914 15:40:33 server id 1  end_log_pos 31497 CRC32 0xbd31dff5 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
AbOnahMBAAAASgAAAEF2AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Nw0IV0=
AbOnah8BAAAAyAQAAAl7AAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPf2yp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPQGzp2r13zG9
'/*!*/;
# at 31497
#260914 15:40:33 server id 1  end_log_pos 31528 CRC32 0x0070e23f 	Xid = 414
COMMIT/*!*/;
# at 31528
#260914 15:40:34 server id 1  end_log_pos 31607 CRC32 0x26608a36 	Anonymous_GTID	last_committed=31	sequence_number=32	rbr_only=yes	original_committed_timestamp=1789375234651752	immediate_commit_timestamp=1789375234651752	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375234651752 (2026-09-14 15:40:34.651752 SE Asia Standard Time)
# immediate_commit_timestamp=1789375234651752 (2026-09-14 15:40:34.651752 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375234651752*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 31607
#260914 15:40:34 server id 1  end_log_pos 31697 CRC32 0xe759a5de 	Query	thread_id=27	exec_time=0	error_code=0
SET TIMESTAMP=1789375234/*!*/;
BEGIN
/*!*/;
# at 31697
#260914 15:40:34 server id 1  end_log_pos 31771 CRC32 0x58d754db 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 31771
#260914 15:40:34 server id 1  end_log_pos 32995 CRC32 0xfda8b020 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
ArOnahMBAAAASgAAABt8AAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4NtU11g=
ArOnah8BAAAAyAQAAOOAAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQGzp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPQKzp2ogsKj9
'/*!*/;
# at 32995
#260914 15:40:34 server id 1  end_log_pos 33026 CRC32 0x608a226e 	Xid = 432
COMMIT/*!*/;
# at 33026
#260914 15:40:37 server id 1  end_log_pos 33105 CRC32 0xb2b00ca1 	Anonymous_GTID	last_committed=32	sequence_number=33	rbr_only=yes	original_committed_timestamp=1789375237057995	immediate_commit_timestamp=1789375237057995	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375237057995 (2026-09-14 15:40:37.057995 SE Asia Standard Time)
# immediate_commit_timestamp=1789375237057995 (2026-09-14 15:40:37.057995 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375237057995*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 33105
#260914 15:40:37 server id 1  end_log_pos 33195 CRC32 0x9fbc9aa4 	Query	thread_id=28	exec_time=0	error_code=0
SET TIMESTAMP=1789375237/*!*/;
BEGIN
/*!*/;
# at 33195
#260914 15:40:37 server id 1  end_log_pos 33269 CRC32 0xdf7ff353 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 33269
#260914 15:40:37 server id 1  end_log_pos 34489 CRC32 0xfcdf3270 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
BbOnahMBAAAASgAAAPWBAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4FPzf98=
BbOnah8BAAAAxAQAALmGAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQKzp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzaYAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5dVpYZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcx
cGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pvek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1
WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVP
RGxrSWp0cE9qUTdmUT09BbOnanAy3/w=
'/*!*/;
# at 34489
#260914 15:40:37 server id 1  end_log_pos 34520 CRC32 0x57160ab9 	Xid = 450
COMMIT/*!*/;
# at 34520
#260914 15:40:39 server id 1  end_log_pos 34599 CRC32 0xb271919e 	Anonymous_GTID	last_committed=33	sequence_number=34	rbr_only=yes	original_committed_timestamp=1789375239042168	immediate_commit_timestamp=1789375239042168	transaction_length=1490
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375239042168 (2026-09-14 15:40:39.042168 SE Asia Standard Time)
# immediate_commit_timestamp=1789375239042168 (2026-09-14 15:40:39.042168 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375239042168*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 34599
#260914 15:40:39 server id 1  end_log_pos 34689 CRC32 0xb10b57e8 	Query	thread_id=29	exec_time=0	error_code=0
SET TIMESTAMP=1789375239/*!*/;
BEGIN
/*!*/;
# at 34689
#260914 15:40:39 server id 1  end_log_pos 34763 CRC32 0x4401f50c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 34763
#260914 15:40:39 server id 1  end_log_pos 35979 CRC32 0xb70e1aaf 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
B7OnahMBAAAASgAAAMuHAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Az1AUQ=
B7Onah8BAAAAwAQAAIuMAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09BbOnagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpgB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16STZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTl1WlhkeklqdHpPalU2SW5KdmRYUmxJanR6T2pFMk9pSmhaRzFwYmk1
dVpYZHpMbWx1WkdWNElqdDljem96T2lKMWNtd2lPMkU2TURwN2ZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT0Hs6dqrxoOtw==
'/*!*/;
# at 35979
#260914 15:40:39 server id 1  end_log_pos 36010 CRC32 0x01841559 	Xid = 468
COMMIT/*!*/;
# at 36010
#260914 15:40:39 server id 1  end_log_pos 36089 CRC32 0x83518b18 	Anonymous_GTID	last_committed=34	sequence_number=35	rbr_only=yes	original_committed_timestamp=1789375239818948	immediate_commit_timestamp=1789375239818948	transaction_length=1494
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375239818948 (2026-09-14 15:40:39.818948 SE Asia Standard Time)
# immediate_commit_timestamp=1789375239818948 (2026-09-14 15:40:39.818948 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375239818948*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 36089
#260914 15:40:39 server id 1  end_log_pos 36179 CRC32 0x3e806494 	Query	thread_id=30	exec_time=0	error_code=0
SET TIMESTAMP=1789375239/*!*/;
BEGIN
/*!*/;
# at 36179
#260914 15:40:39 server id 1  end_log_pos 36253 CRC32 0x0da00706 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 36253
#260914 15:40:39 server id 1  end_log_pos 37473 CRC32 0x68c7c05e 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
B7OnahMBAAAASgAAAJ2NAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AYHoA0=
B7Onah8BAAAAxAQAAGGSAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaYAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNekk2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5dVpY
ZHpJanR6T2pVNkluSnZkWFJsSWp0ek9qRTJPaUpoWkcxcGJpNXVaWGR6TG1sdVpHVjRJanQ5Y3pv
ek9pSjFjbXdpTzJFNk1EcDdmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5
WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09B7OnagAoAFhp
M2xwNXhqSlhhaTFnSG5ZUHhUa3ViSVI3SXFxN3lFR1BDS29TQWwEAAAAAAAAAAkxMjcuMC4wLjFv
AE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUz
Ny4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNpwB
AABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVduRkRZMnRUUTA5Nk5YaFNUM2hCUVZW
eWNEaE5TVlZQVERoV1lqUjNOMmMyV1VkUGMwTjVRU0k3Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3
Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1G
a2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6T2pVd09pSnNiMmRw
Ymw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNaalU0WldFMFpUTXdP
VGc1WkNJN2FUbzBPMzA9B7Onal7Ax2g=
'/*!*/;
# at 37473
#260914 15:40:39 server id 1  end_log_pos 37504 CRC32 0x8891525b 	Xid = 495
COMMIT/*!*/;
# at 37504
#260914 15:40:46 server id 1  end_log_pos 37583 CRC32 0x9fb8bce6 	Anonymous_GTID	last_committed=35	sequence_number=36	rbr_only=yes	original_committed_timestamp=1789375246894119	immediate_commit_timestamp=1789375246894119	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375246894119 (2026-09-14 15:40:46.894119 SE Asia Standard Time)
# immediate_commit_timestamp=1789375246894119 (2026-09-14 15:40:46.894119 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375246894119*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 37583
#260914 15:40:46 server id 1  end_log_pos 37673 CRC32 0xadb5ce14 	Query	thread_id=31	exec_time=0	error_code=0
SET TIMESTAMP=1789375246/*!*/;
BEGIN
/*!*/;
# at 37673
#260914 15:40:46 server id 1  end_log_pos 37747 CRC32 0x1bf18979 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 37747
#260914 15:40:46 server id 1  end_log_pos 38971 CRC32 0xe9b6de94 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
DrOnahMBAAAASgAAAHOTAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HmJ8Rs=
DrOnah8BAAAAyAQAADuYAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQezp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPQ6zp2qU3rbp
'/*!*/;
# at 38971
#260914 15:40:46 server id 1  end_log_pos 39002 CRC32 0x87dd24f8 	Xid = 516
COMMIT/*!*/;
# at 39002
#260914 15:40:47 server id 1  end_log_pos 39081 CRC32 0x7cccc5a5 	Anonymous_GTID	last_committed=36	sequence_number=37	rbr_only=yes	original_committed_timestamp=1789375247693223	immediate_commit_timestamp=1789375247693223	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375247693223 (2026-09-14 15:40:47.693223 SE Asia Standard Time)
# immediate_commit_timestamp=1789375247693223 (2026-09-14 15:40:47.693223 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375247693223*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 39081
#260914 15:40:47 server id 1  end_log_pos 39171 CRC32 0x6a474551 	Query	thread_id=32	exec_time=0	error_code=0
SET TIMESTAMP=1789375247/*!*/;
BEGIN
/*!*/;
# at 39171
#260914 15:40:47 server id 1  end_log_pos 39245 CRC32 0xf1d9167f 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 39245
#260914 15:40:47 server id 1  end_log_pos 40469 CRC32 0x3c03af0f 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
D7OnahMBAAAASgAAAE2ZAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4H8W2fE=
D7Onah8BAAAAyAQAABWeAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQ6zp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRV
NkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPQ+zp2oPrwM8
'/*!*/;
# at 40469
#260914 15:40:47 server id 1  end_log_pos 40500 CRC32 0x788c02ff 	Xid = 531
COMMIT/*!*/;
# at 40500
#260914 15:41:00 server id 1  end_log_pos 40579 CRC32 0x45f315bb 	Anonymous_GTID	last_committed=37	sequence_number=38	rbr_only=yes	original_committed_timestamp=1789375260273609	immediate_commit_timestamp=1789375260273609	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375260273609 (2026-09-14 15:41:00.273609 SE Asia Standard Time)
# immediate_commit_timestamp=1789375260273609 (2026-09-14 15:41:00.273609 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375260273609*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 40579
#260914 15:41:00 server id 1  end_log_pos 40669 CRC32 0xfc51f821 	Query	thread_id=33	exec_time=0	error_code=0
SET TIMESTAMP=1789375260/*!*/;
BEGIN
/*!*/;
# at 40669
#260914 15:41:00 server id 1  end_log_pos 40743 CRC32 0x0a8352e8 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 40743
#260914 15:41:00 server id 1  end_log_pos 41967 CRC32 0x4e459502 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
HLOnahMBAAAASgAAACefAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OhSgwo=
HLOnah8BAAAAyAQAAO+jAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lY
Tm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPQ+zp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5bllXeGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1G
a2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPRyzp2oClUVO
'/*!*/;
# at 41967
#260914 15:41:00 server id 1  end_log_pos 41998 CRC32 0x98ccc2ac 	Xid = 546
COMMIT/*!*/;
# at 41998
#260914 15:41:01 server id 1  end_log_pos 42077 CRC32 0x6eb9e15c 	Anonymous_GTID	last_committed=38	sequence_number=39	rbr_only=yes	original_committed_timestamp=1789375261786099	immediate_commit_timestamp=1789375261786099	transaction_length=1498
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789375261786099 (2026-09-14 15:41:01.786099 SE Asia Standard Time)
# immediate_commit_timestamp=1789375261786099 (2026-09-14 15:41:01.786099 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789375261786099*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 42077
#260914 15:41:01 server id 1  end_log_pos 42167 CRC32 0x12d49161 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789375261/*!*/;
BEGIN
/*!*/;
# at 42167
#260914 15:41:01 server id 1  end_log_pos 42241 CRC32 0x7241339c 	Table_map: `pln_up_imy`.`sessions` mapped to number 83
# at 42241
#260914 15:41:01 server id 1  end_log_pos 43465 CRC32 0xa1b48d10 	Update_rows: table id 83 flags: STMT_END_F

BINLOG '
HbOnahMBAAAASgAAAAGlAAAAAFMAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4JwzQXI=
HbOnah8BAAAAyAQAAMmpAAAAAFMAAAAAAAEAAgAG//8AKABYaTNscDV4akpYYWkxZ0huWVB4VGt1
YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvMU9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNoQlFWVnljRGhOU1ZWUFREaFdZalIzTjJj
MldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3
ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pP
aUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5bllX
eGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1Ga2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJ
N2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1Jr
WXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPRyzp2oA
KABYaTNscDV4akpYYWkxZ0huWVB4VGt1YklSN0lxcTd5RUdQQ0tvU0FsBAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzacAQAAWVRvMU9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lXbkZEWTJ0VFEwOTZOWGhTVDNo
QlFWVnljRGhOU1ZWUFREaFdZalIzTjJjMldVZFBjME41UVNJN2N6bzJPaUpmWm14aGMyZ2lPMkU2
TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pvNU9pSmZj
SEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNelE2SW1oMGRIQTZMeTh4TWpjdU1D
NHdMakU2T0RBd01DOWhaRzFwYmk5bllXeGxjbWtpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVGc2SW1G
a2JXbHVMbWRoYkdWeWFTNXBibVJsZUNJN2ZYTTZNem9pZFhKc0lqdGhPakE2ZTMxek9qVXdPaUpz
YjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpKaU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBa
VE13T1RnNVpDSTdhVG8wTzMwPR2zp2oQjbSh
'/*!*/;
# at 43465
#260914 15:41:01 server id 1  end_log_pos 43496 CRC32 0x725bada1 	Xid = 567
COMMIT/*!*/;
# at 43496
#260914 15:42:09 server id 1  end_log_pos 43519 CRC32 0xf8d2f987 	Stop
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
