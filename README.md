# Ads App API

This is the API documentation for the **Ads App**, an application designed to manage and display advertisements from various businesses.

## Table of Contents

-   [Installation](#installation)
-   [Authentication Endpoints](#authentication-endpoints)
-   [Ads Endpoints](#ads-endpoints)
-   [Member Management Endpoints](#member-management-endpoints)
-   [Location & Language Endpoints](#location--language-endpoints)
-   [Contact & Rating Endpoints](#contact--rating-endpoints)
-   [Sections & Categories Endpoints](#sections--categories-endpoints)
-   [Error Handling](#error-handling)
-   [License](#license)

## Installation

1. Clone the repository:
   `bash
git clone https://github.com/your-repo/ads-app.git
cd ads-app
`
2. Install dependencies:
   `bash
composer install
    `
3. Set up the environment:
   `bash
cp .env.example .env
    `
4. Configure the database and API keys in the .env file.

5. Run migrations:
   `bash
php artisan migrate
    `
6. Start the development server:
   `bash
php artisan serve
    `

## Authentication Endpoints

-   POST /register: Registers a new user.
-   POST /login: Logs in a user and returns a token.
-   POST /logout: Logs out the authenticated user.
-   POST /forgot: Sends an OTP to reset the password.
-   POST /reset: Resets the password.

## Ads Endpoints

-   GET /ads: Retrieves all ads.
-   GET /ads/top: Retrieves top ads.
-   GET /ads/latest: Retrieves the latest ads.

# Example response for /ads:

    ```bash

{
"code": 200,
"msg": "ads retrieved successfully",
"data": [
{
"id": 1,
"title": "Ad Title",
"description": "Ad description",
"image": "image_url",
"created_at": "2024-10-22",
"updated_at": "2024-10-22"
}
]
}

```
### Member Management Endpoints
- GET /member/{id}: Retrieves a specific member by ID.
- POST /member/favourites/{id}: Adds a member to favorites.
- POST /member/rate/{id}: Rates a member.
- Location & Language Endpoints
- GET /locations: Retrieves all locations.
- GET /language/{id}: Retrieves the language setting for a user.
- POST /languagepost/{id}: Updates the language setting for a user.
- Contact & Rating Endpoints
- POST /contact: Sends a message to the admin.
- POST /rating: Submits a rating for the app.
- Sections & Categories Endpoints
- GET /sections: Retrieves all sections.
- GET /categories?id=1: Retrieves categories by section.

## Error Handling
The API returns standard HTTP status codes, including:

- 200 OK: Request was successful.
- 400 Bad Request: The request was invalid.
- 401 Unauthorized: Authentication required.
- 404 Not Found: Resource not found.
- 500 Internal Server Error: A server error occurred.
```