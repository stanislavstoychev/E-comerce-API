This is my app for construction site that tracks progress on site.
Front end - Vue, backend - Laravel REST API.
The main part is an approval system with

RFI component - request for inspection created by Contractor with options Open, Cancel
and RFI is approved by Inspector with options Approve,On hold, Rejected.  
Construction Site is stuctured by Structures and substructures (different for each Part).

Issue component is for open and active topics to be solved with ability to attached documents. 

Drawings and Transmittal form component. 
This part keeps record for the lates darwing, history of the drawing, revisions, version, transmittal history.
Tables used: drawing (project_id, part_id...), project, part, 
Drawingdet (drawing_id, version, revision...), drawingfile (drawingdet_id...), 
drawingtransmittal  and drawingdet (many to many wiht pivot tabel drawingdet_drawingtransmittal)

Task component is used for report on the progress of the task, with information % complete, planned start and finish, actual plan and finish, with ability to upload picturesa and have a gallery of pictures for the task. Used tables task, task-pic(one to many).
