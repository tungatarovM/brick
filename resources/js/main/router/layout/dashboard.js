import * as routes from '../../../core/constants/routes';
import Dashboard from '../../views/Dashboard/Index';

export default [
  {
    name: routes.DASHBOARD_NAME,
    path: routes.DASHBOARD_PATH,
    component: Dashboard,
  }
]
