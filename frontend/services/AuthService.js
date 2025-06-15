import api from "./api";

export const fitnessAuthService = {
  // Login user
  async login(credentials) {
    try {
      const response = await api.post("/auth/login", credentials);
      const { data } = response.data;
      const { token, ...user } = data;

      // Store token and user data
      localStorage.setItem("fitnessAuthToken", token);
      localStorage.setItem("fitnessUser", JSON.stringify(user));

      return { token, user };
    } catch (error) {
      throw error.response?.data || { message: "Login failed" };
    }
  },

  // Register new user
  async register(userData) {
    try {
      const response = await api.post("/auth/register", userData);
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: "Registration failed" };
    }
  },

  // Logout user
  logout() {
    localStorage.removeItem("fitnessAuthToken");
    localStorage.removeItem("fitnessUser");
  },

  // Get current user from localStorage
  getCurrentUser() {
    const userStr = localStorage.getItem("fitnessUser");
    return userStr ? JSON.parse(userStr) : null;
  },

  // Check if user is authenticated
  isAuthenticated() {
    return !!localStorage.getItem("fitnessAuthToken");
  },

  // Get stored token
  getToken() {
    return localStorage.getItem("fitnessAuthToken");
  },
};
