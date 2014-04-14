def perfometer_check_mk_local(row, check_command, perf_data):
    color = { 0: "#0f0", 1: "#ff2", 2: "#f22", 3: "#fa2" }[row["service_state"]]
    return "%d" % int(perf_data[0][1]), perfometer_logarithmic(perf_data[0][1], 400, 50, color)

perfometers["check_mk-local"] = perfometer_check_mk_local
