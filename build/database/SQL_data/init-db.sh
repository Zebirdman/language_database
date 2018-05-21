#!/bin/bash
mysql -u root --password=hudeg9m5 database < /sql/database_bibliography.sql
mysql -u root --password=hudeg9m5 database < /sql/database_languages.sql
mysql -u root --password=hudeg9m5 database < /sql/database_changes_grammatical.sql
mysql -u root --password=hudeg9m5 database < /sql/database_change_references.sql
mysql -u root --password=hudeg9m5 database < /sql/database_submissions.sql
