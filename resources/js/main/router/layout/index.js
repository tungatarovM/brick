import * as routes from '../../../core/constants/routes';
import Layout from '../../views/Layouts/Default';
import dashboard from "./dashboard";
import projects from "./projects";
import staff from "./staff";
import tickets from "./tickets";

export default [
  {
    name: routes.LAYOUT_NAME,
    path: routes.LAYOUT_PATH,
    component: Layout,
    children: [
      ...dashboard,
      ...projects,
      ...staff,
      ...tickets,
    ]
  }
];
