export default {
    methods: {
        generateServiceRequestFromService(service, service_basic_details) {
            // Start off by creating a cache of the supplied service so no
            // matter we do to the object it does not affect the original
            // service properties.
            let service_request = _.cloneDeep(service);

            // Next, we'll add the default properties to the service to
            // form the service request object out of it.
            service_request.service_id = service_request.id;
            service_request.questions  = service_request
                                            .questions
                                            .map(data => {
                                                return {
                                                    heading: data.question,
                                                    options: data.options,
                                                    value: undefined,
                                                    visibility_type: data.visibility_type,
                                                };
                                            });

            service_basic_details
                .forEach(
                    details => service_request[details.options.key] = undefined
                );

            return service_request;
        },

        preserveServiceRequest(service_request) {
            localStorage.setItem(
                "service_request",
                JSON.stringify(service_request)
            );
        },

        recoverServiceRequest() {
            const data = localStorage.getItem("service_request");

            localStorage.removeItem("service_request");

            return JSON.parse(data);
        },
    }
};
