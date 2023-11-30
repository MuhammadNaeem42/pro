# Use an official Node.js image with version 16
FROM node:16

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY . . 

# Install project dependencies
RUN npm install



# Expose the port the app runs on
EXPOSE 8081

# Command to run the application
CMD ["npm", "run", "serve"]
