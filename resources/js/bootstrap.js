import axios from 'axios';
import dayjs from 'dayjs';

window.dayjs = dayjs;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
