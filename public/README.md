# Circular Buffer Chat : RB-chat

This is a small and simple web chat where the messages go around in a limited amount of memory locations, overwriting old messages. The original main point of this was to be a simple example of a Circular Buffer for my students.

It is a small and quick programming excercise using JavaScript in the front end and PHP + MySQL in the back end.

As only an example for my students, this could have been a lot smaller, now it also works as a small showcase.

## FAQ

* Why is this not more comprehensive?

Feel free to contribute or expand. Basically because I wrote just for fun while working simultaneously on other projects. Also as an pedagogical example, it should be even smaller.

* Why is it not made with node.js, WebSocket or WebRTC?

Because the language I teach basic programming to my students with is PHP. Perhaps a future version could ditch PHP.

* Shouldn't this follow the Circular Buffer theory more precisely with several index or pointers?

No, this is good as it is. A Circular Buffer is pretty simple in high-level languages. I would like to expand the front end a bit to make it more clear. Perhaps in a future version.

## Other Future Development Ideas

* More visual front end
* Use Node.js?
* Use React?
* Switch MySQL to JSON files?
* Add some sort of real time push functionality from server for new messages (socket.io)
* Ability to manipulate the buffer (remove messages, check pointers, ability to choose size of buffer)

## Installing

Coming later ...

## Author

Me, [Markus](https://github.com/makke/)

## License

This project is licensed under the MIT License.
