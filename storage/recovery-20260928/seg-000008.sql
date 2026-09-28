# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 126
#260910  8:23:14 server id 1  end_log_pos 126 CRC32 0x0cd9a5dc 	Start: binlog v 4, server v 8.0.30 created 260910  8:23:14 at startup
ROLLBACK/*!*/;
BINLOG '
ggaiag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAACCBqJqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAAdyl2Qw=
'/*!*/;
# at 157
#260910 14:23:50 server id 1  end_log_pos 236 CRC32 0x5f50f258 	Anonymous_GTID	last_committed=0	sequence_number=1	rbr_only=no	original_committed_timestamp=1789025030152515	immediate_commit_timestamp=1789025030152515	transaction_length=258
# original_commit_timestamp=1789025030152515 (2026-09-10 14:23:50.152515 SE Asia Standard Time)
# immediate_commit_timestamp=1789025030152515 (2026-09-10 14:23:50.152515 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025030152515*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 236
#260910 14:23:50 server id 1  end_log_pos 415 CRC32 0x81b71f67 	Query	thread_id=24	exec_time=0	error_code=0	Xid = 111
SET TIMESTAMP=1789025030/*!*/;
SET @@session.pseudo_thread_id=24/*!*/;
SET @@session.foreign_key_checks=1, @@session.sql_auto_is_null=0, @@session.unique_checks=1, @@session.autocommit=1/*!*/;
SET @@session.sql_mode=1168113696/*!*/;
SET @@session.auto_increment_increment=1, @@session.auto_increment_offset=1/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=45,@@session.collation_connection=224,@@session.collation_server=255/*!*/;
SET @@session.lc_time_names=0/*!*/;
SET @@session.collation_database=DEFAULT/*!*/;
/*!80011 SET @@session.default_collation_for_utf8mb4=255*//*!*/;
/*!80016 SET @@session.default_table_encryption=0*//*!*/;
CREATE DATABASE `pln_up_imy` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci
/*!*/;
# at 415
#260910 14:24:25 server id 1  end_log_pos 494 CRC32 0x0b8b4327 	Anonymous_GTID	last_committed=1	sequence_number=2	rbr_only=no	original_committed_timestamp=1789025065315106	immediate_commit_timestamp=1789025065315106	transaction_length=550
# original_commit_timestamp=1789025065315106 (2026-09-10 14:24:25.315106 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065315106 (2026-09-10 14:24:25.315106 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065315106*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 494
#260910 14:24:25 server id 1  end_log_pos 965 CRC32 0x6cfa900a 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 215
use `pln_up_imy`/*!*/;
SET TIMESTAMP=1789025065/*!*/;
SET @@session.sql_mode=524288/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=255,@@session.collation_connection=255,@@session.collation_server=255/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Database: `pln_up_imy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 965
#260910 14:24:25 server id 1  end_log_pos 1044 CRC32 0xe3f97e7d 	Anonymous_GTID	last_committed=2	sequence_number=3	rbr_only=no	original_committed_timestamp=1789025065330013	immediate_commit_timestamp=1789025065330013	transaction_length=531
# original_commit_timestamp=1789025065330013 (2026-09-10 14:24:25.330013 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065330013 (2026-09-10 14:24:25.330013 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065330013*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 1044
#260910 14:24:25 server id 1  end_log_pos 1496 CRC32 0x940a4e1e 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 216
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 1496
#260910 14:24:25 server id 1  end_log_pos 1575 CRC32 0x6bd8f851 	Anonymous_GTID	last_committed=3	sequence_number=4	rbr_only=no	original_committed_timestamp=1789025065341252	immediate_commit_timestamp=1789025065341252	transaction_length=765
# original_commit_timestamp=1789025065341252 (2026-09-10 14:24:25.341252 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065341252 (2026-09-10 14:24:25.341252 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065341252*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 1575
#260910 14:24:25 server id 1  end_log_pos 2261 CRC32 0x880baa00 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 217
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 2261
#260910 14:24:25 server id 1  end_log_pos 2340 CRC32 0x2213f7ff 	Anonymous_GTID	last_committed=4	sequence_number=5	rbr_only=no	original_committed_timestamp=1789025065349045	immediate_commit_timestamp=1789025065349045	transaction_length=682
# original_commit_timestamp=1789025065349045 (2026-09-10 14:24:25.349045 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065349045 (2026-09-10 14:24:25.349045 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065349045*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 2340
#260910 14:24:25 server id 1  end_log_pos 2943 CRC32 0x8d1379a0 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 218
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 2943
#260910 14:24:25 server id 1  end_log_pos 3022 CRC32 0xa879b4f9 	Anonymous_GTID	last_committed=5	sequence_number=6	rbr_only=no	original_committed_timestamp=1789025065358787	immediate_commit_timestamp=1789025065358787	transaction_length=804
# original_commit_timestamp=1789025065358787 (2026-09-10 14:24:25.358787 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065358787 (2026-09-10 14:24:25.358787 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065358787*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3022
#260910 14:24:25 server id 1  end_log_pos 3747 CRC32 0xbda2f900 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 219
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 3747
#260910 14:24:25 server id 1  end_log_pos 3826 CRC32 0x8dfd0ad1 	Anonymous_GTID	last_committed=6	sequence_number=7	rbr_only=no	original_committed_timestamp=1789025065366495	immediate_commit_timestamp=1789025065366495	transaction_length=500
# original_commit_timestamp=1789025065366495 (2026-09-10 14:24:25.366495 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065366495 (2026-09-10 14:24:25.366495 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065366495*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 3826
#260910 14:24:25 server id 1  end_log_pos 4247 CRC32 0x35aebf8f 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 220
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 4247
#260910 14:24:25 server id 1  end_log_pos 4326 CRC32 0xa2315b95 	Anonymous_GTID	last_committed=7	sequence_number=8	rbr_only=yes	original_committed_timestamp=1789025065373437	immediate_commit_timestamp=1789025065373437	transaction_length=617
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025065373437 (2026-09-10 14:24:25.373437 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065373437 (2026-09-10 14:24:25.373437 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065373437*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4326
#260910 14:24:25 server id 1  end_log_pos 4407 CRC32 0x7fd3a401 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789025065/*!*/;
BEGIN
/*!*/;
# at 4407
#260910 14:24:25 server id 1  end_log_pos 4476 CRC32 0x99165981 	Table_map: `pln_up_imy`.`migrations` mapped to number 97
# at 4476
#260910 14:24:25 server id 1  end_log_pos 4833 CRC32 0xc9786d8a 	Write_rows: table id 97 flags: STMT_END_F

BINLOG '
KVuiahMBAAAARQAAAHwRAAAAAGEAAAAAAAEACnBsbl91cF9pbXkACm1pZ3JhdGlvbnMAAwMPAwL8
AwABAYACAeCBWRaZ
KVuiah4BAAAAZQEAAOESAAAAAGEAAAAAAAEAAgAD/wABAAAAJAAwMDAxXzAxXzAxXzAwMDAwMF9j
cmVhdGVfdXNlcnNfdGFibGUBAAAAAAIAAAAkADAwMDFfMDFfMDFfMDAwMDAxX2NyZWF0ZV9jYWNo
ZV90YWJsZQEAAAAAAwAAACMAMDAwMV8wMV8wMV8wMDAwMDJfY3JlYXRlX2pvYnNfdGFibGUBAAAA
AAQAAAA4ADIwMjZfMDlfMDlfMDIwNTE0X2FkZF91c2VyX3Byb2ZpbGVfZmllbGRzX3RvX3VzZXJz
X3RhYmxlAQAAAAAFAAAAMQAyMDI2XzA5XzEwXzAwMDAwMV9jcmVhdGVfcm9sZXNfcGVybWlzc2lv
bnNfdGFibGVzAQAAAAAGAAAALAAyMDI2XzA5XzEwXzAwMDAwMl9hZGRfcm9sZV9pZF90b191c2Vy
c190YWJsZQIAAACKbXjJ
'/*!*/;
# at 4833
#260910 14:24:25 server id 1  end_log_pos 4864 CRC32 0xc7662ba4 	Xid = 221
COMMIT/*!*/;
# at 4864
#260910 14:24:25 server id 1  end_log_pos 4943 CRC32 0x972fa749 	Anonymous_GTID	last_committed=8	sequence_number=9	rbr_only=no	original_committed_timestamp=1789025065383354	immediate_commit_timestamp=1789025065383354	transaction_length=570
# original_commit_timestamp=1789025065383354 (2026-09-10 14:24:25.383354 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065383354 (2026-09-10 14:24:25.383354 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065383354*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 4943
#260910 14:24:25 server id 1  end_log_pos 5434 CRC32 0xb4d0d4fa 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 222
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 5434
#260910 14:24:25 server id 1  end_log_pos 5513 CRC32 0x66940358 	Anonymous_GTID	last_committed=9	sequence_number=10	rbr_only=no	original_committed_timestamp=1789025065391697	immediate_commit_timestamp=1789025065391697	transaction_length=702
# original_commit_timestamp=1789025065391697 (2026-09-10 14:24:25.391697 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065391697 (2026-09-10 14:24:25.391697 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065391697*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 5513
#260910 14:24:25 server id 1  end_log_pos 6136 CRC32 0x703f2b54 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 223
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 6136
#260910 14:24:25 server id 1  end_log_pos 6215 CRC32 0x23d02fb6 	Anonymous_GTID	last_committed=10	sequence_number=11	rbr_only=yes	original_committed_timestamp=1789025065394670	immediate_commit_timestamp=1789025065394670	transaction_length=2554
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025065394670 (2026-09-10 14:24:25.394670 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065394670 (2026-09-10 14:24:25.394670 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065394670*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 6215
#260910 14:24:25 server id 1  end_log_pos 6304 CRC32 0xf7700bd2 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789025065/*!*/;
SET @@session.time_zone='+00:00'/*!*/;
BEGIN
/*!*/;
# at 6304
#260910 14:24:25 server id 1  end_log_pos 6383 CRC32 0x551388d8 	Table_map: `pln_up_imy`.`permissions` mapped to number 98
# at 6383
#260910 14:24:25 server id 1  end_log_pos 8659 CRC32 0x1839f5de 	Write_rows: table id 98 flags: STMT_END_F

BINLOG '
KVuiahMBAAAATwAAAO8YAAAAAGIAAAAAAAEACnBsbl91cF9pbXkAC3Blcm1pc3Npb25zAAYIDw8P
EREIkAH8A/wDAAA8AQGAAgHg2IgTVQ==
KVuiah4BAAAA5AgAANMhAAAAAGIAAAAAAAEAAgAG/wABAAAAAAAAAA4AZGFzaGJvYXJkLnZpZXcP
AExpaGF0IERhc2hib2FyZAkARGFzaGJvYXJkaqG5jmqhuY4AAgAAAAAAAAAKAHVzZXJzLnZpZXcO
AExpaGF0IFBlbmdndW5hDwBVc2VyIE1hbmFnZW1lbnRqobmOaqG5jgADAAAAAAAAAAwAdXNlcnMu
Y3JlYXRlDwBUYW1iYWggUGVuZ2d1bmEPAFVzZXIgTWFuYWdlbWVudGqhuY5qobmOAAQAAAAAAAAA
CgB1c2Vycy5lZGl0DQBFZGl0IFBlbmdndW5hDwBVc2VyIE1hbmFnZW1lbnRqobmOaqG5jgAFAAAA
AAAAAAwAdXNlcnMuZGVsZXRlDgBIYXB1cyBQZW5nZ3VuYQ8AVXNlciBNYW5hZ2VtZW50aqG5jmqh
uY4ABgAAAAAAAAAKAHJvbGVzLnZpZXcKAExpaGF0IFJvbGUPAFJvbGUgTWFuYWdlbWVudGqhuY5q
obmOAAcAAAAAAAAADAByb2xlcy5jcmVhdGULAFRhbWJhaCBSb2xlDwBSb2xlIE1hbmFnZW1lbnRq
obmOaqG5jgAIAAAAAAAAAAoAcm9sZXMuZWRpdAkARWRpdCBSb2xlDwBSb2xlIE1hbmFnZW1lbnRq
obmOaqG5jgAJAAAAAAAAAAwAcm9sZXMuZGVsZXRlCgBIYXB1cyBSb2xlDwBSb2xlIE1hbmFnZW1l
bnRqobmOaqG5jgAKAAAAAAAAABcAcm9sZXMuYXNzaWduX3Blcm1pc3Npb24RAEtlbG9sYSBQZXJt
aXNzaW9uDwBSb2xlIE1hbmFnZW1lbnRqobmOaqG5jgALAAAAAAAAAAkAbmV3cy52aWV3DABMaWhh
dCBCZXJpdGEEAE5ld3NqobmOaqG5jgAMAAAAAAAAAAsAbmV3cy5jcmVhdGUNAFRhbWJhaCBCZXJp
dGEEAE5ld3NqobmOaqG5jgANAAAAAAAAAAkAbmV3cy5lZGl0CwBFZGl0IEJlcml0YQQATmV3c2qh
uY5qobmOAA4AAAAAAAAACwBuZXdzLmRlbGV0ZQwASGFwdXMgQmVyaXRhBABOZXdzaqG5jmqhuY4A
DwAAAAAAAAAMAG5ld3MucHVibGlzaA4AUHVibGlzaCBCZXJpdGEEAE5ld3NqobmOaqG5jgAQAAAA
AAAAAAoAcGFnZXMudmlldw0ATGloYXQgSGFsYW1hbg8AUGFnZSBNYW5hZ2VtZW50aqG5jmqhuY4A
EQAAAAAAAAAMAHBhZ2VzLmNyZWF0ZQ4AVGFtYmFoIEhhbGFtYW4PAFBhZ2UgTWFuYWdlbWVudGqh
uY5qobmOABIAAAAAAAAACgBwYWdlcy5lZGl0DABFZGl0IEhhbGFtYW4PAFBhZ2UgTWFuYWdlbWVu
dGqhuY5qobmOABMAAAAAAAAADABwYWdlcy5kZWxldGUNAEhhcHVzIEhhbGFtYW4PAFBhZ2UgTWFu
YWdlbWVudGqhuY5qobmOABQAAAAAAAAACgBtZW51cy52aWV3CgBMaWhhdCBNZW51DwBNZW51IE1h
bmFnZW1lbnRqobmOaqG5jgAVAAAAAAAAAAwAbWVudXMuY3JlYXRlCwBUYW1iYWggTWVudQ8ATWVu
dSBNYW5hZ2VtZW50aqG5jmqhuY4AFgAAAAAAAAAKAG1lbnVzLmVkaXQJAEVkaXQgTWVudQ8ATWVu
dSBNYW5hZ2VtZW50aqG5jmqhuY4AFwAAAAAAAAAMAG1lbnVzLmRlbGV0ZQoASGFwdXMgTWVudQ8A
TWVudSBNYW5hZ2VtZW50aqG5jmqhuY4AGAAAAAAAAAARAGFwcGxpY2F0aW9ucy52aWV3DgBMaWhh
dCBBcGxpa2FzaRYAQXBwbGljYXRpb24gTWFuYWdlbWVudGqhuY5qobmOABkAAAAAAAAAEwBhcHBs
aWNhdGlvbnMuY3JlYXRlDwBUYW1iYWggQXBsaWthc2kWAEFwcGxpY2F0aW9uIE1hbmFnZW1lbnRq
obmOaqG5jgAaAAAAAAAAABEAYXBwbGljYXRpb25zLmVkaXQNAEVkaXQgQXBsaWthc2kWAEFwcGxp
Y2F0aW9uIE1hbmFnZW1lbnRqobmOaqG5jgAbAAAAAAAAABMAYXBwbGljYXRpb25zLmRlbGV0ZQ4A
SGFwdXMgQXBsaWthc2kWAEFwcGxpY2F0aW9uIE1hbmFnZW1lbnRqobmOaqG5jgAcAAAAAAAAAAsA
Z3JvdXBzLnZpZXcTAExpaGF0IEdydXAgS2FyeWF3YW4OAEVtcGxveWVlIEdyb3VwaqG5jmqhuY4A
HQAAAAAAAAANAGdyb3Vwcy5jcmVhdGUUAFRhbWJhaCBHcnVwIEthcnlhd2FuDgBFbXBsb3llZSBH
cm91cGqhuY5qobmOAB4AAAAAAAAACwBncm91cHMuZWRpdBIARWRpdCBHcnVwIEthcnlhd2FuDgBF
bXBsb3llZSBHcm91cGqhuY5qobmOAB8AAAAAAAAADQBncm91cHMuZGVsZXRlEwBIYXB1cyBHcnVw
IEthcnlhd2FuDgBFbXBsb3llZSBHcm91cGqhuY5qobmOACAAAAAAAAAADQBpbnRlcm5hbC52aWV3
FgBBa3NlcyBIYWxhbWFuIEludGVybmFsDQBJbnRlcm5hbCBQYWdlaqG5jmqhuY4AIQAAAAAAAAAS
AGFjdGl2aXR5X2xvZ3MudmlldxMATGloYXQgTG9nIEFrdGl2aXRhcwwAQWN0aXZpdHkgTG9naqG5
jmqhuY4AIgAAAAAAAAANAHNldHRpbmdzLnZpZXcQAExpaGF0IFBlbmdhdHVyYW4IAFNldHRpbmdz
aqG5jmqhuY4AIwAAAAAAAAANAHNldHRpbmdzLmVkaXQPAEVkaXQgUGVuZ2F0dXJhbggAU2V0dGlu
Z3NqobmOaqG5jgAkAAAAAAAAAAYAbG9nb3V0BgBMb2dvdXQEAEF1dGhqobmOaqG5jt71ORg=
'/*!*/;
# at 8659
#260910 14:24:25 server id 1  end_log_pos 8690 CRC32 0x36f9ad66 	Xid = 224
COMMIT/*!*/;
# at 8690
#260910 14:24:25 server id 1  end_log_pos 8769 CRC32 0x3ea53ee9 	Anonymous_GTID	last_committed=11	sequence_number=12	rbr_only=no	original_committed_timestamp=1789025065402273	immediate_commit_timestamp=1789025065402273	transaction_length=668
# original_commit_timestamp=1789025065402273 (2026-09-10 14:24:25.402273 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065402273 (2026-09-10 14:24:25.402273 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065402273*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 8769
#260910 14:24:25 server id 1  end_log_pos 9358 CRC32 0x05b2f939 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 225
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 9358
#260910 14:24:25 server id 1  end_log_pos 9437 CRC32 0xa50f2159 	Anonymous_GTID	last_committed=12	sequence_number=13	rbr_only=yes	original_committed_timestamp=1789025065405438	immediate_commit_timestamp=1789025065405438	transaction_length=416
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025065405438 (2026-09-10 14:24:25.405438 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065405438 (2026-09-10 14:24:25.405438 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065405438*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 9437
#260910 14:24:25 server id 1  end_log_pos 9526 CRC32 0xc3802802 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789025065/*!*/;
BEGIN
/*!*/;
# at 9526
#260910 14:24:25 server id 1  end_log_pos 9597 CRC32 0x81a6a4ad 	Table_map: `pln_up_imy`.`roles` mapped to number 99
# at 9597
#260910 14:24:25 server id 1  end_log_pos 9743 CRC32 0x0f49bce3 	Write_rows: table id 99 flags: STMT_END_F

BINLOG '
KVuiahMBAAAARwAAAH0lAAAAAGMAAAAAAAEACnBsbl91cF9pbXkABXJvbGVzAAYIDw8BEREGkAH8
AwAANAEBgAIB4K2kpoE=
KVuiah4BAAAAkgAAAA8mAAAAAGMAAAAAAAEAAgAG/wABAAAAAAAAAA0AQWRtaW5pc3RyYXRvchIA
QWtzZXMgcGVudWggc2lzdGVtAWqhuY5qobmOAAIAAAAAAAAACABLYXJ5YXdhbhwAUGVuZ2d1bmEg
aW50ZXJuYWwgLyBrYXJ5YXdhbgFqobmOaqG5juO8SQ8=
'/*!*/;
# at 9743
#260910 14:24:25 server id 1  end_log_pos 9774 CRC32 0x87221911 	Xid = 226
COMMIT/*!*/;
# at 9774
#260910 14:24:25 server id 1  end_log_pos 9853 CRC32 0xc2693199 	Anonymous_GTID	last_committed=13	sequence_number=14	rbr_only=no	original_committed_timestamp=1789025065414893	immediate_commit_timestamp=1789025065414893	transaction_length=597
# original_commit_timestamp=1789025065414893 (2026-09-10 14:24:25.414893 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065414893 (2026-09-10 14:24:25.414893 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065414893*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 9853
#260910 14:24:25 server id 1  end_log_pos 10371 CRC32 0x2f53d18e 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 227
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 10371
#260910 14:24:25 server id 1  end_log_pos 10450 CRC32 0x0fd7d8cf 	Anonymous_GTID	last_committed=14	sequence_number=15	rbr_only=yes	original_committed_timestamp=1789025065418112	immediate_commit_timestamp=1789025065418112	transaction_length=1693
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025065418112 (2026-09-10 14:24:25.418112 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065418112 (2026-09-10 14:24:25.418112 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065418112*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 10450
#260910 14:24:25 server id 1  end_log_pos 10539 CRC32 0x915d318b 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789025065/*!*/;
BEGIN
/*!*/;
# at 10539
#260910 14:24:25 server id 1  end_log_pos 10612 CRC32 0xa97dbffd 	Table_map: `pln_up_imy`.`role_permission` mapped to number 100
# at 10612
#260910 14:24:25 server id 1  end_log_pos 12033 CRC32 0x811000c5 	Write_rows: table id 100 flags: STMT_END_F

BINLOG '
KVuiahMBAAAASQAAAHQpAAAAAGQAAAAAAAEACnBsbl91cF9pbXkAD3JvbGVfcGVybWlzc2lvbgAF
CAgIERECAAAYAQHg/b99qQ==
KVuiah4BAAAAjQUAAAEvAAAAAGQAAAAAAAEAAgAF/wABAAAAAAAAAAEAAAAAAAAAAQAAAAAAAABq
obmOaqG5jgACAAAAAAAAAAEAAAAAAAAAAgAAAAAAAABqobmOaqG5jgADAAAAAAAAAAEAAAAAAAAA
AwAAAAAAAABqobmOaqG5jgAEAAAAAAAAAAEAAAAAAAAABAAAAAAAAABqobmOaqG5jgAFAAAAAAAA
AAEAAAAAAAAABQAAAAAAAABqobmOaqG5jgAGAAAAAAAAAAEAAAAAAAAABgAAAAAAAABqobmOaqG5
jgAHAAAAAAAAAAEAAAAAAAAABwAAAAAAAABqobmOaqG5jgAIAAAAAAAAAAEAAAAAAAAACAAAAAAA
AABqobmOaqG5jgAJAAAAAAAAAAEAAAAAAAAACQAAAAAAAABqobmOaqG5jgAKAAAAAAAAAAEAAAAA
AAAACgAAAAAAAABqobmOaqG5jgALAAAAAAAAAAEAAAAAAAAACwAAAAAAAABqobmOaqG5jgAMAAAA
AAAAAAEAAAAAAAAADAAAAAAAAABqobmOaqG5jgANAAAAAAAAAAEAAAAAAAAADQAAAAAAAABqobmO
aqG5jgAOAAAAAAAAAAEAAAAAAAAADgAAAAAAAABqobmOaqG5jgAPAAAAAAAAAAEAAAAAAAAADwAA
AAAAAABqobmOaqG5jgAQAAAAAAAAAAEAAAAAAAAAEAAAAAAAAABqobmOaqG5jgARAAAAAAAAAAEA
AAAAAAAAEQAAAAAAAABqobmOaqG5jgASAAAAAAAAAAEAAAAAAAAAEgAAAAAAAABqobmOaqG5jgAT
AAAAAAAAAAEAAAAAAAAAEwAAAAAAAABqobmOaqG5jgAUAAAAAAAAAAEAAAAAAAAAFAAAAAAAAABq
obmOaqG5jgAVAAAAAAAAAAEAAAAAAAAAFQAAAAAAAABqobmOaqG5jgAWAAAAAAAAAAEAAAAAAAAA
FgAAAAAAAABqobmOaqG5jgAXAAAAAAAAAAEAAAAAAAAAFwAAAAAAAABqobmOaqG5jgAYAAAAAAAA
AAEAAAAAAAAAGAAAAAAAAABqobmOaqG5jgAZAAAAAAAAAAEAAAAAAAAAGQAAAAAAAABqobmOaqG5
jgAaAAAAAAAAAAEAAAAAAAAAGgAAAAAAAABqobmOaqG5jgAbAAAAAAAAAAEAAAAAAAAAGwAAAAAA
AABqobmOaqG5jgAcAAAAAAAAAAEAAAAAAAAAHAAAAAAAAABqobmOaqG5jgAdAAAAAAAAAAEAAAAA
AAAAHQAAAAAAAABqobmOaqG5jgAeAAAAAAAAAAEAAAAAAAAAHgAAAAAAAABqobmOaqG5jgAfAAAA
AAAAAAEAAAAAAAAAHwAAAAAAAABqobmOaqG5jgAgAAAAAAAAAAEAAAAAAAAAIAAAAAAAAABqobmO
aqG5jgAhAAAAAAAAAAEAAAAAAAAAIQAAAAAAAABqobmOaqG5jgAiAAAAAAAAAAEAAAAAAAAAIgAA
AAAAAABqobmOaqG5jgAjAAAAAAAAAAEAAAAAAAAAIwAAAAAAAABqobmOaqG5jgAkAAAAAAAAAAEA
AAAAAAAAJAAAAAAAAABqobmOaqG5jgAlAAAAAAAAAAIAAAAAAAAAAQAAAAAAAABqobmOaqG5jgAm
AAAAAAAAAAIAAAAAAAAACwAAAAAAAABqobmOaqG5jgAnAAAAAAAAAAIAAAAAAAAAEAAAAAAAAABq
obmOaqG5jgAoAAAAAAAAAAIAAAAAAAAAGAAAAAAAAABqobmOaqG5jgApAAAAAAAAAAIAAAAAAAAA
IAAAAAAAAABqobmOaqG5jgAqAAAAAAAAAAIAAAAAAAAAJAAAAAAAAABqobmOaqG5jsUAEIE=
'/*!*/;
# at 12033
#260910 14:24:25 server id 1  end_log_pos 12064 CRC32 0x0d434ffe 	Xid = 228
COMMIT/*!*/;
# at 12064
#260910 14:24:25 server id 1  end_log_pos 12143 CRC32 0x2d979fc2 	Anonymous_GTID	last_committed=15	sequence_number=16	rbr_only=no	original_committed_timestamp=1789025065428484	immediate_commit_timestamp=1789025065428484	transaction_length=579
# original_commit_timestamp=1789025065428484 (2026-09-10 14:24:25.428484 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065428484 (2026-09-10 14:24:25.428484 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065428484*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12143
#260910 14:24:25 server id 1  end_log_pos 12643 CRC32 0x34a53db3 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 229
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 12643
#260910 14:24:25 server id 1  end_log_pos 12722 CRC32 0xfa225ebd 	Anonymous_GTID	last_committed=16	sequence_number=17	rbr_only=no	original_committed_timestamp=1789025065440105	immediate_commit_timestamp=1789025065440105	transaction_length=683
# original_commit_timestamp=1789025065440105 (2026-09-10 14:24:25.440105 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065440105 (2026-09-10 14:24:25.440105 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065440105*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 12722
#260910 14:24:25 server id 1  end_log_pos 13326 CRC32 0x561382d8 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 230
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 13326
#260910 14:24:25 server id 1  end_log_pos 13405 CRC32 0x21ae0d44 	Anonymous_GTID	last_committed=17	sequence_number=18	rbr_only=yes	original_committed_timestamp=1789025065443719	immediate_commit_timestamp=1789025065443719	transaction_length=7618
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025065443719 (2026-09-10 14:24:25.443719 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065443719 (2026-09-10 14:24:25.443719 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065443719*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 13405
#260910 14:24:25 server id 1  end_log_pos 13486 CRC32 0x3b930a2a 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789025065/*!*/;
BEGIN
/*!*/;
# at 13486
#260910 14:24:25 server id 1  end_log_pos 13560 CRC32 0x94e4c949 	Table_map: `pln_up_imy`.`sessions` mapped to number 101
# at 13560
#260910 14:24:25 server id 1  end_log_pos 20913 CRC32 0x668c017c 	Write_rows: table id 101 flags: STMT_END_F

BINLOG '
KVuiahMBAAAASgAAAPg0AAAAAGUAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EnJ5JQ=
KVuiah4BAAAAuRwAALFRAAAAAGUAAAAAAAEAAgAG/wIoADJNYmRpaEExeDBNRjZJQTM0UDA5NlBn
RGRERzdRNWhzTVNxNFVzTjkJMTI3LjAuMC4xCwBjdXJsLzguMjEuMCABAABZVG96T250ek9qWTZJ
bDkwYjJ0bGJpSTdjem8wTURvaVdYbHRkbmxIYVZaVWFXcFVNVEJ6YUUxNGJYaGllSFpCVlVkRU5F
OXRSMjVMTldwNmEyRk5WeUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213
aU8zTTZNek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3
Y3pvMU9pSnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZl
M002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYMD1lTqJqAigANDJw
ajU5OXhWZ21xeXVzU0R2cExVcDZjMElYVWllVm1iZFp1UnhVOQkxMjcuMC4wLjELAGN1cmwvOC4y
MS4wIAEAAFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pVWtWa1ZFNWlaRFZCVFV4QldV
eEROblJSYmxjNGMweHpVR1JKT0RBeVVsaFFXRzEwZVcxaVp5STdjem81T2lKZmNISmxkbWx2ZFhN
aU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3
TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZO
am9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lU
b3dPbnQ5ZlgwPWZOomoCKABDT1VUSldNcWF4YThoWGZNZ0dyMk1iRnlkVjlyNEY3a3BObjNQWnJl
CTEyNy4wLjAuMQsAY3VybC84LjIxLjAQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1E
b2llR0ozUTA5V1VIcHdjRWh4TlhWdFExTmthVzgzVVdaUE1tMUZSV1JsUkVKaVVsRjJNbGQ2TVNJ
N2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2
THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDlj
em8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lq
dGhPakE2ZTMxOWZRPT0MTaJqAigAZTRxQ2RTczhDbVVoSUFGM3FQU2o2a2o5QkJxSzVTTnFLaVM0
eU11MwkxMjcuMC4wLjELAGN1cmwvOC4yMS4wkAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pYTBGVmFERnBOVkp4ZGxaQk5GQjRZa1V6YkUxRU5UaHdSV0Z6WkdOYU5FcHBRa3hPUTNG
V09TSTdjem96T2lKMWNtd2lPMkU2TVRwN2N6bzRPaUpwYm5SbGJtUmxaQ0k3Y3pvek16b2lhSFIw
Y0Rvdkx6RXlOeTR3TGpBdU1UbzRNREF3TDJGa2JXbHVMM1Z6WlhKeklqdDljem81T2lKZmNISmxk
bWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xq
RTZPREF3TUM5aFpHMXBiaTkxYzJWeWN5STdjem8xT2lKeWIzVjBaU0k3Y3pveE56b2lZV1J0YVc0
dWRYTmxjbk11YVc1a1pYZ2lPMzF6T2pZNklsOW1iR0Z6YUNJN1lUb3lPbnR6T2pNNkltOXNaQ0k3
WVRvd09udDljem96T2lKdVpYY2lPMkU2TURwN2ZYMTmSUKJqAigARU9HZWQycXdmTXpTTDRiNmE4
c0k2bklRV2JvRXM5UzZQTzRhSUZxbAkxMjcuMC4wLjELAGN1cmwvOC4yMS4wEAEAAFlUb3pPbnR6
T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pYldkVk1EbDZTbU5xTVRsTlkzRnJkV3AzWWpONlNIWTVi
REJKV1ZOb2FtbERTa1pJU2tWeFJ5STdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9p
SjFjbXdpTzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNW
MFpTSTdjem8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1Fp
TzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTlmUT09DU2iagAoAEpCWXpPYUJVNWQ0cWQ5
RmU3enJIWUNQcVJlYlJOM0tFR2NZS1F6djAEAAAAAAAAAAkxMjcuMC4wLjELAGN1cmwvOC4yMS4w
iAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pTXpaWVNscFBNVzFvTm1wVU1sTnhh
bUp6TTNGNGNtRmhOWEJaYW1wUlJGSnRibVo2Vm1jMk5pSTdjem81T2lKZmNISmxkbWx2ZFhNaU8y
RTZNanA3Y3pvek9pSjFjbXdpTzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5
aFpHMXBiaTlrWVhOb1ltOWhjbVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJo
YzJoaWIyRnlaQ0k3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZl
MzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpH
UmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09hFKi
agAoAG4ybTVaWVBBZzZPcFNHbktvdlE4dXRsMFBuZTdqSW92MndjSGNLZU0EAAAAAAAAAAkxMjcu
MC4wLjELAGN1cmwvOC4yMS4wUAMAAFlUbzJPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pV0cw
MlZrUkxha3RSVVc0MFltazFZV0pUTlVWSmNrbE5abE5OTm01S1JtWTJjMHRoUWxSelppSTdjem81
T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhN
amN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9p
SnNiMmRwYmlJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakk2ZTJr
Nk1EdHpPakV3T2lKZmIyeGtYMmx1Y0hWMElqdHBPakU3Y3pvMk9pSmxjbkp2Y25NaU8zMXpPak02
SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXla
amswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2N6b3hNRG9pWDI5c1pG
OXBibkIxZENJN1lUb3hPbnR6T2pVNkltVnRZV2xzSWp0ek9qRTFPaUpoWkcxcGJrQm5iV0ZwYkM1
amIyMGlPMzF6T2pZNkltVnljbTl5Y3lJN1R6b3pNVG9pU1d4c2RXMXBibUYwWlZ4VGRYQndiM0ow
WEZacFpYZEZjbkp2Y2tKaFp5STZNVHA3Y3pvM09pSUFLZ0JpWVdkeklqdGhPakU2ZTNNNk56b2la
R1ZtWVhWc2RDSTdUem95T1RvaVNXeHNkVzFwYm1GMFpWeFRkWEJ3YjNKMFhFMWxjM05oWjJWQ1lX
Y2lPakk2ZTNNNk1URTZJZ0FxQUcxbGMzTmhaMlZ6SWp0aE9qRTZlM002TlRvaVpXMWhhV3dpTzJF
Nk1UcDdhVG93TzNNNk5ETTZJbFJvWlhObElHTnlaV1JsYm5ScFlXeHpJR1J2SUc1dmRDQnRZWFJq
YUNCdmRYSWdjbVZqYjNKa2N5NGlPMzE5Y3pvNU9pSUFLZ0JtYjNKdFlYUWlPM002T0RvaU9tMWxj
M05oWjJVaU8zMTlmWDA9YlKiagIoAG9jZm9ibVNpMnhhd01lNnNNamV5UmVYRTNiUGNtSlZHZEU4
ZlVXeXoJMTI3LjAuMC4xCwBjdXJsLzguMjEuMJgBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdj
em8wTURvaVltbEdZWHBZTlZsVmJYcDNXRU53V1ZSdlJrMUdNSFp3ZEdSVk0xWldjV3RMY2t0b2VU
QmpkeUk3Y3pvek9pSjFjbXdpTzJFNk1UcDdjem80T2lKcGJuUmxibVJsWkNJN2N6b3pOem9pYUhS
MGNEb3ZMekV5Tnk0d0xqQXVNVG80TURBd0wyRmtiV2x1TDJSaGMyaGliMkZ5WkNJN2ZYTTZPVG9p
WDNCeVpYWnBiM1Z6SWp0aE9qSTZlM002TXpvaWRYSnNJanR6T2pNM09pSm9kSFJ3T2k4dk1USTNM
akF1TUM0eE9qZ3dNREF2WVdSdGFXNHZaR0Z6YUdKdllYSmtJanR6T2pVNkluSnZkWFJsSWp0ek9q
RTFPaUpoWkcxcGJpNWtZWE5vWW05aGNtUWlPMzF6T2pZNklsOW1iR0Z6YUNJN1lUb3lPbnR6T2pN
NkltOXNaQ0k3WVRvd09udDljem96T2lKdVpYY2lPMkU2TURwN2ZYMTkTTaJqAigAb1VOeHpuYTRt
MzVjeDVOTzE3WFdYdjhkdjd6ODFvNUhBVlNBTEt6awkxMjcuMC4wLjELAGN1cmwvOC4yMS4wEAEA
AFlUb3pPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pYkhNeFNFUjRhMDR3WVRCU1IzUjBlVFJu
Ym0xV01WSXhNWFZOT0ZoSFdGaHZWSFZUU3pkdU1pSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZN
anA3Y3pvek9pSjFjbXdpTzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6
bzFPaUp5YjNWMFpTSTdjem8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pv
ek9pSnZiR1FpTzJFNk1EcDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTlmUT09AE2iagIoAHAzdHdp
WmEzSXdwcWNzMUlwV3BGRUtRY2F3SWxud1RoM2VmOFNZWGQJMTI3LjAuMC4xCwBjdXJsLzguMjEu
MBABAABZVG96T250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVZYVkNlV1ZXYUhKaVRqUjVPVkpJ
WkRSck1YUklTMWhMUTFSbU1UVTFkSE54TVhWSlNrSnFVaUk3Y3pvNU9pSmZjSEpsZG1sdmRYTWlP
MkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01D
STdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpw
N2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5ZlE9PQ1NomoCKABz
M01WS3BKTDVla2dlcVJkUkRNekZxbHFpMmdOdGs2SXVkRzhEOFF4CTEyNy4wLjAuMQsAY3VybC84
LjIxLjAQAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2laR3R5Y0d4YVQwcDZOa1pw
TVV0c1ZXVkVRbFl4ZVdsdVlWSmpVV2h0UTBGTGRFaDBXV3RpTkNJN2N6bzVPaUpmY0hKbGRtbHZk
WE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9E
QXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJF
Nk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWZRPT3sTKJq
ABIAdGVzdF82YWEyNTA5YjVhNTg4AQAAAAAAAAAJMTI3LjAuMC4xBAB0ZXN0eAAAAFlUb3pPbnR6
T2pZNklsOTBiMnRsYmlJN2N6bzBPaUowWlhOMElqdHpPakV6T2lKZmNISmxkbWx2ZFhOZmRYSnNJ
anR6T2pFeU9pSXZZV1J0YVc0dmRYTmxjbk1pTzNNNk9Eb2liRzluYVc1ZmFXUWlPMms2TVR0OZtQ
omoCKAB2M1Z4S292cWNUN0ZGS3ZsYXJRNXB3RGIybmc2eE1tcUFveUt2bWtUCTEyNy4wLjAuMQsA
Y3VybC84LjIxLjCQAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lURGhJTXpWdWJ6
SXhaa2gzYzNwRGFFaDBaMFJHVjNkSFdIaFhVREJrYjIxUFdFTmxaV05HYXlJN2N6bzVPaUpmY0hK
bGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3
TGpFNk9EQXdNQzloWkcxcGJpOTFjMlZ5Y3lJN2N6bzFPaUp5YjNWMFpTSTdjem94TnpvaVlXUnRh
VzR1ZFhObGNuTXVhVzVrWlhnaU8zMXpPalk2SWw5bWJHRnphQ0k3WVRveU9udHpPak02SW05c1pD
STdZVG93T250OWN6b3pPaUp1WlhjaU8yRTZNRHA3Zlgxek9qTTZJblZ5YkNJN1lUb3hPbnR6T2pn
NkltbHVkR1Z1WkdWa0lqdHpPak16T2lKb2RIUndPaTh2TVRJM0xqQXVNQzR4T2pnd01EQXZZV1J0
YVc0dmRYTmxjbk1pTzMxOaVQomoCKABWSGtDVE1zVGlaV01JUkhQczBTZUVCVTMyMzhpdXVZa1Rj
eURRc2lXCTEyNy4wLjAuMQsAY3VybC84LjIxLjAgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3
Y3pvME1Eb2lTMEZwUzFaSWFtaGxia1JwZGxjeVNWUlhTbmg1VEZWMVR6VXhlRlE0T1c1VGQyZEhR
alZTWXlJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNklt
aDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNW
MFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhr
SWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9ZU6iagAoAHZ3aHg1YmU0b2NKTlNt
U0gwNVUyU0pjRm1WVkxjQzNGVDlMVUFSUXAEAAAAAAAAAAkxMjcuMC4wLjELAGN1cmwvOC4yMS4w
dAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pZW1sMVRrRlZURWxQUlV4UVMwVjZT
VXQ1T1ZwTk5GcHNNMUJyZFhkcmEyNHlUM2RTT0RWVmNTSTdjem81T2lKZmNISmxkbWx2ZFhNaU8y
RTZNanA3Y3pvek9pSjFjbXdpTzNNNk16TTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5
aFpHMXBiaTlzYjJkcGJpSTdjem8xT2lKeWIzVjBaU0k3Y3pvMU9pSnNiMmRwYmlJN2ZYTTZOam9p
WDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dP
bnQ5ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1E
RTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PVZSomoAKAB4akx5SzdGM0tLSTJBY0Np
Q05CME9HTkU1aDljM0pUWThsOE1FeTZBBAAAAAAAAAAJMTI3LjAuMC4xUABNb3ppbGxhLzUuMCAo
V2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0OyBydjoxNTUuMCkgR2Vja28vMjAxMDAxMDEgRmly
ZWZveC8xNTUuMJwBAABZVG8xT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaVVrOTRWM2RHWXpW
M1J6VndWa0Z0Y1VSNGJHaG9UREpXYTBGQ01rdEhPVWR0WTNCNVNsSktNU0k3Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4TWpjdU1DNHdM
akU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlPM002TVRVNklt
RmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4
a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk16b2lkWEpzSWp0aE9qQTZlMzF6
T2pVd09pSnNiMmRwYmw5M1pXSmZOVGxpWVRNMllXUmtZekppTW1ZNU5EQXhOVGd3WmpBeE5HTTNa
alU0WldFMFpUTXdPVGc1WkNJN2FUbzBPMzA9OFeiagAoAFkzb1pFTzdPMGZ6Y0d3dGoyNkhSdTlW
OHp0eFF3ZzZhcjlaWDFjVWgEAAAAAAAAAAkxMjcuMC4wLjELAGN1cmwvOC4yMS4wjAEAAFlUbzBP
bnR6T2pZNklsOTBiMnRsYmlJN2N6bzBNRG9pWm5KQ09IUXpWak5rU0V4UmVsazJjREl5YW1wNmRH
ZFNlWEp6UTBoQ2NXWm1ZbXR2UmtWc1NpSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pv
ek9pSjFjbXdpTzNNNk5EQTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTkx
YzJWeWN5ODBMMlZrYVhRaU8zTTZOVG9pY205MWRHVWlPM002TVRZNkltRmtiV2x1TG5WelpYSnpM
bVZrYVhRaU8zMXpPalk2SWw5bWJHRnphQ0k3WVRveU9udHpPak02SW05c1pDSTdZVG93T250OWN6
b3pPaUp1WlhjaU8yRTZNRHA3Zlgxek9qVXdPaUpzYjJkcGJsOTNaV0pmTlRsaVlUTTJZV1JrWXpK
aU1tWTVOREF4TlRnd1pqQXhOR00zWmpVNFpXRTBaVE13T1RnNVpDSTdhVG8wTzMwPWZUomp8AYxm
'/*!*/;
# at 20913
#260910 14:24:25 server id 1  end_log_pos 20944 CRC32 0xaac2648e 	Xid = 231
COMMIT/*!*/;
# at 20944
#260910 14:24:25 server id 1  end_log_pos 21023 CRC32 0x9160e746 	Anonymous_GTID	last_committed=18	sequence_number=19	rbr_only=no	original_committed_timestamp=1789025065454221	immediate_commit_timestamp=1789025065454221	transaction_length=1024
# original_commit_timestamp=1789025065454221 (2026-09-10 14:24:25.454221 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065454221 (2026-09-10 14:24:25.454221 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065454221*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 21023
#260910 14:24:25 server id 1  end_log_pos 21968 CRC32 0x09b31891 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 232
SET TIMESTAMP=1789025065/*!*/;
SET @@session.explicit_defaults_for_timestamp=1/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*!*/;
# at 21968
#260910 14:24:25 server id 1  end_log_pos 22047 CRC32 0xab90088e 	Anonymous_GTID	last_committed=19	sequence_number=20	rbr_only=yes	original_committed_timestamp=1789025065456394	immediate_commit_timestamp=1789025065456394	transaction_length=608
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025065456394 (2026-09-10 14:24:25.456394 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065456394 (2026-09-10 14:24:25.456394 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065456394*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 22047
#260910 14:24:25 server id 1  end_log_pos 22136 CRC32 0x67b56aa9 	Query	thread_id=34	exec_time=0	error_code=0
SET TIMESTAMP=1789025065/*!*/;
BEGIN
/*!*/;
# at 22136
#260910 14:24:25 server id 1  end_log_pos 22224 CRC32 0x13f0e255 	Table_map: `pln_up_imy`.`users` mapped to number 102
# at 22224
#260910 14:24:25 server id 1  end_log_pos 22545 CRC32 0xa4575618 	Write_rows: table id 102 flags: STMT_END_F

BINLOG '
KVuiahMBAAAAWAAAANBWAAAAAGYAAAAAAAEACnBsbl91cF9pbXkABXVzZXJzAAwIDw8PEQ8P/A8R
EQgQ/AP8A/wDAPwDUAACkAEAANAPAQHAAgHgVeLwEw==
KVuiah4BAAAAQQEAABFYAAAAAGYAAAAAAAEAAgAM///QAQQAAAAAAAAADwBCdWRpIFNhbnRvc28g
SnIPAGFkbWluQGdtYWlsLmNvbQgAS2FyeWF3YW48ACQyeSQxMiRuOUQub0pDbEtMcEgzN0VST1U2
WG5PRjR6N0NaeFRMT2NEcUdWelJzUE9zRXByWnhrUVJRaWqhx4FqofJLAgAAAAAAAAAQAQYAAAAA
AAAACwBqaW1pbiBrb25zYRAAYWRtaW4xQGdtYWlsLmNvbQ0AQWRtaW5pc3RyYXRvcjwAJDJ5JDEy
JFNJUzRUOElobGh6SkZIRUpIVTNYdS5YVjB2cVZJR2dsNFdMU2habnBuL1ZYTGlaZWxYUjlHBzA4
OTU2ODYJAGluZHJhbWF5dWqh7YBqoe4NAQAAAAAAAAAYVlek
'/*!*/;
# at 22545
#260910 14:24:25 server id 1  end_log_pos 22576 CRC32 0x37731c9f 	Xid = 233
COMMIT/*!*/;
# at 22576
#260910 14:24:25 server id 1  end_log_pos 22655 CRC32 0xb5ab84f6 	Anonymous_GTID	last_committed=20	sequence_number=21	rbr_only=no	original_committed_timestamp=1789025065482813	immediate_commit_timestamp=1789025065482813	transaction_length=346
# original_commit_timestamp=1789025065482813 (2026-09-10 14:24:25.482813 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065482813 (2026-09-10 14:24:25.482813 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065482813*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 22655
#260910 14:24:25 server id 1  end_log_pos 22922 CRC32 0xe90878ad 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 234
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`)
/*!*/;
# at 22922
#260910 14:24:25 server id 1  end_log_pos 23001 CRC32 0xe2bbb49f 	Anonymous_GTID	last_committed=21	sequence_number=22	rbr_only=no	original_committed_timestamp=1789025065511402	immediate_commit_timestamp=1789025065511402	transaction_length=328
# original_commit_timestamp=1789025065511402 (2026-09-10 14:24:25.511402 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065511402 (2026-09-10 14:24:25.511402 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065511402*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23001
#260910 14:24:25 server id 1  end_log_pos 23250 CRC32 0xed984b0f 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 235
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`)
/*!*/;
# at 23250
#260910 14:24:25 server id 1  end_log_pos 23329 CRC32 0xf393a916 	Anonymous_GTID	last_committed=22	sequence_number=23	rbr_only=no	original_committed_timestamp=1789025065539769	immediate_commit_timestamp=1789025065539769	transaction_length=323
# original_commit_timestamp=1789025065539769 (2026-09-10 14:24:25.539769 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065539769 (2026-09-10 14:24:25.539769 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065539769*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23329
#260910 14:24:25 server id 1  end_log_pos 23573 CRC32 0x1dedd4f0 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 236
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
/*!*/;
# at 23573
#260910 14:24:25 server id 1  end_log_pos 23652 CRC32 0xb2e5fda6 	Anonymous_GTID	last_committed=23	sequence_number=24	rbr_only=no	original_committed_timestamp=1789025065571980	immediate_commit_timestamp=1789025065571980	transaction_length=296
# original_commit_timestamp=1789025065571980 (2026-09-10 14:24:25.571980 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065571980 (2026-09-10 14:24:25.571980 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065571980*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23652
#260910 14:24:25 server id 1  end_log_pos 23869 CRC32 0x96f1331a 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 237
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`)
/*!*/;
# at 23869
#260910 14:24:25 server id 1  end_log_pos 23948 CRC32 0x722e0e41 	Anonymous_GTID	last_committed=24	sequence_number=25	rbr_only=no	original_committed_timestamp=1789025065588593	immediate_commit_timestamp=1789025065588593	transaction_length=270
# original_commit_timestamp=1789025065588593 (2026-09-10 14:24:25.588593 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065588593 (2026-09-10 14:24:25.588593 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065588593*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 23948
#260910 14:24:25 server id 1  end_log_pos 24139 CRC32 0xa70df52d 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 238
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`)
/*!*/;
# at 24139
#260910 14:24:25 server id 1  end_log_pos 24218 CRC32 0xf8b00def 	Anonymous_GTID	last_committed=25	sequence_number=26	rbr_only=no	original_committed_timestamp=1789025065633635	immediate_commit_timestamp=1789025065633635	transaction_length=268
# original_commit_timestamp=1789025065633635 (2026-09-10 14:24:25.633635 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065633635 (2026-09-10 14:24:25.633635 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065633635*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24218
#260910 14:24:25 server id 1  end_log_pos 24407 CRC32 0x4fa9ccd0 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 239
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`)
/*!*/;
# at 24407
#260910 14:24:25 server id 1  end_log_pos 24486 CRC32 0xe8524bd9 	Anonymous_GTID	last_committed=26	sequence_number=27	rbr_only=no	original_committed_timestamp=1789025065650348	immediate_commit_timestamp=1789025065650348	transaction_length=293
# original_commit_timestamp=1789025065650348 (2026-09-10 14:24:25.650348 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065650348 (2026-09-10 14:24:25.650348 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065650348*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24486
#260910 14:24:25 server id 1  end_log_pos 24700 CRC32 0xeb30cfb2 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 240
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`)
/*!*/;
# at 24700
#260910 14:24:25 server id 1  end_log_pos 24779 CRC32 0x01b9a271 	Anonymous_GTID	last_committed=27	sequence_number=28	rbr_only=no	original_committed_timestamp=1789025065701090	immediate_commit_timestamp=1789025065701090	transaction_length=323
# original_commit_timestamp=1789025065701090 (2026-09-10 14:24:25.701090 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065701090 (2026-09-10 14:24:25.701090 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065701090*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 24779
#260910 14:24:25 server id 1  end_log_pos 25023 CRC32 0x044b6608 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 241
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`)
/*!*/;
# at 25023
#260910 14:24:25 server id 1  end_log_pos 25102 CRC32 0xcbe48a9c 	Anonymous_GTID	last_committed=28	sequence_number=29	rbr_only=no	original_committed_timestamp=1789025065755219	immediate_commit_timestamp=1789025065755219	transaction_length=305
# original_commit_timestamp=1789025065755219 (2026-09-10 14:24:25.755219 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065755219 (2026-09-10 14:24:25.755219 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065755219*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25102
#260910 14:24:25 server id 1  end_log_pos 25328 CRC32 0x5ac3e4a8 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 242
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`)
/*!*/;
# at 25328
#260910 14:24:25 server id 1  end_log_pos 25407 CRC32 0x176b943a 	Anonymous_GTID	last_committed=29	sequence_number=30	rbr_only=no	original_committed_timestamp=1789025065805620	immediate_commit_timestamp=1789025065805620	transaction_length=440
# original_commit_timestamp=1789025065805620 (2026-09-10 14:24:25.805620 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065805620 (2026-09-10 14:24:25.805620 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065805620*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25407
#260910 14:24:25 server id 1  end_log_pos 25768 CRC32 0x624bc27f 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 243
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_permission_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `role_permission_permission_id_foreign` (`permission_id`)
/*!*/;
# at 25768
#260910 14:24:25 server id 1  end_log_pos 25847 CRC32 0xc4d1a29a 	Anonymous_GTID	last_committed=30	sequence_number=31	rbr_only=no	original_committed_timestamp=1789025065833808	immediate_commit_timestamp=1789025065833808	transaction_length=392
# original_commit_timestamp=1789025065833808 (2026-09-10 14:24:25.833808 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065833808 (2026-09-10 14:24:25.833808 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065833808*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 25847
#260910 14:24:25 server id 1  end_log_pos 26160 CRC32 0xe750cc3c 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 244
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`)
/*!*/;
# at 26160
#260910 14:24:25 server id 1  end_log_pos 26239 CRC32 0x7127ca1d 	Anonymous_GTID	last_committed=31	sequence_number=32	rbr_only=no	original_committed_timestamp=1789025065883428	immediate_commit_timestamp=1789025065883428	transaction_length=372
# original_commit_timestamp=1789025065883428 (2026-09-10 14:24:25.883428 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065883428 (2026-09-10 14:24:25.883428 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065883428*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 26239
#260910 14:24:25 server id 1  end_log_pos 26532 CRC32 0x46f6a6bf 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 245
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`)
/*!*/;
# at 26532
#260910 14:24:25 server id 1  end_log_pos 26611 CRC32 0xc9e576f1 	Anonymous_GTID	last_committed=32	sequence_number=33	rbr_only=no	original_committed_timestamp=1789025065933978	immediate_commit_timestamp=1789025065933978	transaction_length=354
# original_commit_timestamp=1789025065933978 (2026-09-10 14:24:25.933978 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065933978 (2026-09-10 14:24:25.933978 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065933978*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 26611
#260910 14:24:25 server id 1  end_log_pos 26886 CRC32 0xcf3cb421 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 246
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`)
/*!*/;
# at 26886
#260910 14:24:25 server id 1  end_log_pos 26965 CRC32 0x929d29a8 	Anonymous_GTID	last_committed=33	sequence_number=34	rbr_only=no	original_committed_timestamp=1789025065969048	immediate_commit_timestamp=1789025065969048	transaction_length=349
# original_commit_timestamp=1789025065969048 (2026-09-10 14:24:25.969048 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065969048 (2026-09-10 14:24:25.969048 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065969048*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 26965
#260910 14:24:25 server id 1  end_log_pos 27235 CRC32 0x6cbd19f7 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 247
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT
/*!*/;
# at 27235
#260910 14:24:25 server id 1  end_log_pos 27314 CRC32 0x7a150053 	Anonymous_GTID	last_committed=34	sequence_number=35	rbr_only=no	original_committed_timestamp=1789025065992516	immediate_commit_timestamp=1789025065992516	transaction_length=292
# original_commit_timestamp=1789025065992516 (2026-09-10 14:24:25.992516 SE Asia Standard Time)
# immediate_commit_timestamp=1789025065992516 (2026-09-10 14:24:25.992516 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025065992516*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27314
#260910 14:24:25 server id 1  end_log_pos 27527 CRC32 0x2f6cfd2c 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 248
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT
/*!*/;
# at 27527
#260910 14:24:25 server id 1  end_log_pos 27606 CRC32 0x259109ed 	Anonymous_GTID	last_committed=35	sequence_number=36	rbr_only=no	original_committed_timestamp=1789025066010200	immediate_commit_timestamp=1789025066010200	transaction_length=319
# original_commit_timestamp=1789025066010200 (2026-09-10 14:24:26.010200 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066010200 (2026-09-10 14:24:26.010200 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066010200*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27606
#260910 14:24:25 server id 1  end_log_pos 27846 CRC32 0x651c1bf3 	Query	thread_id=34	exec_time=1	error_code=0	Xid = 249
SET TIMESTAMP=1789025065/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7
/*!*/;
# at 27846
#260910 14:24:26 server id 1  end_log_pos 27925 CRC32 0x97372359 	Anonymous_GTID	last_committed=36	sequence_number=37	rbr_only=no	original_committed_timestamp=1789025066041970	immediate_commit_timestamp=1789025066041970	transaction_length=333
# original_commit_timestamp=1789025066041970 (2026-09-10 14:24:26.041970 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066041970 (2026-09-10 14:24:26.041970 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066041970*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 27925
#260910 14:24:26 server id 1  end_log_pos 28179 CRC32 0xbc39ba89 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 250
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37
/*!*/;
# at 28179
#260910 14:24:26 server id 1  end_log_pos 28258 CRC32 0x2ec07e8b 	Anonymous_GTID	last_committed=37	sequence_number=38	rbr_only=no	original_committed_timestamp=1789025066076323	immediate_commit_timestamp=1789025066076323	transaction_length=320
# original_commit_timestamp=1789025066076323 (2026-09-10 14:24:26.076323 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066076323 (2026-09-10 14:24:26.076323 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066076323*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 28258
#260910 14:24:26 server id 1  end_log_pos 28499 CRC32 0xb49e7166 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 251
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3
/*!*/;
# at 28499
#260910 14:24:26 server id 1  end_log_pos 28578 CRC32 0x190fb7b7 	Anonymous_GTID	last_committed=38	sequence_number=39	rbr_only=no	original_committed_timestamp=1789025066110490	immediate_commit_timestamp=1789025066110490	transaction_length=341
# original_commit_timestamp=1789025066110490 (2026-09-10 14:24:26.110490 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066110490 (2026-09-10 14:24:26.110490 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066110490*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 28578
#260910 14:24:26 server id 1  end_log_pos 28840 CRC32 0x7675c8f9 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 252
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43
/*!*/;
# at 28840
#260910 14:24:26 server id 1  end_log_pos 28919 CRC32 0xdb4cab53 	Anonymous_GTID	last_committed=39	sequence_number=40	rbr_only=no	original_committed_timestamp=1789025066142311	immediate_commit_timestamp=1789025066142311	transaction_length=302
# original_commit_timestamp=1789025066142311 (2026-09-10 14:24:26.142311 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066142311 (2026-09-10 14:24:26.142311 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066142311*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 28919
#260910 14:24:26 server id 1  end_log_pos 29142 CRC32 0xbfa36119 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 253
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT
/*!*/;
# at 29142
#260910 14:24:26 server id 1  end_log_pos 29221 CRC32 0xc534a84f 	Anonymous_GTID	last_committed=40	sequence_number=41	rbr_only=no	original_committed_timestamp=1789025066176169	immediate_commit_timestamp=1789025066176169	transaction_length=320
# original_commit_timestamp=1789025066176169 (2026-09-10 14:24:26.176169 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066176169 (2026-09-10 14:24:26.176169 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066176169*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 29221
#260910 14:24:26 server id 1  end_log_pos 29462 CRC32 0x0940eb93 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 254
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7
/*!*/;
# at 29462
#260910 14:24:26 server id 1  end_log_pos 29541 CRC32 0x68b61e7c 	Anonymous_GTID	last_committed=41	sequence_number=42	rbr_only=no	original_committed_timestamp=1789025066203917	immediate_commit_timestamp=1789025066203917	transaction_length=562
# original_commit_timestamp=1789025066203917 (2026-09-10 14:24:26.203917 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066203917 (2026-09-10 14:24:26.203917 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066203917*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 29541
#260910 14:24:26 server id 1  end_log_pos 30024 CRC32 0xc1a6bca7 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 255
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
/*!*/;
# at 30024
#260910 14:24:26 server id 1  end_log_pos 30103 CRC32 0x8b00d074 	Anonymous_GTID	last_committed=42	sequence_number=43	rbr_only=no	original_committed_timestamp=1789025066238795	immediate_commit_timestamp=1789025066238795	transaction_length=472
# original_commit_timestamp=1789025066238795 (2026-09-10 14:24:26.238795 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066238795 (2026-09-10 14:24:26.238795 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066238795*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30103
#260910 14:24:26 server id 1  end_log_pos 30496 CRC32 0x5fb94248 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 256
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
/*!*/;
# at 30496
#260910 14:24:26 server id 1  end_log_pos 30575 CRC32 0x9e3f58ca 	Anonymous_GTID	last_committed=43	sequence_number=44	rbr_only=no	original_committed_timestamp=1789025066280434	immediate_commit_timestamp=1789025066280434	transaction_length=355
# original_commit_timestamp=1789025066280434 (2026-09-10 14:24:26.280434 SE Asia Standard Time)
# immediate_commit_timestamp=1789025066280434 (2026-09-10 14:24:26.280434 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025066280434*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30575
#260910 14:24:26 server id 1  end_log_pos 30851 CRC32 0xd89f8a10 	Query	thread_id=34	exec_time=0	error_code=0	Xid = 257
SET TIMESTAMP=1789025066/*!*/;
/*!80013 SET @@session.sql_require_primary_key=0*//*!*/;
--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
/*!*/;
# at 30851
#260910 14:31:01 server id 1  end_log_pos 30930 CRC32 0x07ff4487 	Anonymous_GTID	last_committed=44	sequence_number=45	rbr_only=yes	original_committed_timestamp=1789025461857718	immediate_commit_timestamp=1789025461857718	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025461857718 (2026-09-10 14:31:01.857718 SE Asia Standard Time)
# immediate_commit_timestamp=1789025461857718 (2026-09-10 14:31:01.857718 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025461857718*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 30930
#260910 14:31:01 server id 1  end_log_pos 31011 CRC32 0xba936a0d 	Query	thread_id=49	exec_time=0	error_code=0
SET TIMESTAMP=1789025461/*!*/;
SET @@session.sql_mode=1168113696/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=224,@@session.collation_connection=224,@@session.collation_server=255/*!*/;
BEGIN
/*!*/;
# at 31011
#260910 14:31:01 server id 1  end_log_pos 31085 CRC32 0x1d796ce0 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 31085
#260910 14:31:01 server id 1  end_log_pos 31582 CRC32 0xc764e57f 	Write_rows: table id 121 flags: STMT_END_F

BINLOG '
tVyiahMBAAAASgAAAG15AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4OBseR0=
tVyiah4BAAAA8QEAAF57AAAAAHkAAAAAAAEAAgAG/wIoAEN0NmN5d212Z0o3MU5sUUdHVHFuQ2hn
c3Jvdk5YUFRGVnAyM25FZGcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lVMjB6Ym5aMU4wNUtVSFZxV0dsSWRFbEJjVFJRZDFOd1RtUTFaMXB2U1hkdmJsUlNiRkZE
Y2lJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9tVyian/lZMc=
'/*!*/;
# at 31582
#260910 14:31:01 server id 1  end_log_pos 31613 CRC32 0xcef02a48 	Xid = 392
COMMIT/*!*/;
# at 31613
#260910 14:31:20 server id 1  end_log_pos 31692 CRC32 0x2934b0a0 	Anonymous_GTID	last_committed=45	sequence_number=46	rbr_only=yes	original_committed_timestamp=1789025480269127	immediate_commit_timestamp=1789025480269127	transaction_length=762
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025480269127 (2026-09-10 14:31:20.269127 SE Asia Standard Time)
# immediate_commit_timestamp=1789025480269127 (2026-09-10 14:31:20.269127 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025480269127*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 31692
#260910 14:31:20 server id 1  end_log_pos 31773 CRC32 0xc6d28517 	Query	thread_id=50	exec_time=0	error_code=0
SET TIMESTAMP=1789025480/*!*/;
BEGIN
/*!*/;
# at 31773
#260910 14:31:20 server id 1  end_log_pos 31847 CRC32 0x97fbf759 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 31847
#260910 14:31:20 server id 1  end_log_pos 32344 CRC32 0x3616664a 	Delete_rows: table id 121 flags: STMT_END_F

BINLOG '
yFyiahMBAAAASgAAAGd8AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Fn3+5c=
yFyiaiABAAAA8QEAAFh+AAAAAHkAAAAAAAEAAgAG/wIoAEN0NmN5d212Z0o3MU5sUUdHVHFuQ2hn
c3Jvdk5YUFRGVnAyM25FZGcJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4w
OyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJv
bWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzYgAQAAWVRvek9udHpPalk2SWw5MGIydGxiaUk3Y3pv
ME1Eb2lVMjB6Ym5aMU4wNUtVSFZxV0dsSWRFbEJjVFJRZDFOd1RtUTFaMXB2U1hkdmJsUlNiRkZE
Y2lJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002TXpNNkltaDBk
SEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFPaUp5YjNWMFpT
STdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWDA9tVyiakpmFjY=
'/*!*/;
# at 32344
#260910 14:31:20 server id 1  end_log_pos 32375 CRC32 0xa78d97c0 	Xid = 404
COMMIT/*!*/;
# at 32375
#260910 14:31:20 server id 1  end_log_pos 32454 CRC32 0x228deb8c 	Anonymous_GTID	last_committed=46	sequence_number=47	rbr_only=yes	original_committed_timestamp=1789025480323598	immediate_commit_timestamp=1789025480323598	transaction_length=854
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025480323598 (2026-09-10 14:31:20.323598 SE Asia Standard Time)
# immediate_commit_timestamp=1789025480323598 (2026-09-10 14:31:20.323598 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025480323598*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 32454
#260910 14:31:20 server id 1  end_log_pos 32535 CRC32 0x50931e36 	Query	thread_id=50	exec_time=0	error_code=0
SET TIMESTAMP=1789025480/*!*/;
BEGIN
/*!*/;
# at 32535
#260910 14:31:20 server id 1  end_log_pos 32609 CRC32 0xe2ba2e78 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 32609
#260910 14:31:20 server id 1  end_log_pos 33198 CRC32 0x9f7b474f 	Write_rows: table id 121 flags: STMT_END_F

BINLOG '
yFyiahMBAAAASgAAAGF/AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HguuuI=
yFyiah4BAAAATQIAAK6BAAAAAHkAAAAAAAEAAgAG/wAoAFM0eXdGQVRmNFFjRjJRZk5ZdGJwdmht
RjBZdThHS2d6M2dBRUpQVTUEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dz
IE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vj
a28pIENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNnQBAABZVG8wT250ek9qWTZJbDkwYjJ0
bGJpSTdjem8wTURvaU9FOTBOR2RoY1V3MmNHaElUWEJaY0ZScWFtaHRTREk0U1dwVWIzQk1XVkZu
UVZOWlQxcFpWQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZN
ek02SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5c2IyZHBiaUk3Y3pvMU9p
SnliM1YwWlNJN2N6bzFPaUpzYjJkcGJpSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpv
aWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2Rs
WWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJ
anRwT2pRN2ZRPT3IXKJqT0d7nw==
'/*!*/;
# at 33198
#260910 14:31:20 server id 1  end_log_pos 33229 CRC32 0x757b7899 	Xid = 410
COMMIT/*!*/;
# at 33229
#260910 14:31:20 server id 1  end_log_pos 33308 CRC32 0x6a2cc159 	Anonymous_GTID	last_committed=47	sequence_number=48	rbr_only=yes	original_committed_timestamp=1789025480999858	immediate_commit_timestamp=1789025480999858	transaction_length=1438
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025480999858 (2026-09-10 14:31:20.999858 SE Asia Standard Time)
# immediate_commit_timestamp=1789025480999858 (2026-09-10 14:31:20.999858 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025480999858*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 33308
#260910 14:31:20 server id 1  end_log_pos 33398 CRC32 0x993f7c17 	Query	thread_id=51	exec_time=0	error_code=0
SET TIMESTAMP=1789025480/*!*/;
BEGIN
/*!*/;
# at 33398
#260910 14:31:20 server id 1  end_log_pos 33472 CRC32 0x22520cf9 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 33472
#260910 14:31:20 server id 1  end_log_pos 34636 CRC32 0xaec8a2ef 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
yFyiahMBAAAASgAAAMCCAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PkMUiI=
yFyiah8BAAAAjAQAAEyHAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ0AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpNNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOXNiMmRwYmlJN2N6bzFP
aUp5YjNWMFpTSTdjem8xT2lKc2IyZHBiaUk3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT09yFyiagAoAFM0eXdGQVRmNFFjRjJRZk5ZdGJwdmhtRjBZdThHS2d6M2dBRUpQ
VTUEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0
OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIu
MC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaU9F
OTBOR2RoY1V3MmNHaElUWEJaY0ZScWFtaHRTREk0U1dwVWIzQk1XVkZuUVZOWlQxcFpWQ0k3Y3pv
NU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemM2SW1oMGRIQTZMeTh4
TWpjdU1DNHdMakU2T0RBd01DOWhaRzFwYmk5a1lYTm9ZbTloY21RaU8zTTZOVG9pY205MWRHVWlP
M002TVRVNkltRmtiV2x1TG1SaGMyaGliMkZ5WkNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUz
TTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJs
dVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1
T0Rsa0lqdHBPalE3ZlE9Pchcomrvosiu
'/*!*/;
# at 34636
#260910 14:31:20 server id 1  end_log_pos 34667 CRC32 0x20e92132 	Xid = 428
COMMIT/*!*/;
# at 34667
#260910 14:31:21 server id 1  end_log_pos 34746 CRC32 0x3b0531af 	Anonymous_GTID	last_committed=48	sequence_number=49	rbr_only=yes	original_committed_timestamp=1789025481773764	immediate_commit_timestamp=1789025481773764	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025481773764 (2026-09-10 14:31:21.773764 SE Asia Standard Time)
# immediate_commit_timestamp=1789025481773764 (2026-09-10 14:31:21.773764 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025481773764*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 34746
#260910 14:31:21 server id 1  end_log_pos 34836 CRC32 0x07d45293 	Query	thread_id=52	exec_time=0	error_code=0
SET TIMESTAMP=1789025481/*!*/;
BEGIN
/*!*/;
# at 34836
#260910 14:31:21 server id 1  end_log_pos 34910 CRC32 0x88b0d936 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 34910
#260910 14:31:21 server id 1  end_log_pos 36094 CRC32 0xc288a40d 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
yVyiahMBAAAASgAAAF6IAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4DbZsIg=
yVyiah8BAAAAoAQAAP6MAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3IXKJqACgAUzR5d0ZBVGY0UWNGMlFmTll0
YnB2aG1GMFl1OEdLZ3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNC
TVdWRm5RVk5aVDFwWlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5q
b2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRv
d09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09yVyiag2kiMI=
'/*!*/;
# at 36094
#260910 14:31:21 server id 1  end_log_pos 36125 CRC32 0x580992f0 	Xid = 446
COMMIT/*!*/;
# at 36125
#260910 14:31:22 server id 1  end_log_pos 36204 CRC32 0x150d55d0 	Anonymous_GTID	last_committed=49	sequence_number=50	rbr_only=yes	original_committed_timestamp=1789025482414155	immediate_commit_timestamp=1789025482414155	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025482414155 (2026-09-10 14:31:22.414155 SE Asia Standard Time)
# immediate_commit_timestamp=1789025482414155 (2026-09-10 14:31:22.414155 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025482414155*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 36204
#260910 14:31:22 server id 1  end_log_pos 36294 CRC32 0xb1dfc6e8 	Query	thread_id=53	exec_time=0	error_code=0
SET TIMESTAMP=1789025482/*!*/;
BEGIN
/*!*/;
# at 36294
#260910 14:31:22 server id 1  end_log_pos 36368 CRC32 0x24cd0144 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 36368
#260910 14:31:22 server id 1  end_log_pos 37552 CRC32 0x8c8d1c8c 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
ylyiahMBAAAASgAAABCOAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4EQBzSQ=
ylyiah8BAAAAoAQAALCSAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3JXKJqACgAUzR5d0ZBVGY0UWNGMlFmTll0
YnB2aG1GMFl1OEdLZ3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNC
TVdWRm5RVk5aVDFwWlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5q
b2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRv
d09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09ylyiaowcjYw=
'/*!*/;
# at 37552
#260910 14:31:22 server id 1  end_log_pos 37583 CRC32 0x76129964 	Xid = 467
COMMIT/*!*/;
# at 37583
#260910 14:31:23 server id 1  end_log_pos 37662 CRC32 0x3bef08b8 	Anonymous_GTID	last_committed=50	sequence_number=51	rbr_only=yes	original_committed_timestamp=1789025483065219	immediate_commit_timestamp=1789025483065219	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025483065219 (2026-09-10 14:31:23.065219 SE Asia Standard Time)
# immediate_commit_timestamp=1789025483065219 (2026-09-10 14:31:23.065219 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025483065219*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 37662
#260910 14:31:23 server id 1  end_log_pos 37752 CRC32 0xd08447ce 	Query	thread_id=56	exec_time=0	error_code=0
SET TIMESTAMP=1789025483/*!*/;
BEGIN
/*!*/;
# at 37752
#260910 14:31:23 server id 1  end_log_pos 37826 CRC32 0xe718c86a 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 37826
#260910 14:31:23 server id 1  end_log_pos 39010 CRC32 0xef953dcc 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
y1yiahMBAAAASgAAAMKTAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GrIGOc=
y1yiah8BAAAAoAQAAGKYAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3KXKJqACgAUzR5d0ZBVGY0UWNGMlFmTll0
YnB2aG1GMFl1OEdLZ3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNC
TVdWRm5RVk5aVDFwWlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5q
b2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRv
d09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09y1yiasw9le8=
'/*!*/;
# at 39010
#260910 14:31:23 server id 1  end_log_pos 39041 CRC32 0x9f162af3 	Xid = 515
COMMIT/*!*/;
# at 39041
#260910 14:31:24 server id 1  end_log_pos 39120 CRC32 0x27fb9d23 	Anonymous_GTID	last_committed=51	sequence_number=52	rbr_only=yes	original_committed_timestamp=1789025484128945	immediate_commit_timestamp=1789025484128945	transaction_length=1458
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025484128945 (2026-09-10 14:31:24.128945 SE Asia Standard Time)
# immediate_commit_timestamp=1789025484128945 (2026-09-10 14:31:24.128945 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025484128945*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 39120
#260910 14:31:24 server id 1  end_log_pos 39210 CRC32 0xe2821bbe 	Query	thread_id=61	exec_time=0	error_code=0
SET TIMESTAMP=1789025484/*!*/;
BEGIN
/*!*/;
# at 39210
#260910 14:31:24 server id 1  end_log_pos 39284 CRC32 0x273159bc 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 39284
#260910 14:31:24 server id 1  end_log_pos 40468 CRC32 0x3a3b2414 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
zFyiahMBAAAASgAAAHSZAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LxZMSc=
zFyiah8BAAAAoAQAABSeAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3LXKJqACgAUzR5d0ZBVGY0UWNGMlFmTll0
YnB2aG1GMFl1OEdLZ3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2iAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNC
TVdWRm5RVk5aVDFwWlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk16YzZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5aFpHMXBiaTlrWVhOb1ltOWhj
bVFpTzNNNk5Ub2ljbTkxZEdVaU8zTTZNVFU2SW1Ga2JXbHVMbVJoYzJoaWIyRnlaQ0k3ZlhNNk5q
b2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRv
d09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJt
TURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdmUT09zFyiahQkOzo=
'/*!*/;
# at 40468
#260910 14:31:24 server id 1  end_log_pos 40499 CRC32 0x64413da7 	Xid = 605
COMMIT/*!*/;
# at 40499
#260910 14:31:44 server id 1  end_log_pos 40578 CRC32 0x375b4d2a 	Anonymous_GTID	last_committed=52	sequence_number=53	rbr_only=yes	original_committed_timestamp=1789025504237931	immediate_commit_timestamp=1789025504237931	transaction_length=1418
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025504237931 (2026-09-10 14:31:44.237931 SE Asia Standard Time)
# immediate_commit_timestamp=1789025504237931 (2026-09-10 14:31:44.237931 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025504237931*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 40578
#260910 14:31:44 server id 1  end_log_pos 40668 CRC32 0xc4c17baf 	Query	thread_id=62	exec_time=0	error_code=0
SET TIMESTAMP=1789025504/*!*/;
BEGIN
/*!*/;
# at 40668
#260910 14:31:44 server id 1  end_log_pos 40742 CRC32 0x7994311b 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 40742
#260910 14:31:44 server id 1  end_log_pos 41886 CRC32 0x92293a46 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
4FyiahMBAAAASgAAACafAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4BsxlHk=
4Fyiah8BAAAAeAQAAJ6jAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpjNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzloWkcxcGJpOWtZWE5vWW05aGNtUWlP
M002TlRvaWNtOTFkR1VpTzNNNk1UVTZJbUZrYldsdUxtUmhjMmhpYjJGeVpDSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT3MXKJqACgAUzR5d0ZBVGY0UWNGMlFmTll0
YnB2aG1GMFl1OEdLZ3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2YAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNC
TVdWRm5RVk5aVDFwWlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk1qRTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUNJN2N6bzFPaUp5YjNWMFpTSTdj
em8wT2lKb2IyMWxJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1E
cDdmWE02TXpvaWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1G
a1pHTXlZakptT1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDngXKJq
Rjopkg==
'/*!*/;
# at 41886
#260910 14:31:44 server id 1  end_log_pos 41917 CRC32 0x7251bc76 	Xid = 617
COMMIT/*!*/;
# at 41917
#260910 14:38:39 server id 1  end_log_pos 41996 CRC32 0x38982b69 	Anonymous_GTID	last_committed=53	sequence_number=54	rbr_only=yes	original_committed_timestamp=1789025919654622	immediate_commit_timestamp=1789025919654622	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789025919654622 (2026-09-10 14:38:39.654622 SE Asia Standard Time)
# immediate_commit_timestamp=1789025919654622 (2026-09-10 14:38:39.654622 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789025919654622*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 41996
#260910 14:38:39 server id 1  end_log_pos 42086 CRC32 0xeea4ab7e 	Query	thread_id=63	exec_time=0	error_code=0
SET TIMESTAMP=1789025919/*!*/;
BEGIN
/*!*/;
# at 42086
#260910 14:38:39 server id 1  end_log_pos 42160 CRC32 0x2a9fa220 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 42160
#260910 14:38:39 server id 1  end_log_pos 43264 CRC32 0x48bb297e 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
f16iahMBAAAASgAAALCkAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CCinyo=
f16iah8BAAAAUAQAAACpAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OeBcomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OX9eomp+KbtI
'/*!*/;
# at 43264
#260910 14:38:39 server id 1  end_log_pos 43295 CRC32 0x093c8dfe 	Xid = 629
COMMIT/*!*/;
# at 43295
#260910 14:41:02 server id 1  end_log_pos 43374 CRC32 0x3fa2a999 	Anonymous_GTID	last_committed=54	sequence_number=55	rbr_only=yes	original_committed_timestamp=1789026062743197	immediate_commit_timestamp=1789026062743197	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026062743197 (2026-09-10 14:41:02.743197 SE Asia Standard Time)
# immediate_commit_timestamp=1789026062743197 (2026-09-10 14:41:02.743197 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026062743197*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 43374
#260910 14:41:02 server id 1  end_log_pos 43464 CRC32 0x3ae01617 	Query	thread_id=64	exec_time=0	error_code=0
SET TIMESTAMP=1789026062/*!*/;
BEGIN
/*!*/;
# at 43464
#260910 14:41:02 server id 1  end_log_pos 43538 CRC32 0x22d818bb 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 43538
#260910 14:41:02 server id 1  end_log_pos 44642 CRC32 0x95dba5de 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
Dl+iahMBAAAASgAAABKqAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4LsY2CI=
Dl+iah8BAAAAUAQAAGKuAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OX9eomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OQ5fomrepduV
'/*!*/;
# at 44642
#260910 14:41:02 server id 1  end_log_pos 44673 CRC32 0xe89bfc24 	Xid = 641
COMMIT/*!*/;
# at 44673
#260910 14:42:59 server id 1  end_log_pos 44752 CRC32 0x9489a14e 	Anonymous_GTID	last_committed=55	sequence_number=56	rbr_only=yes	original_committed_timestamp=1789026179818210	immediate_commit_timestamp=1789026179818210	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026179818210 (2026-09-10 14:42:59.818210 SE Asia Standard Time)
# immediate_commit_timestamp=1789026179818210 (2026-09-10 14:42:59.818210 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026179818210*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 44752
#260910 14:42:59 server id 1  end_log_pos 44842 CRC32 0x2e672722 	Query	thread_id=65	exec_time=0	error_code=0
SET TIMESTAMP=1789026179/*!*/;
BEGIN
/*!*/;
# at 44842
#260910 14:42:59 server id 1  end_log_pos 44916 CRC32 0x0ef1c70c 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 44916
#260910 14:42:59 server id 1  end_log_pos 46020 CRC32 0xf21fd596 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
g1+iahMBAAAASgAAAHSvAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4AzH8Q4=
g1+iah8BAAAAUAQAAMSzAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OQ5fomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OYNfomqW1R/y
'/*!*/;
# at 46020
#260910 14:42:59 server id 1  end_log_pos 46051 CRC32 0x72d592ae 	Xid = 653
COMMIT/*!*/;
# at 46051
#260910 14:45:12 server id 1  end_log_pos 46130 CRC32 0x9d20766f 	Anonymous_GTID	last_committed=56	sequence_number=57	rbr_only=yes	original_committed_timestamp=1789026312694020	immediate_commit_timestamp=1789026312694020	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026312694020 (2026-09-10 14:45:12.694020 SE Asia Standard Time)
# immediate_commit_timestamp=1789026312694020 (2026-09-10 14:45:12.694020 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026312694020*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 46130
#260910 14:45:12 server id 1  end_log_pos 46220 CRC32 0xc666fa17 	Query	thread_id=66	exec_time=0	error_code=0
SET TIMESTAMP=1789026312/*!*/;
BEGIN
/*!*/;
# at 46220
#260910 14:45:12 server id 1  end_log_pos 46294 CRC32 0x8f820f29 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 46294
#260910 14:45:12 server id 1  end_log_pos 47398 CRC32 0x9d8b1662 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
CGCiahMBAAAASgAAANa0AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4CkPgo8=
CGCiah8BAAAAUAQAACa5AAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OYNfomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OQhgompiFoud
'/*!*/;
# at 47398
#260910 14:45:12 server id 1  end_log_pos 47429 CRC32 0x41e301a4 	Xid = 665
COMMIT/*!*/;
# at 47429
#260910 14:46:00 server id 1  end_log_pos 47508 CRC32 0x1188e171 	Anonymous_GTID	last_committed=57	sequence_number=58	rbr_only=yes	original_committed_timestamp=1789026360401914	immediate_commit_timestamp=1789026360401914	transaction_length=1446
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026360401914 (2026-09-10 14:46:00.401914 SE Asia Standard Time)
# immediate_commit_timestamp=1789026360401914 (2026-09-10 14:46:00.401914 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026360401914*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 47508
#260910 14:46:00 server id 1  end_log_pos 47598 CRC32 0x809c1331 	Query	thread_id=67	exec_time=0	error_code=0
SET TIMESTAMP=1789026360/*!*/;
BEGIN
/*!*/;
# at 47598
#260910 14:46:00 server id 1  end_log_pos 47672 CRC32 0x051bf24f 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 47672
#260910 14:46:00 server id 1  end_log_pos 48844 CRC32 0x63dd4b64 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
OGCiahMBAAAASgAAADi6AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E/yGwU=
OGCiah8BAAAAlAQAAMy+AAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OQhgomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzak
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TlRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkw
Wlc1MFlXNW5MV3RoYldrdmMzUnlkV3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdjem8xT2lKeWIzVjBa
U0k3Y3pveE9Ub2ljM1J5ZFd0MGRYSXRiM0puWVc1cGMyRnphU0k3ZlhNNk5qb2lYMlpzWVhOb0lq
dGhPakk2ZTNNNk16b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRB
NklteHZaMmx1WDNkbFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhs
WVRSbE16QTVPRGxrSWp0cE9qUTdmUT09OGCiamRL3WM=
'/*!*/;
# at 48844
#260910 14:46:00 server id 1  end_log_pos 48875 CRC32 0x89e37e8b 	Xid = 677
COMMIT/*!*/;
# at 48875
#260910 14:48:15 server id 1  end_log_pos 48954 CRC32 0xa8513f89 	Anonymous_GTID	last_committed=58	sequence_number=59	rbr_only=yes	original_committed_timestamp=1789026495272816	immediate_commit_timestamp=1789026495272816	transaction_length=1446
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026495272816 (2026-09-10 14:48:15.272816 SE Asia Standard Time)
# immediate_commit_timestamp=1789026495272816 (2026-09-10 14:48:15.272816 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026495272816*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 48954
#260910 14:48:15 server id 1  end_log_pos 49044 CRC32 0x157c3702 	Query	thread_id=68	exec_time=0	error_code=0
SET TIMESTAMP=1789026495/*!*/;
BEGIN
/*!*/;
# at 49044
#260910 14:48:15 server id 1  end_log_pos 49118 CRC32 0xde2e9e7e 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 49118
#260910 14:48:15 server id 1  end_log_pos 50290 CRC32 0x6253d992 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
v2CiahMBAAAASgAAAN6/AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4H6eLt4=
v2Ciah8BAAAAlAQAAHLEAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzakAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TlRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmMzUnlk
V3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdjem8xT2lKeWIzVjBaU0k3Y3pveE9Ub2ljM1J5ZFd0MGRY
SXRiM0puWVc1cGMyRnphU0k3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0po
TXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdm
UT09OGCiagAoAFM0eXdGQVRmNFFjRjJRZk5ZdGJwdmhtRjBZdThHS2d6M2dBRUpQVTUEAAAAAAAA
AAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFw
cGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2Fm
YXJpLzUzNy4zNmABAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaU9FOTBOR2RoY1V3
MmNHaElUWEJaY0ZScWFtaHRTREk0U1dwVWIzQk1XVkZuUVZOWlQxcFpWQ0k3Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNakU2SW1oMGRIQTZMeTh4TWpjdU1DNHdM
akU2T0RBd01DSTdjem8xT2lKeWIzVjBaU0k3Y3pvME9pSm9iMjFsSWp0OWN6bzJPaUpmWm14aGMy
Z2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5v2CiapLZU2I=
'/*!*/;
# at 50290
#260910 14:48:15 server id 1  end_log_pos 50321 CRC32 0x850224cb 	Xid = 689
COMMIT/*!*/;
# at 50321
#260910 14:48:18 server id 1  end_log_pos 50400 CRC32 0xbf7aab4b 	Anonymous_GTID	last_committed=59	sequence_number=60	rbr_only=yes	original_committed_timestamp=1789026498169293	immediate_commit_timestamp=1789026498169293	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026498169293 (2026-09-10 14:48:18.169293 SE Asia Standard Time)
# immediate_commit_timestamp=1789026498169293 (2026-09-10 14:48:18.169293 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026498169293*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 50400
#260910 14:48:18 server id 1  end_log_pos 50490 CRC32 0x43388365 	Query	thread_id=69	exec_time=0	error_code=0
SET TIMESTAMP=1789026498/*!*/;
BEGIN
/*!*/;
# at 50490
#260910 14:48:18 server id 1  end_log_pos 50564 CRC32 0x2bd2e789 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 50564
#260910 14:48:18 server id 1  end_log_pos 51668 CRC32 0x5dd6397b 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
wmCiahMBAAAASgAAAITFAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Inn0is=
wmCiah8BAAAAUAQAANTJAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0Ob9gomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OcJgomp7OdZd
'/*!*/;
# at 51668
#260910 14:48:18 server id 1  end_log_pos 51699 CRC32 0x7543ea1a 	Xid = 701
COMMIT/*!*/;
# at 51699
#260910 14:53:16 server id 1  end_log_pos 51778 CRC32 0x001f05b3 	Anonymous_GTID	last_committed=60	sequence_number=61	rbr_only=yes	original_committed_timestamp=1789026796527146	immediate_commit_timestamp=1789026796527146	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789026796527146 (2026-09-10 14:53:16.527146 SE Asia Standard Time)
# immediate_commit_timestamp=1789026796527146 (2026-09-10 14:53:16.527146 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789026796527146*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 51778
#260910 14:53:16 server id 1  end_log_pos 51868 CRC32 0xa750f24b 	Query	thread_id=70	exec_time=0	error_code=0
SET TIMESTAMP=1789026796/*!*/;
BEGIN
/*!*/;
# at 51868
#260910 14:53:16 server id 1  end_log_pos 51942 CRC32 0x11e76ee8 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 51942
#260910 14:53:16 server id 1  end_log_pos 53046 CRC32 0xba3ba9a8 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
7GGiahMBAAAASgAAAObKAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Ohu5xE=
7GGiah8BAAAAUAQAADbPAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OcJgomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OexhomqoqTu6
'/*!*/;
# at 53046
#260910 14:53:16 server id 1  end_log_pos 53077 CRC32 0x6e460d51 	Xid = 713
COMMIT/*!*/;
# at 53077
#260910 14:58:53 server id 1  end_log_pos 53156 CRC32 0xf98934e0 	Anonymous_GTID	last_committed=61	sequence_number=62	rbr_only=yes	original_committed_timestamp=1789027133439298	immediate_commit_timestamp=1789027133439298	transaction_length=1378
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027133439298 (2026-09-10 14:58:53.439298 SE Asia Standard Time)
# immediate_commit_timestamp=1789027133439298 (2026-09-10 14:58:53.439298 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027133439298*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 53156
#260910 14:58:53 server id 1  end_log_pos 53246 CRC32 0xba4a5fea 	Query	thread_id=71	exec_time=0	error_code=0
SET TIMESTAMP=1789027133/*!*/;
BEGIN
/*!*/;
# at 53246
#260910 14:58:53 server id 1  end_log_pos 53320 CRC32 0xf3cd6afa 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 53320
#260910 14:58:53 server id 1  end_log_pos 54424 CRC32 0x9bac2b84 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
PWOiahMBAAAASgAAAEjQAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PpqzfM=
PWOiah8BAAAAUAQAAJjUAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OexhomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZg
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3
Y3pvMU9pSnliM1YwWlNJN2N6bzBPaUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdj
em96T2lKdmJHUWlPMkU2TURwN2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFX
NWZkMlZpWHpVNVltRXpObUZrWkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURr
NE9XUWlPMms2TkR0OT1jomqEK6yb
'/*!*/;
# at 54424
#260910 14:58:53 server id 1  end_log_pos 54455 CRC32 0xe17b942f 	Xid = 725
COMMIT/*!*/;
# at 54455
#260910 14:58:56 server id 1  end_log_pos 54534 CRC32 0x9b98ea39 	Anonymous_GTID	last_committed=62	sequence_number=63	rbr_only=yes	original_committed_timestamp=1789027136891455	immediate_commit_timestamp=1789027136891455	transaction_length=1406
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027136891455 (2026-09-10 14:58:56.891455 SE Asia Standard Time)
# immediate_commit_timestamp=1789027136891455 (2026-09-10 14:58:56.891455 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027136891455*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 54534
#260910 14:58:56 server id 1  end_log_pos 54624 CRC32 0x6dcdd805 	Query	thread_id=72	exec_time=0	error_code=0
SET TIMESTAMP=1789027136/*!*/;
BEGIN
/*!*/;
# at 54624
#260910 14:58:56 server id 1  end_log_pos 54698 CRC32 0x60d2aeef 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 54698
#260910 14:58:56 server id 1  end_log_pos 55830 CRC32 0xc6cce700 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
QGOiahMBAAAASgAAAKrVAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4O+u0mA=
QGOiah8BAAAAbAQAABbaAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZgAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TWpFNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQ0k3Y3pvMU9pSnliM1YwWlNJN2N6bzBP
aUpvYjIxbElqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURwN2ZY
TTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZrWkdN
eVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OT1jomoAKABT
NHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4x
bwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81
MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8
AQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNG
UnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJF
Nk1qcDdjem96T2lKMWNtd2lPM002TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlw
Ym1admNtMWhjMmt2WW1WeWFYUmhJanR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdm
WE02TmpvaVgyWnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5
STdZVG93T250OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURF
MU9EQm1NREUwWXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1AY6JqAOfMxg==
'/*!*/;
# at 55830
#260910 14:58:56 server id 1  end_log_pos 55861 CRC32 0xf5761e33 	Xid = 737
COMMIT/*!*/;
# at 55861
#260910 14:59:18 server id 1  end_log_pos 55940 CRC32 0xf1df2a01 	Anonymous_GTID	last_committed=63	sequence_number=64	rbr_only=yes	original_committed_timestamp=1789027158708148	immediate_commit_timestamp=1789027158708148	transaction_length=1466
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027158708148 (2026-09-10 14:59:18.708148 SE Asia Standard Time)
# immediate_commit_timestamp=1789027158708148 (2026-09-10 14:59:18.708148 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027158708148*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 55940
#260910 14:59:18 server id 1  end_log_pos 56030 CRC32 0xc5da26a4 	Query	thread_id=73	exec_time=0	error_code=0
SET TIMESTAMP=1789027158/*!*/;
BEGIN
/*!*/;
# at 56030
#260910 14:59:18 server id 1  end_log_pos 56104 CRC32 0x8932f4ea 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 56104
#260910 14:59:18 server id 1  end_log_pos 57296 CRC32 0xb72526e0 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
VmOiahMBAAAASgAAACjbAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Or0Mok=
VmOiah8BAAAAqAQAANDfAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFYUmhJ
anR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9q
STZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14
dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJs
TXpBNU9EbGtJanRwT2pRN2ZRPT1AY6JqACgAUzR5d0ZBVGY0UWNGMlFmTll0YnB2aG1GMFl1OEdL
Z3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2nAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNCTVdWRm5RVk5aVDFw
WlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk5USTZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5MFpXNTBZVzVuTFd0aGJXa3ZjSEp2Wm1sc0xYQmxj
blZ6WVdoaFlXNGlPM002TlRvaWNtOTFkR1VpTzNNNk1UYzZJbkJ5YjJacGJDMXdaWEoxYzJGb1lX
RnVJanQ5Y3pvMk9pSmZabXhoYzJnaU8yRTZNanA3Y3pvek9pSnZiR1FpTzJFNk1EcDdmWE02TXpv
aWJtVjNJanRoT2pBNmUzMTljem8xTURvaWJHOW5hVzVmZDJWaVh6VTVZbUV6Tm1Ga1pHTXlZakpt
T1RRd01UVTRNR1l3TVRSak4yWTFPR1ZoTkdVek1EazRPV1FpTzJrNk5EdDlWY6Jq4CYltw==
'/*!*/;
# at 57296
#260910 14:59:18 server id 1  end_log_pos 57327 CRC32 0x2b94b019 	Xid = 749
COMMIT/*!*/;
# at 57327
#260910 14:59:22 server id 1  end_log_pos 57406 CRC32 0xc5a8427a 	Anonymous_GTID	last_committed=64	sequence_number=65	rbr_only=yes	original_committed_timestamp=1789027162675858	immediate_commit_timestamp=1789027162675858	transaction_length=1470
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027162675858 (2026-09-10 14:59:22.675858 SE Asia Standard Time)
# immediate_commit_timestamp=1789027162675858 (2026-09-10 14:59:22.675858 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027162675858*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 57406
#260910 14:59:22 server id 1  end_log_pos 57496 CRC32 0xfa2354af 	Query	thread_id=74	exec_time=0	error_code=0
SET TIMESTAMP=1789027162/*!*/;
BEGIN
/*!*/;
# at 57496
#260910 14:59:22 server id 1  end_log_pos 57570 CRC32 0xd67e8668 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 57570
#260910 14:59:22 server id 1  end_log_pos 58766 CRC32 0x4e7b334c 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
WmOiahMBAAAASgAAAOLgAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4GiGftY=
WmOiah8BAAAArAQAAI7lAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzacAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TlRJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmNISnZa
bWxzTFhCbGNuVnpZV2hoWVc0aU8zTTZOVG9pY205MWRHVWlPM002TVRjNkluQnliMlpwYkMxd1pY
SjFjMkZvWVdGdUlqdDljem8yT2lKZlpteGhjMmdpTzJFNk1qcDdjem96T2lKdmJHUWlPMkU2TURw
N2ZYTTZNem9pYm1WM0lqdGhPakE2ZTMxOWN6bzFNRG9pYkc5bmFXNWZkMlZpWHpVNVltRXpObUZr
WkdNeVlqSm1PVFF3TVRVNE1HWXdNVFJqTjJZMU9HVmhOR1V6TURrNE9XUWlPMms2TkR0OVZjomoA
KABTNHl3RkFUZjRRY0YyUWZOWXRicHZobUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAu
MC4xbwBNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktp
dC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81Mzcu
MzaAAQAAWVRvME9udHpPalk2SWw5MGIydGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhC
WmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZGblFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1p
TzJFNk1qcDdjem96T2lKMWNtd2lPM002TkRJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdN
QzkwWlc1MFlXNW5MV3RoYldrdmMyVnFZWEpoYUNJN2N6bzFPaUp5YjNWMFpTSTdjem8zT2lKelpX
cGhjbUZvSWp0OWN6bzJPaUpmWm14aGMyZ2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhN
Nk16b2libVYzSWp0aE9qQTZlMzE5Y3pvMU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015
WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkxT0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5WmOiakwze04=
'/*!*/;
# at 58766
#260910 14:59:22 server id 1  end_log_pos 58797 CRC32 0xed578a52 	Xid = 761
COMMIT/*!*/;
# at 58797
#260910 14:59:26 server id 1  end_log_pos 58876 CRC32 0x577061cb 	Anonymous_GTID	last_committed=65	sequence_number=66	rbr_only=yes	original_committed_timestamp=1789027166516238	immediate_commit_timestamp=1789027166516238	transaction_length=1450
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027166516238 (2026-09-10 14:59:26.516238 SE Asia Standard Time)
# immediate_commit_timestamp=1789027166516238 (2026-09-10 14:59:26.516238 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027166516238*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 58876
#260910 14:59:26 server id 1  end_log_pos 58966 CRC32 0xd0e3d0da 	Query	thread_id=75	exec_time=0	error_code=0
SET TIMESTAMP=1789027166/*!*/;
BEGIN
/*!*/;
# at 58966
#260910 14:59:26 server id 1  end_log_pos 59040 CRC32 0x88bd2bfa 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 59040
#260910 14:59:26 server id 1  end_log_pos 60216 CRC32 0xedc598b9 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
XmOiahMBAAAASgAAAKDmAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4PorvYg=
XmOiah8BAAAAmAQAADjrAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaAAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRJNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmMyVnFZ
WEpoYUNJN2N6bzFPaUp5YjNWMFpTSTdjem8zT2lKelpXcGhjbUZvSWp0OWN6bzJPaUpmWm14aGMy
Z2lPMkU2TWpwN2N6b3pPaUp2YkdRaU8yRTZNRHA3ZlhNNk16b2libVYzSWp0aE9qQTZlMzE5Y3pv
MU1Eb2liRzluYVc1ZmQyVmlYelU1WW1Fek5tRmtaR015WWpKbU9UUXdNVFU0TUdZd01UUmpOMlkx
T0dWaE5HVXpNRGs0T1dRaU8yazZORHQ5WmOiagAoAFM0eXdGQVRmNFFjRjJRZk5ZdGJwdmhtRjBZ
dThHS2d6M2dBRUpQVTUEAAAAAAAAAAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5U
IDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28p
IENocm9tZS8xNTIuMC4wLjAgU2FmYXJpLzUzNy4zNogBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJp
STdjem8wTURvaU9FOTBOR2RoY1V3MmNHaElUWEJaY0ZScWFtaHRTREk0U1dwVWIzQk1XVkZuUVZO
WlQxcFpWQ0k3Y3pvNU9pSmZjSEpsZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZORFE2
SW1oMGRIQTZMeTh4TWpjdU1DNHdMakU2T0RBd01DOTBaVzUwWVc1bkxXdGhiV2t2ZG1semFTMXRh
WE5wSWp0ek9qVTZJbkp2ZFhSbElqdHpPams2SW5acGMya3RiV2x6YVNJN2ZYTTZOam9pWDJac1lY
Tm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhN
Nk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRt
TlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PV5jomq5mMXt
'/*!*/;
# at 60216
#260910 14:59:26 server id 1  end_log_pos 60247 CRC32 0xc368612a 	Xid = 773
COMMIT/*!*/;
# at 60247
#260910 14:59:31 server id 1  end_log_pos 60326 CRC32 0x7642ac67 	Anonymous_GTID	last_committed=66	sequence_number=67	rbr_only=yes	original_committed_timestamp=1789027171659554	immediate_commit_timestamp=1789027171659554	transaction_length=1486
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027171659554 (2026-09-10 14:59:31.659554 SE Asia Standard Time)
# immediate_commit_timestamp=1789027171659554 (2026-09-10 14:59:31.659554 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027171659554*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 60326
#260910 14:59:31 server id 1  end_log_pos 60416 CRC32 0x8d4bcc56 	Query	thread_id=76	exec_time=0	error_code=0
SET TIMESTAMP=1789027171/*!*/;
BEGIN
/*!*/;
# at 60416
#260910 14:59:31 server id 1  end_log_pos 60490 CRC32 0x57f6c64d 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 60490
#260910 14:59:31 server id 1  end_log_pos 61702 CRC32 0x3d757918 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
Y2OiahMBAAAASgAAAErsAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4E3G9lc=
Y2Oiah8BAAAAvAQAAAbxAAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzaIAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TkRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmRtbHph
UzF0YVhOcElqdHpPalU2SW5KdmRYUmxJanR6T2prNkluWnBjMmt0YldsemFTSTdmWE02TmpvaVgy
WnNZWE5vSWp0aE9qSTZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250
OWZYTTZOVEE2SW14dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUw
WXpkbU5UaGxZVFJsTXpBNU9EbGtJanRwT2pRN2ZRPT1eY6JqACgAUzR5d0ZBVGY0UWNGMlFmTll0
YnB2aG1GMFl1OEdLZ3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdp
bmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlr
ZSBHZWNrbykgQ2hyb21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2pAEAAFlUbzBPbnR6T2pZNkls
OTBiMnRsYmlJN2N6bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNC
TVdWRm5RVk5aVDFwWlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdp
TzNNNk5UUTZJbWgwZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5MFpXNTBZVzVuTFd0aGJXa3Zj
M1J5ZFd0MGRYSXRiM0puWVc1cGMyRnphU0k3Y3pvMU9pSnliM1YwWlNJN2N6b3hPVG9pYzNSeWRX
dDBkWEl0YjNKbllXNXBjMkZ6YVNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4
a0lqdGhPakE2ZTMxek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgx
T1dKaE16WmhaR1JqTW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBP
alE3ZlE9PWNjomoYeXU9
'/*!*/;
# at 61702
#260910 14:59:31 server id 1  end_log_pos 61733 CRC32 0x9112b29e 	Xid = 785
COMMIT/*!*/;
# at 61733
#260910 14:59:40 server id 1  end_log_pos 61812 CRC32 0xfbfa8a58 	Anonymous_GTID	last_committed=67	sequence_number=68	rbr_only=yes	original_committed_timestamp=1789027180308740	immediate_commit_timestamp=1789027180308740	transaction_length=1474
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789027180308740 (2026-09-10 14:59:40.308740 SE Asia Standard Time)
# immediate_commit_timestamp=1789027180308740 (2026-09-10 14:59:40.308740 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789027180308740*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 61812
#260910 14:59:40 server id 1  end_log_pos 61902 CRC32 0x64dbfd5e 	Query	thread_id=77	exec_time=0	error_code=0
SET TIMESTAMP=1789027180/*!*/;
BEGIN
/*!*/;
# at 61902
#260910 14:59:40 server id 1  end_log_pos 61976 CRC32 0xfb696f71 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 61976
#260910 14:59:40 server id 1  end_log_pos 63176 CRC32 0x7e32133e 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
bGOiahMBAAAASgAAABjyAAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4HFvafs=
bGOiah8BAAAAsAQAAMj2AAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzakAQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TlRRNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzkwWlc1MFlXNW5MV3RoYldrdmMzUnlk
V3QwZFhJdGIzSm5ZVzVwYzJGemFTSTdjem8xT2lKeWIzVjBaU0k3Y3pveE9Ub2ljM1J5ZFd0MGRY
SXRiM0puWVc1cGMyRnphU0k3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16b2liMnhrSWp0
aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNkbFlsODFPV0po
TXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxrSWp0cE9qUTdm
UT09Y2OiagAoAFM0eXdGQVRmNFFjRjJRZk5ZdGJwdmhtRjBZdThHS2d6M2dBRUpQVTUEAAAAAAAA
AAkxMjcuMC4wLjFvAE1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFw
cGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xNTIuMC4wLjAgU2Fm
YXJpLzUzNy4zNnwBAABZVG8wT250ek9qWTZJbDkwYjJ0bGJpSTdjem8wTURvaU9FOTBOR2RoY1V3
MmNHaElUWEJaY0ZScWFtaHRTREk0U1dwVWIzQk1XVkZuUVZOWlQxcFpWQ0k3Y3pvNU9pSmZjSEps
ZG1sdmRYTWlPMkU2TWpwN2N6b3pPaUoxY213aU8zTTZNemc2SW1oMGRIQTZMeTh4TWpjdU1DNHdM
akU2T0RBd01DOXBibVp2Y20xaGMya3ZZbVZ5YVhSaElqdHpPalU2SW5KdmRYUmxJanR6T2pZNklt
SmxjbWwwWVNJN2ZYTTZOam9pWDJac1lYTm9JanRoT2pJNmUzTTZNem9pYjJ4a0lqdGhPakE2ZTMx
ek9qTTZJbTVsZHlJN1lUb3dPbnQ5ZlhNNk5UQTZJbXh2WjJsdVgzZGxZbDgxT1dKaE16WmhaR1Jq
TW1JeVpqazBNREUxT0RCbU1ERTBZemRtTlRobFlUUmxNekE1T0Rsa0lqdHBPalE3ZlE9PWxjomo+
EzJ+
'/*!*/;
# at 63176
#260910 14:59:40 server id 1  end_log_pos 63207 CRC32 0x883ded3b 	Xid = 797
COMMIT/*!*/;
# at 63207
#260910 15:14:31 server id 1  end_log_pos 63286 CRC32 0xee171f2a 	Anonymous_GTID	last_committed=68	sequence_number=69	rbr_only=yes	original_committed_timestamp=1789028071822154	immediate_commit_timestamp=1789028071822154	transaction_length=1434
/*!50718 SET TRANSACTION ISOLATION LEVEL READ COMMITTED*//*!*/;
# original_commit_timestamp=1789028071822154 (2026-09-10 15:14:31.822154 SE Asia Standard Time)
# immediate_commit_timestamp=1789028071822154 (2026-09-10 15:14:31.822154 SE Asia Standard Time)
/*!80001 SET @@session.original_commit_timestamp=1789028071822154*//*!*/;
/*!80014 SET @@session.original_server_version=80030*//*!*/;
/*!80014 SET @@session.immediate_server_version=80030*//*!*/;
SET @@SESSION.GTID_NEXT= 'ANONYMOUS'/*!*/;
# at 63286
#260910 15:14:31 server id 1  end_log_pos 63376 CRC32 0x14473c1e 	Query	thread_id=78	exec_time=0	error_code=0
SET TIMESTAMP=1789028071/*!*/;
BEGIN
/*!*/;
# at 63376
#260910 15:14:31 server id 1  end_log_pos 63450 CRC32 0xcef6a5aa 	Table_map: `pln_up_imy`.`sessions` mapped to number 121
# at 63450
#260910 15:14:31 server id 1  end_log_pos 64610 CRC32 0x0d6f1845 	Update_rows: table id 121 flags: STMT_END_F

BINLOG '
52aiahMBAAAASgAAANr3AAAAAHkAAAAAAAEACnBsbl91cF9pbXkACHNlc3Npb25zAAYPCA/8/AMG
/AO0AAIEDgEBgAIB4Kql9s4=
52aiah8BAAAAiAQAAGL8AAAAAHkAAAAAAAEAAgAG//8AKABTNHl3RkFUZjRRY0YyUWZOWXRicHZo
bUYwWXU4R0tnejNnQUVKUFU1BAAAAAAAAAAJMTI3LjAuMC4xbwBNb3ppbGxhLzUuMCAoV2luZG93
cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdl
Y2tvKSBDaHJvbWUvMTUyLjAuMC4wIFNhZmFyaS81MzcuMzZ8AQAAWVRvME9udHpPalk2SWw5MGIy
dGxiaUk3Y3pvME1Eb2lPRTkwTkdkaGNVdzJjR2hJVFhCWmNGUnFhbWh0U0RJNFNXcFViM0JNV1ZG
blFWTlpUMXBaVkNJN2N6bzVPaUpmY0hKbGRtbHZkWE1pTzJFNk1qcDdjem96T2lKMWNtd2lPM002
TXpnNkltaDBkSEE2THk4eE1qY3VNQzR3TGpFNk9EQXdNQzlwYm1admNtMWhjMmt2WW1WeWFYUmhJ
anR6T2pVNkluSnZkWFJsSWp0ek9qWTZJbUpsY21sMFlTSTdmWE02TmpvaVgyWnNZWE5vSWp0aE9q
STZlM002TXpvaWIyeGtJanRoT2pBNmUzMXpPak02SW01bGR5STdZVG93T250OWZYTTZOVEE2SW14
dloybHVYM2RsWWw4MU9XSmhNelpoWkdSak1tSXlaamswTURFMU9EQm1NREUwWXpkbU5UaGxZVFJs
TXpBNU9EbGtJanRwT2pRN2ZRPT1sY6JqACgAUzR5d0ZBVGY0UWNGMlFmTll0YnB2aG1GMFl1OEdL
Z3ozZ0FFSlBVNQQAAAAAAAAACTEyNy4wLjAuMW8ATW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAu
MDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hy
b21lLzE1Mi4wLjAuMCBTYWZhcmkvNTM3LjM2fAEAAFlUbzBPbnR6T2pZNklsOTBiMnRsYmlJN2N6
bzBNRG9pT0U5ME5HZGhjVXcyY0doSVRYQlpjRlJxYW1odFNESTRTV3BVYjNCTVdWRm5RVk5aVDFw
WlZDSTdjem81T2lKZmNISmxkbWx2ZFhNaU8yRTZNanA3Y3pvek9pSjFjbXdpTzNNNk16ZzZJbWgw
ZEhBNkx5OHhNamN1TUM0d0xqRTZPREF3TUM5cGJtWnZjbTFoYzJrdlltVnlhWFJoSWp0ek9qVTZJ
bkp2ZFhSbElqdHpPalk2SW1KbGNtbDBZU0k3ZlhNNk5qb2lYMlpzWVhOb0lqdGhPakk2ZTNNNk16
b2liMnhrSWp0aE9qQTZlMzF6T2pNNkltNWxkeUk3WVRvd09udDlmWE02TlRBNklteHZaMmx1WDNk
bFlsODFPV0poTXpaaFpHUmpNbUl5WmprME1ERTFPREJtTURFMFl6ZG1OVGhsWVRSbE16QTVPRGxr
SWp0cE9qUTdmUT0952aiakUYbw0=
'/*!*/;
# at 64610
#260910 15:14:31 server id 1  end_log_pos 64641 CRC32 0xe553896e 	Xid = 809
COMMIT/*!*/;
# at 64641
#260910 15:21:09 server id 1  end_log_pos 64664 CRC32 0xd4c6e52d 	Stop
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
