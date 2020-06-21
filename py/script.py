import json
from chatterbot import ChatBot
from chatterbot.trainers import ListTrainer
import os

#definition of bot
bot = ChatBot('Banjo')
conv = open('conv.txt', 'r').readlines()


#setting the trainer
bot.set_trainer(ListTrainer)
bot.train(conv)

#read json file
with open('data.txt') as json_file:
    data = json.load(json_file)

message = data["request"]

#get response to request
reply = bot.get_response(message)

data = {}

data["response"] = reply
#write response to output file
with open('data.txt', 'w') as outfile:
    json.dump(data, outfile)
