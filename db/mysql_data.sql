insert into users(user_id, username, password, fullname, email, reg_date)
    values(1, 'admin', 'nimda', 'System Administrator', 'postmaster@localhost',
    now());

insert into log_types(log_type) values('Registration');
