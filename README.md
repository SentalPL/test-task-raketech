# Countries Browser
It allows you to browse all the countries grouped by the region. 
Bonus: You can also search the countries by name and check their details like capital city, population etc.

## Description
User needs to log in first using Auth0 provider.<br>
Server fetches countries list and extended country details from external API and stores them in the Redis cache for later use.

## Installation

1. Clone the repository
2. Rename "Dockerfile.example" to "Dockerfile"
3. Rename "docker-compose.example.yml" to "docker-compose.yml"
4. Rename ".env.example" to ".env"

### Auth0 Configuration

1. Create a new Auth0 application of type "Regular Web Application"
2. Visit the "Connections" tab and add ensure that the application is connected to "Username-Password-Authentication" database
3. Visit the "Settings" tab and scroll down to "Application URLs", then fill the properties: 
   - Allowed Callback URLs: http://127.0.0.1:8000/callback
   - Allowed Logout URLs: http://127.0.0.1:8000
   - Allowed Web Origins: http://127.0.0.1:8000
4. Go to "User Management" > "Users" and create a new user with the following properties:
   - Connection: "Username-Password-Authentication" database
   - Email: anything you wish
   - Password: anything you wish

### Configure the application

1. Open .env and input values from Auth0
- AUTH0_DOMAIN = Domain from Settings tab
- AUTH0_CLIENT_ID = Client ID from Settings tab
- AUTH0_CLIENT_SECRET = Client Secret from Settings tab
- AUTH0_AUDIENCE = API Identifier from APIs tab
- AUTH0_REDIRECT_URI should be http://127.0.0.1:8000/callback

### Build the project

1. Execute "docker-compose up --build" in the terminal
2. Execute "npm update" in the terminal
3. Execute "npm run dev" in the terminal
4. Open http://127.0.0.1:8000 in your browser
5. Log in using the credentials of the user you created in Auth0
