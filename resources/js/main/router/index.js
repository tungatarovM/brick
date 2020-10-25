import auth from './auth';
import layout from './layout';
import fullscreenLoader from "./fullscreenLoader";

export default {
  routes: [
    ...fullscreenLoader,
    ...auth,
    ...layout,
  ]
}
