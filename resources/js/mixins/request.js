import axios from 'axios';

export default {
    methods: {
        request() {
            let instance = axios.create(),
                endpoint = '/vidmin/api/';

            instance.defaults.headers.common['X-CSRF-TOKEN'] =
                document.head.querySelector('meta[name="csrf-token"]').content;

            instance.defaults.baseURL = endpoint;

            const requestHandler = (request) => {
                // Add any request modifiers...
                return request;
            };

            const errorHandler = (error) => {
                // Add any error modifiers...
                switch (error.response.status) {
                    case 401:
                    case 405:
                        // TODO: This check needs to be rewritten
                        window.location.href = `vidmin/logout`;
                        break;
                    default:
                        break;
                }

                return Promise.reject({ ...error.response });
            };

            const successHandler = (response) => {
                // Add any response modifiers...
                return response;
            };

            instance.interceptors.request.use((request) => requestHandler(request));

            instance.interceptors.response.use(
                (response) => successHandler(response),
                (error) => errorHandler(error)
            );

            return instance;
        },
    },
};
