# CHANGES
## Access Log Module

Changes in 1.2
--------------
- Fix modname: "Access_Log/" in delete.sql
- Only save 'Y' as status when successful login to gain space in functions.php
- Translate Profile, Status & format date in AccessLog.php
- Rework logic to directly display logs & correctly display requested timeframe in AccessLog.php

Changes in 1.1
----------------
- Add functions.php to use "index.php|login_check" action hooks in index.php
- Remove README.txt and index.php
- Add CHANGES.md
- Fix Create Account (was not redirecting to index) (regression since 2.9.2) in Warehouse.php
- Update README.md



