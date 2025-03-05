FROM node:23-alpine3.20 AS build

# Create and set working directory
RUN mkdir /app
WORKDIR /app

# Copy node files
COPY ./package.json ./package-lock.json ./

# Install node dependencies
RUN npm install

# Copy source code
COPY . .

# Build app
RUN npm run build

FROM nginx:1.26.3-alpine3.20 AS final

# Copy built app
COPY --from=build /app/dist /usr/share/nginx/html

# Move nginx config to the correct folder
COPY --from=build /app/docker/nginx.conf /etc/nginx/nginx.conf
