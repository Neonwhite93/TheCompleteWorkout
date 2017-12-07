#signature: createExerWebpage: string string string string string -> html doc
#purpose: expects a url, a title, a header, an iframe, and a paragraph
#         creates an html doc with the specified information 

def createExerWebpage(url, title, header, iframe, p):

    f = open(url, 'w')

    message = ("<!DOCTYPE html>"+ "\n" +
               "<html>"+ "\n"+
               "   " + "<head>" + "\n" + 
               "      " + "<title>" + title + "</title>" + "\n" +
               "      " + "<meta charset='UTF-8'>" + "\n"
               "      " + "<meta name='viewport' content='width=device-width, initial-scale=1.0'>" + "\n"
               "      " + "<link rel='stylesheet' type='text/css' href='../src_style.css' />" + "\n"
               "   " + "</head>" + "\n" + "<body>" + "\n" +
               "   " + "<h1 id = 'app_title' class = 'frame_bar'>THE COMPLETE WORKOUT</h1>" + "\n" +
               "   " + "<div id = 'view_panel'>" + 
               "   " + "<h2>" + header + "</h2>" + "\n" +
               "   " + "<div class='center video-container'>" + "\n" +
               "      " + iframe + "\n" +
               "   " + "</div>" + "\n" +
               "   " + "<div>" + "\n" +
               "      " + "<p>" + "\n" + 
               "         " + p + "\n" + 
               "      " + "</p>" + "\n" +
               "   " + "</div>" + "\n" +
               "   " + "<form method='get' action='src_index.html'>" + "\n" +
               "      " + "<button type='submit'>Return to Exercises</button>" + "\n" +
               "   " + "</form>" + "\n" +
               "   " + "</div>" + "\n" +
               "</body>" + "\n" + 
               "</html>")

    f.write(message)
    f.close()
    
def main():
    url = input("Please enter a url. Ex: exercise_name.html: ")
    title = input("Please enter a title. Ex: Exercise_Name: ")
    header = input("Please enter a header. Ex: Exercise Name: ")
    iframe = input("Please enter an iframe from youtube: ")
    paragraph = input("Please enter a paragraph about the exercise: ")
    exerciseGroup = input("Please enter an exercise group: ")

    createExerWebpage(url, title, header, iframe, paragraph)

main()
