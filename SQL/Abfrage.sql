SELECT files.*, entries.identification AS accused_identification , members.identification AS author_name
FROM files 
JOIN entries ON files.accused_id = entries.id
JOIN members ON members.id = entries.id;
