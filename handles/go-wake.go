func wakeHandler(w http.ResponseWriter, r *http.Request) {
	if r.Method == http.MethodPost {
		decoder := json.NewDecoder(r.Body)

		var body wakeInfo
		err := decoder.Decode(&body)
		if err != nil || body.Identifier == 0 {
			w.WriteHeader(http.StatusBadRequest)
			return
		}

		fmt.Fprintf(w, strconv.Itoa(body.Identifier))
		return
	}

	w.WriteHeader(http.StatusBadRequest)
}
