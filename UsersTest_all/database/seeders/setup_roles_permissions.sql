-- Insert permissions
INSERT INTO permissions (name, slug, description) VALUES
('View Users', 'view_users', 'Can view user profiles'),
('Edit Users', 'edit_users', 'Can edit user information'),
('Delete Users', 'delete_users', 'Can delete users'),
('Manage Roles', 'manage_roles', 'Can manage roles and permissions'),
('View Tasks', 'view_tasks', 'Can view tasks'),
('Create Tasks', 'create_tasks', 'Can create tasks'),
('Edit Tasks', 'edit_tasks', 'Can edit tasks'),
('Delete Tasks', 'delete_tasks', 'Can delete tasks');

-- Insert roles
INSERT INTO roles (name, slug) VALUES
('Administrator', 'admin'),
('User', 'user');

-- Assign all permissions to admin role
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id
FROM roles r
CROSS JOIN permissions p
WHERE r.slug = 'admin';

-- Assign basic permissions to user role
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id
FROM roles r
CROSS JOIN permissions p
WHERE r.slug = 'user'
AND p.slug IN ('view_tasks', 'create_tasks');

-- Update test user to be admin
UPDATE users SET role_id = (SELECT id FROM roles WHERE slug = 'admin') WHERE email = 'test@example.com'; 