import * as routes from '../../core/constants/routes';
import Login from '../views/Auth/Login/Index';
import Register from '../views/Auth/Registration/Index';

export default [
  {
    name: routes.LOGIN_NAME,
    path: routes.LOGIN_PATH,
    component: Login,
  },
  {
    name: routes.REGISTER_NAME,
    path: routes.REGISTER_PATH,
    component: Register,
  }
]
