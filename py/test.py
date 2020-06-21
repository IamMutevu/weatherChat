import json

#read json file
with open('request.txt') as json_file:
    data = json.load(json_file)

message = data["request"]

data["response"] = "reply"

#write response to output file
with open('response.txt', 'w') as outfile:
    json.dump(data, outfile)

