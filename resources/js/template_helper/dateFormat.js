module.exports = function(date, options) {
  const formatToUse =
    (arguments[1] && arguments[1].hash && arguments[1].hash.format) ||
    "yyyy-MM-dd HH:mm:ss";
  return moment(date).format(formatToUse);
};
