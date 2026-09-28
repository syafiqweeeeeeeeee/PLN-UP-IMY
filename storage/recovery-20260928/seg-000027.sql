# The proper term is pseudo_replica_mode, but we use this compatibility alias
# to make the statement usable on server versions 8.0.24 and older.
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#260925 11:16:45 server id 1  end_log_pos 126 CRC32 0xf5191638 	Start: binlog v 4, server v 8.0.30 created 260925 11:16:45 at startup
ROLLBACK/*!*/;
BINLOG '
rfW1ag8BAAAAegAAAH4AAAAAAAQAOC4wLjMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAACt9bVqEwANAAgAAAAABAAEAAAAYgAEGggAAAAICAgCAAAACgoKKioAEjQA
CigAATgWGfU=
'/*!*/;
# at 126
#260925 11:16:45 server id 1  end_log_pos 157 CRC32 0x4c28f313 	Previous-GTIDs
# [empty]
SET @@SESSION.GTID_NEXT= 'AUTOMATIC' /* added by mysqlbinlog */ /*!*/;
DELIMITER ;
# End of log file
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
