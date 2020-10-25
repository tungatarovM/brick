<script>
import { mapActions, mapMutations } from 'vuex';
import * as api from '../../../core/api/user';
import * as response from '../../../core/response';
import * as routes from '../../../core/constants/routes';

export default {
  name: "Handlers",
  methods: {
    ...mapMutations('auth', {
      setUser: 'setUser',
    }),
    async login(login, password) {
      try {
        const user = await api.login(login, password);

        this.setUser(user);

        await this.$router.push({ name: routes.DASHBOARD_NAME });
      } catch (e) {
        const errors = response.parseErrors(e.response);
        this.error = {
          ...this.error,
          ...errors,
        }
      }
    }
  }
}
</script>
