import { createAuth } from "vue-auth3";
import router from '../router';
import driverHttpAxios from "vue-auth3/drivers/http/axios";
import driverAuthBasic from "vue-auth3/drivers/auth/basic";


// Auth Configuration
const auth = createAuth({
  plugins: {
    router,
  },
  drivers: {
    http: driverHttpAxios,
    auth: driverAuthBasic
  },
  staySignedIn: true,
  staySignedIn: true,
  autoLogin: true,

})

export default auth;