# Aksamedia Backend API Documentation

## Overview

This is the API documentation for the Aksamedia Backend Developer Test. The API provides endpoints for managing employees, divisions, and authentication in an employee management system.

## Quick Start

### 1. Import to Postman

1. Open Postman
2. Click "Import" button
3. Select `Aksamedia_Backend_API.postman_collection.json`
4. Import the environment file `Aksamedia_Backend_Environment.postman_environment.json`
5. Set the environment to "Aksamedia Backend Environment"

### 2. Setup

1. Make sure your Laravel development server is running:
   ```bash
   php artisan serve
   ```

2. The API will be available at: `http://127.0.0.1:8000/api`

### 3. Authentication

Before using protected endpoints, you need to login:

1. Use the "Login" request in the Authentication folder
2. Default credentials:
   - Username: `admin`
   - Password: `pastibisa`
3. The token will be automatically saved to the environment variable `auth_token`

## API Endpoints

### Authentication

#### POST /login
- **Description**: Authenticate admin user
- **Access**: Public (only when not authenticated)
- **Body**:
  ```json
  {
    "username": "admin",
    "password": "pastibisa"
  }
  ```
- **Response**: JWT token and admin information

#### POST /logout
- **Description**: Invalidate current token
- **Access**: Authenticated users only
- **Authentication**: Bearer Token required

### Divisions

#### GET /divisions
- **Description**: Get all divisions with pagination
- **Access**: Authenticated users only
- **Query Parameters**:
  - `name` (optional): Filter by division name
- **Response**: List of divisions with pagination info

### Employees

#### GET /employees
- **Description**: Get all employees with pagination
- **Access**: Authenticated users only
- **Query Parameters**:
  - `name` (optional): Filter by employee name
  - `division_id` (optional): Filter by division UUID
- **Response**: List of employees with division info and pagination

#### POST /employees
- **Description**: Create new employee
- **Access**: Authenticated users only
- **Content-Type**: `multipart/form-data`
- **Form Data**:
  - `name` (required): Employee name
  - `phone` (required): Phone number
  - `division` (required): Division UUID
  - `position` (required): Job position
  - `image` (optional): Employee photo file
- **Response**: Success confirmation

#### PUT /employees/{id}
- **Description**: Update existing employee
- **Access**: Authenticated users only
- **URL Parameters**: `id` - Employee UUID
- **Content-Type**: `application/json` or `multipart/form-data`
- **Body**: Same as POST /employees
- **Response**: Success confirmation

#### DELETE /employees/{id}
- **Description**: Delete employee
- **Access**: Authenticated users only
- **URL Parameters**: `id` - Employee UUID
- **Response**: Success confirmation

## Data Models

### Admin
```json
{
  "id": "uuid",
  "name": "string",
  "username": "string",
  "phone": "string",
  "email": "string"
}
```

### Division
```json
{
  "id": "uuid",
  "name": "string",
  "created_at": "timestamp",
  "updated_at": "timestamp"
}
```

### Employee
```json
{
  "id": "uuid",
  "image": "url|null",
  "name": "string",
  "phone": "string",
  "division": {
    "id": "uuid",
    "name": "string"
  },
  "position": "string"
}
```

## Standard Response Format

### Success Response
```json
{
  "status": "success",
  "message": "Operation successful message",
  "data": {
    // Response data
  },
  "pagination": {
    // Pagination info (for list endpoints)
    "current_page": 1,
    "per_page": 10,
    "total": 100,
    "last_page": 10,
    "from": 1,
    "to": 10,
    "has_more_pages": true
  }
}
```

### Error Response
```json
{
  "status": "error",
  "message": "Error message",
  "errors": {
    // Validation errors (if applicable)
  }
}
```

## HTTP Status Codes

- `200 OK`: Successful request
- `201 Created`: Resource created successfully
- `401 Unauthorized`: Authentication required or invalid credentials
- `403 Forbidden`: Access denied
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation errors
- `500 Internal Server Error`: Server error

## File Upload

### Image Upload Requirements
- **Supported formats**: JPEG, PNG, JPG, GIF
- **Maximum file size**: 2MB
- **Storage location**: `storage/app/public/employees/`
- **URL format**: `http://127.0.0.1:8000/storage/employees/filename.jpg`

### Upload Process
1. Use `multipart/form-data` content type
2. Include `image` field in form data
3. File will be validated and stored automatically
4. Old image will be deleted when updating employee

## Testing with Postman

### Environment Variables
The collection uses these environment variables:
- `base_url`: API base URL (default: `http://127.0.0.1:8000/api`)
- `auth_token`: JWT authentication token (auto-populated after login)
- `employee_id`: Sample employee UUID for testing
- `division_id`: Sample division UUID for testing

### Test Scripts
Each request includes test scripts that:
- Verify response status codes
- Check response structure
- Validate data types
- Save tokens automatically

### Usage Flow
1. **Login**: Use the login request to get authentication token
2. **Get Divisions**: Retrieve available divisions
3. **Create Employee**: Create a new employee with division reference
4. **Get Employees**: View all employees with filtering options
5. **Update Employee**: Modify employee information
6. **Delete Employee**: Remove employee record
7. **Logout**: Invalidate the current session

## Development Notes

### Database
- Uses SQLite for development
- All primary keys are UUIDs
- Includes seeded data for testing

### Laravel Features Used
- Laravel Sanctum for API authentication
- Form Request validation
- Eloquent ORM with relationships
- File storage with automatic cleanup
- Middleware for authentication and route protection

### Security
- CSRF protection disabled for API routes
- Bearer token authentication
- Input validation on all endpoints
- File upload security checks
- Automatic token invalidation on logout

## Troubleshooting

### Common Issues

1. **Authentication Errors**
   - Make sure you're logged in and the token is valid
   - Check if the token is properly set in the Authorization header

2. **File Upload Issues**
   - Ensure file size is under 2MB
   - Use supported image formats (JPEG, PNG, JPG, GIF)
   - Make sure storage directory has write permissions

3. **Database Errors**
   - Run migrations: `php artisan migrate`
   - Seed the database: `php artisan db:seed`

4. **Server Errors**
   - Check Laravel logs in `storage/logs/laravel.log`
   - Ensure all required PHP extensions are installed

### Support
For technical issues, please check:
- Laravel documentation
- API response error messages
- Server logs for detailed error information
