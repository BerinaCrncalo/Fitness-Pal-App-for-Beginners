import axios from "axios";

// Backend URLs for Fitness Pal
const LOCAL_API_URL = "fitness-app-u6kxs.ondigitalocean.app";
const PRODUCTION_API_URL = "https://fitness-pal-backend.example.com/"; 

// Determine environment
const isProduction =
  window.location.hostname !== "localhost" &&
  window.location.hostname !== "127.0.0.1";

const API_BASE_URL = isProduction ? PRODUCTION_API_URL : LOCAL_API_URL;

// Create axios instance with default configuration
const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  timeout: 10000,
});

// Request interceptor to add Fitness Pal auth token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("fitnessAuthToken");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// Response interceptor to handle 401 errors (unauthorized)
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Token expired or invalid — clear Fitness Pal auth data
      localStorage.removeItem("fitnessAuthToken");
      localStorage.removeItem("fitnessUser");
      window.location.href = "/"; // redirect to homepage or login page
    }
    return Promise.reject(error);
  }
);

export default api;
