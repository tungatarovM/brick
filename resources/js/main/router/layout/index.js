import * as routes from '../../../core/constants/routes';
import Layout from '../../views/Layouts/Default';
import dashboard from "./dashboard";

export default [
  {
    name: routes.LAYOUT_NAME,
    path: routes.LAYOUT_PATH,
    component: Layout,
    children: [
      ...dashboard,
    ]
  }
];
