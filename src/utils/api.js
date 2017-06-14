import axios from 'axios';

const client = axios.create({
    baseURL: 'http://localhost:8080/r2/siged/server/sys/srv'
    //baseURL: 'server/sys/srv'
});

export default client;
