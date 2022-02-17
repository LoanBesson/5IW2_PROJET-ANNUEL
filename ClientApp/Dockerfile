FROM node:14-alpine

WORKDIR /usr/src/app/

COPY package*.json ./

RUN npm install -g @angular/cli && npm install

EXPOSE 4200