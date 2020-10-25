<script>
import { mapActions, mapMutations } from 'vuex';
import * as api from '../../../core/api/user';
import * as routes from '../../../core/constants/routes';

export default {
  name: "Check",
  methods: {
    ...mapMutations('auth', {
      setUser: 'setUser',
    }),
    async checkAuth() {
      try {
        const user = await api.currentUser();

        if (!user) return this.$router.push({ name: routes.LOGIN_NAME });

        this.setUser(user);
        await this.$router.push({ name: routes.DASHBOARD_NAME });
      } catch (e) {
        // TODO do smth here
        console.error(e.message);
      }
    }
  }
}
</script>
